<?php

ob_start();

date_default_timezone_set('America/Caracas');

require_once('backend/config.php');

spl_autoload_register(function ($class) {
    require_once "classes/{$class}.php";
});

session_start();

include_once('functions.php');

?>