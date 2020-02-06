<?php
//$dsn = 'mysql:dbname=bokinMap; host=192.168.33.13; charset=utf8';
//$usr = 'tomo';
//$password = 'Tomo_0314';
//
//try {
//  $db = new PDO($dsn, $usr, $password);
//  $stt = $db->exec("load data local infile '/vagrant/bokin-map/u3-4 2019募金ビン配布先.csv' into table places_test fields terminated by ',' enclosed by '\"' (storeName, latitude, longitude);");
//}
//catch (PDOException $e) {
//  print "error: {$e->getMessage()}";
//}
//finally {
//  $db = null;
//}

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
  for ($i = 0; $i < 85; $i++) {
    $stt = $db->query("insert into get_info () values ()");
  }
}
catch (PDOException $e) {
  print "error: {$e->getMessage()}";
}
finally {
  $db = null;
}