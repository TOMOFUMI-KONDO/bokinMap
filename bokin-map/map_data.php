<?php

//localのデータベース情報
include 'database_info/local_database_info.php';
//本番環境のデータベース情報
//include 'database_info/remote_database_info.php';

$storeNumber = 72;
$id = ((int)$_POST['id']);
$errorIds = [6, 61];

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

    setcookie('lat', $lat, time() + (60 * 60 * 24));
    setcookie('lng', $lng, time() + (60 * 60 * 24));
    setcookie('message', $storeName, time() + (60 * 60 * 24));
  }
  catch (PDOException $e) {
    print "error: {$e->getMessage()}";
  }
  finally {
    $db = null;
  }
}
else {
  setcookie('lat', 'noExist', time() + (60 * 60 * 24));
  setcookie('lng', 'noExist', time() + (60 * 60 * 24));
  setcookie('message', '指定したidの店舗が見つかりませんでした。', time() + (60 * 60 * 24));
}

header("Location: $rootDir");