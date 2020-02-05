<?php

require_once dirname(__FILE__) . '/../config.php';

if (getenv('APP_ENV') === 'development') {
  //localのデータベース情報
  require_once dirname(__FILE__) . '/../database_info/local_database_info.php';
}
else {
  //本番環境のデータベース情報
  require_once dirname(__FILE__) . '/../database_info/remote_database_info.php';
}

try {
  $db = getDB();
  $stt = $db->query("select places.id, places.storeName, get_info.get_info from places inner join get_info on places.id = get_info.id");
  $stt->execute();

  echo '<table id="place_list"><tr><th>id</th><th>店舗名</th><th>回収状況</th></tr>';
  $i = 0;
  while($row = $stt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td>" . $row['id'] . "</td>";
    echo "<td>" . $row['storeName'] . "</td>";
    if ($row['get_info'] === 'yet') {
      echo "<td id=get_info[$i] class='get_info'>未</td></tr>";
    }
    else {
      echo "<td id=get_info[$i] class='get_info'>完</td></tr>";
    }
    $i++;
  }  echo '</table>';
}
catch (PDOException $e) {
  print "error: {$e->getMessage()}";
}
finally {
  $db = null;
}