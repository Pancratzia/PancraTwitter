<?php 

class User{
    private $pdo;
    public function __construct(){
        $this->pdo=Database::instance();
    }

    public function userData($user_id){
        $stmt=$this->pdo->prepare("SELECT * FROM users WHERE user_id=:user_id");
        $stmt->bindParam(':user_id',$user_id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($stmt->rowCount()!=0){
            return $user;
        }else{
            return false;
        }
    }
}

?>