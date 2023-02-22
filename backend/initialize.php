<?php

ob_start();

date_default_timezone_set('America/Caracas');

require_once('backend/config.php');
include("classes/PHPMailer.php");
include("classes/SMTP.php");
include("classes/Exception.php");

spl_autoload_register(function ($class) {
    require_once "classes/{$class}.php";
});

session_start();

$account = new Account;
$loadFromUser = new User;
include_once('functions.php');

?>