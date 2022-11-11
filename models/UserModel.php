<?php
class UserModel{
    
    private $db;
    
    public function __construct(){

        $this->db = new PDO('mysql:host=localhost;'.'dbname=tpe;charset=utf8','root','');
    
    }

    public function getUserbyEmail($email){
        
        $query = $this->db->prepare('SELECT * FROM users WHERE email = ?');
        $query->execute(array($email));
        return $query->fetch(PDO::FETCH_OBJ);

    }
}
?>