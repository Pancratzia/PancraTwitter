<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'pancra');
define('DB_PASSWORD', 'password');
define('DB_NAME', 'pancratwitter');

$public_end=strpos($_SERVER['SCRIPT_NAME'],'/frontend')+8;
$doc_root=substr($_SERVER['SCRIPT_NAME'],0,$public_end);

define("WWW_ROOT",$doc_root);


?>