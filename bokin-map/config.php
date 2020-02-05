<?php

require_once (dirname(__FILE__) . '/../vendor/autoload.php');
//.env内の環境変数を使うための処理
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();