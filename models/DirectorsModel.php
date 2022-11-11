<?php
class DirectorsModel{
    
    private $db;
    
    public function __construct(){
    
        $this->db = new PDO('mysql:host=localhost;'.'dbname=tpe;charset=utf8','root','');
    
    }
    
    public function getDirectors(){
    
        $query = $this->db->prepare("SELECT * FROM directors");
        $query->execute();
        $directors = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $directors;
    
    }
    public function getDirector($id){
    
        $query = $this->db->prepare("SELECT * FROM directors WHERE director_id=?");
        $query->execute(array($id));
        $director = $query->fetch(PDO::FETCH_OBJ);
    
        return $director;
    
    }
    public function checkDirector($director){
    
        $query = $this->db->prepare("SELECT * FROM directors WHERE director=?");
        $query->execute(array($director));
        $directors = $query->fetch(PDO::FETCH_OBJ);

        return $director = $directors->Director_id;
    }
    
    public function addDirector($director){
    
        $query = $this->db->prepare("INSERT INTO directors (director) VALUES (?)");
        $query->execute(array($director));
    
        return $this->db->lastInsertid();

    }
    
    public function updateDirector($director_id, $director){
    
        $query = $this->db->prepare("UPDATE directors SET director=? WHERE director_id=?");
        $query->execute(array($director, $director_id));
    
    }
    
    public function deleteDirector($id){
    
        $query = $this->db->prepare("DELETE FROM directors WHERE director_id=?");
        $query->execute(array($id));
    
    }
}
?>