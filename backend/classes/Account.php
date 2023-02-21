<?php

class Account
{
    private $pdo;
    private $errorArray = array();

    public function __construct()
    {
        $this->pdo = Database::instance();
    }

    public function register($firstName, $lastName, $username, $email, $pass, $cpass)
    {
        $this->validateFirstName($firstName);
        $this->validateLasttName($lastName);
        $this->validateEmail($email);
        $this->validatePassword($pass, $cpass);
    }

    private function validateFirstName($firstName)
    {
        if($this->length($firstName, 2, 25)) {
            return true;
        } else {
            return array_push($this->errorArray, Constant::$firstNameCharacters);
        }
    }

    private function validateLasttName($lastName)
    {
        if ($this->length($lastName, 2, 25)) {
            return true;
        } else {
            return array_push($this->errorArray, Constant::$lastNameCharacters);
        }
    }

    private function validateEmail($email){
        $stmt = $this->pdo->prepare("SELECT email FROM users WHERE email=:email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0){
            return array_push($this->errorArray, Constant::$emailInUse);
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }else{
            return array_push($this->errorArray, Constant::$emailInvalid);
        }
    }

    private function validatePassword($pass, $cpass)
    {
        if ($pass != $cpass) {
            return array_push($this->errorArray, Constant::$passNotMatch);
        }
        //only alphanumeric password
        if (!preg_match("/^[a-zA-Z0-9]*$/", $pass)) {
            return array_push($this->errorArray, Constant::$passwordNotAlphanumeric);
        }
        if ($this->length($pass, 6, 25)) {
            return array_push($this->errorArray, Constant::$passwordLength);
        }
    
    }

    public function generateUsername($firstName, $lastName)
    {
        if (!empty($firstName) && !empty($lastName)) {
            if (!in_array(Constant::$firstNameCharacters, $this->errorArray) && !in_array(Constant::$lastNameCharacters, $this->errorArray)) {
                $username = strtolower($firstName . '' . $lastName);
                if ($this->checkUsernameExist($username)) {
                    $screenRand = rand();
                    $userLink = $username . '' . $screenRand;
                } else {
                    $userLink = $username;
                }
                return $userLink;
            }
        }
    }

    public function length($input, $min, $max)
    {
        if (strlen($input) >= $min && strlen($input) <= $max) {
            return true;
        } else {
            return false;
        }
    }

    private function checkUsernameExist($username)
    {
        $stmt = $this->pdo->prepare("SELECT username FROM users WHERE username=:username");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getErrorMessage($error)
    {
        if (in_array($error, $this->errorArray)) {
            return '<span class="errorMessage">' . $error . '</span> ';
        }
    }

}

?>