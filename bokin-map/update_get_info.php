<?php

//localのデータベース情報
include 'database_info/local_database_info.php';
//本番環境のデータベース情報
//include 'database_info/remote_database_info.php';

$number = $_POST['number'];

try {
  $db = getDB();
  $stt = $db->query("select get_info from get_info where id = $number");
  $before_info = $stt->fetchColumn();

  if ($before_info === 'yet') {
    $stt = $db->query("update get_info set get_info = 'complete' where id = $number");
    $stt->execute();
  }
  else {
    $stt = $db->query("update get_info set get_info = 'yet' where id = $number");
    $stt->execute();
  }

  $stt = $db->query("select get_info from get_info where id = $number");
  $data['get_info'] = $stt->fetchColumn();

  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data);
}
catch (PDOException $e) {
  print "error: {$e->getMessage()}";
}
finally {
  $db = null;
}