<?php
class GenresModel{

    private $db;
    
    public function __construct(){
    
        $this->db = new PDO('mysql:host=localhost;'.'dbname=tpe;charset=utf8','root','');
    
    }
    
    public function getGenres(){
    
        $query = $this->db->prepare("SELECT * FROM genres ");
        $query->execute();
        $genres = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $genres;
    
    }
    public function getGenre($id){
    
        $query = $this->db->prepare("SELECT * FROM genres WHERE genre_id=?");
        $query->execute(array($id));
        $genre = $query->fetch(PDO::FETCH_OBJ);
        
        return $genre;
    
    }
    public function checkGenre($genre){
    
        $query = $this->db->prepare("SELECT * FROM genres WHERE genre=?");
        $query->execute(array($genre));
        $genres = $query->fetch(PDO::FETCH_OBJ);

        return $genre = $genres->Genre_id;
    
    }
    
    public function addGenre($genre){
    
        $query = $this->db->prepare("INSERT INTO genres (genre) VALUES (?)");
        $query->execute(array($genre));
    
        return $this->db->lastInsertid();

    }
    
    public function updateGenre($genre_id, $genre){
    
        $query = $this->db->prepare("UPDATE genres SET genre=? WHERE genre_id=?");
        $query->execute(array($genre, $genre_id));
    
    }
    
    public function deleteGenre($id){
    
        $query = $this->db->prepare("DELETE FROM genres WHERE genre_id=?");
        $query->execute(array($id));
    
    }
}
?>