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

        if(empty($this->errorArray)){
            return $this->insertUserDetails($firstName, $lastName, $username, $email, $pass);
        }else{
            return true;
        }
    }

    public function insertUserDetails($firstName, $lastName, $username, $email, $pass){
        $pass_hash= password_hash($pass, PASSWORD_BCRYPT);
        $rand=rand(0,2);
        if($rand==0){
            $profilePic="frontend/assets/images/defaultProfilePic.png";
            $profileCover="frontend/assets/images/backgroundCoverPic.svg";
        }else if($rand==1){
            $profilePic="frontend/assets/images/defaultPic.svg";
            $profileCover="frontend/assets/images/backgroundImage.svg";
        }else if($rand==2){
            $profilePic="frontend/assets/images/profilePic.jpeg";
            $profileCover="frontend/assets/images/backgroundCoverPic.svg";
        }

        $stmt=$this->pdo->prepare("INSERT INTO users(firstName, lastName, username, email, password, profileImage, profileCover) VALUES(:firstName, :lastName, :username, :email, :password, :profileImage, :profileCover)");
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $pass_hash, PDO::PARAM_STR);
        $stmt->bindParam(':profileImage', $profilePic, PDO::PARAM_STR);
        $stmt->bindParam(':profileCover', $profileCover, PDO::PARAM_STR);
        $stmt->execute();

        return $this->pdo->lastInsertId();

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
        if (!$this->length($pass, 6, 25)) {
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