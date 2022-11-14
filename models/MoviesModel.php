<?php
class MoviesModel{
    
    private $db;
    
    function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=tpe;charset=utf8','root','');
    }
    //HACER MULTITABLA RN TITULO|1|1
    public function getMovies() {
        
        $query = $this->db->prepare("SELECT * FROM movies JOIN directors ON movies.director_id=directors.director_id JOIN genres ON movies.genre_id=genres.genre_id;");
        $query->execute();
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;
    }

    public function getMoviesSortTitleAsc($id) {

        $query = $this->db->prepare("SELECT * FROM movies JOIN directors ON movies.director_id=directors.director_id JOIN genres ON movies.genre_id=genres.genre_id WHERE ? IS NULL OR movies.genre_id=? ORDER BY tittle ASC");
        $query->execute(array($id, $id));
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;
    }
    
    public function getMoviesSortTitleDesc($id) {
    
        $query = $this->db->prepare("SELECT * FROM movies JOIN directors ON movies.director_id=directors.director_id JOIN genres ON movies.genre_id=genres.genre_id WHERE ? IS NULL OR movies.genre_id=? ORDER BY tittle DESC");
        $query->execute(array($id, $id));
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;
    
    }
    
    public function getMoviesSortGenreAsc($id) {
    
        $query = $this->db->prepare("SELECT * FROM movies JOIN directors ON movies.director_id=directors.director_id JOIN genres ON movies.genre_id=genres.genre_id WHERE ? IS NULL OR movies.genre_id=? ORDER BY genre ASC");
        $query->execute(array($id, $id));
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;
    
    }
    
    public function getMoviesSortGenreDesc($id) {
        $query = $this->db->prepare("SELECT * FROM movies JOIN directors ON movies.director_id=directors.director_id JOIN genres ON movies.genre_id=genres.genre_id WHERE ? IS NULL OR movies.genre_id=? ORDER BY genre DESC");
        $query->execute(array($id, $id));
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;
    }
    
    public function getMoviesSortDirectorAsc($id) {

        $query = $this->db->prepare("SELECT * FROM movies JOIN directors ON movies.director_id=directors.director_id JOIN genres ON movies.genre_id=genres.genre_id WHERE ? IS NULL OR movies.genre_id=? ORDER BY director ASC");
        $query->execute(array($id, $id));
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;

    }
    
    public function getMoviesSortDirectorDesc($id) {

        $query = $this->db->prepare("SELECT * FROM movies JOIN directors ON movies.director_id=directors.director_id JOIN genres ON movies.genre_id=genres.genre_id WHERE ? IS NULL OR movies.genre_id=? ORDER BY director DESC");
        $query->execute(array($id, $id));
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;
    
    }
    
    public function getSingleMovie($id) {
        
        $query = $this->db->prepare("SELECT * FROM movies JOIN directors ON movies.director_id=directors.director_id JOIN genres ON movies.genre_id=genres.genre_id WHERE id=?");
        $query->execute(array($id));
        $movie = $query->fetch(PDO::FETCH_OBJ);
        return $movie;

    }

    public function getMoviesbyGenre($genre_id) {

        $query = $this->db->prepare("SELECT * FROM movies JOIN directors ON movies.director_id=directors.director_id JOIN genres ON movies.genre_id=genres.genre_id WHERE movies.genre_id=?");
        $query->execute(array($genre_id));
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;
    
    }
   
    public function getMoviesbyDirector($director_id) {

        $query = $this->db->prepare("SELECT * FROM movies JOIN directors ON movies.director_id=directors.director_id JOIN genres ON movies.genre_id=genres.genre_id WHERE movies.director_id=?");
        $query->execute(array($director_id));
        $movies = $query->fetchAll(PDO::FETCH_OBJ);
        return $movies;
    
    }
    //SAME ABV
    public function addMovie($title, $director, $genre) {

        $query = $this->db->prepare("INSERT INTO movies (tittle,director_id,genre_id) VALUES (?,?,?)");
        $query->execute(array($title,$director,$genre));
        $id = $this->db->lastInsertId();
        return $id;
    
    }
    
    public function deleteMovie($id) {

        $query = $this->db->prepare("DELETE FROM movies WHERE id=?");
        $query->execute(array($id));
    
    }

    public function deleteMoviesbyGenre($genre_id) {

        $query = $this->db->prepare("DELETE FROM movies WHERE genre_id=?");
        $query->execute(array($genre_id));
    
    }
    
    public function deleteMoviesbyDirector($director_id) {

        $query = $this->db->prepare("DELETE FROM movies WHERE director_id=?");
        $query->execute(array($director_id));
    
    }

    public function updateMovie($id, $tittle, $director_id, $genre_id) {

        $query = $this->db->prepare("UPDATE movies SET tittle=?, director_id=?, genre_id=? WHERE id=?");
        $query->execute(array($tittle, $director_id, $genre_id, $id));
    
    }
}
?>