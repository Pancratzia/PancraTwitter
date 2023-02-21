<?php

function is_post_request(){
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function getInputValue($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }
}

function url_for($script){
    return "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/'.$script;
}

function redirect_to($location){
    header("Location:".$location);
    exit;
}

?>