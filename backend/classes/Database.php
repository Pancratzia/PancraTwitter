<?php

class Database{
    protected $pdo = '';
    protected static $instance;
    
    protected function __construct(){
        try{
            $this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
        }
    }
    

    public static function instance(){
        if(self::$instance==null){
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __call($method, $args){
        return call_user_func_array([$this->pdo, $method], $args);
    } 
    
}


?>