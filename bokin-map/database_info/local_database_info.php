<?php

$rootDir = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'];

//localデータベースに接続
function getDB() {
  $dsn = 'mysql:dbname=bokinMap; host=192.168.33.13; charset=utf8';
  $usr = 'tomo';
  $password = 'Tomo_0314';

  $db = new PDO($dsn, $usr, $password);
  return $db;
}