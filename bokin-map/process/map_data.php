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

$storeNumber = 86;
$id = ((int)$_POST['id']);
$errorIds = [];

if ($id <= $storeNumber && $id > 0 && !in_array($id, $errorIds)) {
  try {
    $db = getDB();
    $stt = $db->query("select storeName, latitude, longitude from places where id = $id");
    $stt->execute();
    while($row = $stt->fetch(PDO::FETCH_ASSOC)) {
      $storeName = $row['storeName'];
      $lat = $row['latitude'];
      $lng = $row['longitude'];
    }

    setcookie('lat', $lat, time() + (60 * 60 * 24), '/');
    setcookie('lng', $lng, time() + (60 * 60 * 24), '/');
    setcookie('message', $storeName, time() + (60 * 60 * 24), '/');
  }
  catch (PDOException $e) {
    print "error: {$e->getMessage()}";
  }
  finally {
    $db = null;
  }
}
else {
  setcookie('lat', 'noExist', time() + (60 * 60 * 24), '/');
  setcookie('lng', 'noExist', time() + (60 * 60 * 24), '/');
  setcookie('message', '指定したidの店舗が見つかりませんでした。', time() + (60 * 60 * 24), '/');
}

header("Location: $rootDir");