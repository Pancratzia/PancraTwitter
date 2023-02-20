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
    }

    private function validateFirstName($firstName)
    {
        if (strlen($firstName) <= 2 || strlen($firstName) > 25) {
            return array_push($this->errorArray, Constant::$firstNameCharacters);
        }
    }

    private function validateLasttName($lastName)
    {
        if (strlen($lastName) <= 2 || strlen($lastName) > 25) {
            return array_push($this->errorArray, Constant::$lastNameCharacters);
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