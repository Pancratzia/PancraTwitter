<?php

class Account{
    private $pdo;
    private $errorArray=array();

    public function __construct(){
        $this->pdo = Database::instance();
    }

    public function register($firstName, $lastName, $username, $email, $pass, $cpass){
        $this->validateFirstName($firstName);
    }

    private function validateFirstName($firstName){
        if(strlen($firstName) <= 2 || strlen($firstName) > 25){
            array_push($this->errorArray, Constant::$firstNameCharacters);
        }
    }

    public function getErrorMessage($error){
        if(in_array($error, $this->errorArray)){
            return '<span class="errorMessage">'.$error.'</span> ';
        }
    }

}

?>