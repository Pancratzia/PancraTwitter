<?php

require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('DB_HOST', $_ENV['DB_HOST']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);
define('DB_NAME', $_ENV['DB_NAME']);

define("M_HOST", $_ENV['M_HOST']);
define("M_USER", $_ENV['M_USER']);
define("M_PASSWORD", $_ENV['M_PASSWORD']);
define("M_SMTPSECURE", $_ENV['M_SMTPSECURE']);
define("M_PORT", $_ENV['M_PORT']);

$public_end=strpos($_SERVER['SCRIPT_NAME'],'/frontend')+8;
$doc_root=substr($_SERVER['SCRIPT_NAME'],0,$public_end);

define("WWW_ROOT",$doc_root);




?>