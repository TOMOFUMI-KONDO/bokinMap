<?php


$rootDir = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/bokin-map/';

function getDB() {
//本番環境データベースの接続情報
  $dsn = 'mysql:dbname=kontomo_bokin-map; host=mysql57.kontomo.sakura.ne.jp; charset=utf8';
  $usr = 'kontomo';
  $password = 'Tom0_kuN0209';

  $db = new PDO($dsn, $usr, $password);
  return $db;
}