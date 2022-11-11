<?php

require_once "APIView.php";
require_once "./models/MoviesModel.php";
require_once "./models//DirectorsModel.php";
require_once "./models/GenresModel.php";

class MovieApiController extends APIController {
    
    private $moviesmodel;
    private $directorsmodel;
    private $genresmodel;
    private $view;
    
    public function __construct() {

        parent::__construct();
        $this->moviesmodel = new MoviesModel();
        $this->directorsmodel = new DirectorsModel();
        $this->genresmodel = new GenresModel();

    }
    
    public function getMovies($params = null) {

        $movies = $this->moviesmodel->getMovies();
        $this->view->response($movies, 200);

    }

    public function getMovie($params = null) {

        $id = $params[':ID'];
        $movie = $this->moviesmodel->getSingleMovie($id);

        if($movie)
            $this->view->response($movie, 200);
        else
            $this->view->response("La pelicula con id = {$id} no existe", 404);
    
    }
    
    public function deleteMovie($params = null) {
    
        $id = $params[':ID'];
        $movie = $this->moviesmodel->getSingleMovie($id);
    
        if ($movie) {
            $this->moviesmodel->deleteMovie($id);
            $this->view->response("La pelicula fue borrada con exito", 200);
        } else 
            $this->view->response("La pelicula con id = {$id} no existe", 404);
    
    }
    
    public function addMovie($params = null) {
    
        $data = $this->getData();
    
        $genre_id = $this->genresmodel->checkGenre($data->genre);
        $director_id = $this->directorsmodel->checkDirector($data->director);
    
        $id = $this->moviesmodel->addMovie($data->title, $director_id, $genre_id);
        $movie = $this->moviesmodel->getSingleMovie($id);
    
        if ($movie) 
            $this->view->response($movie, 201);
        else
            $this->view->response("La tarea no fue creada", 500);
    
    }
    
    public function updateMovie($params = null) {
    
        $id = $params[':ID'];
        $data = $this->getData();
        $movie = $this->moviesmodel->getSingleMovie($id);
    
        if ($movie) {

            $genre_id = $this->genresmodel->checkGenre($data->genre);
            $director_id = $this->directorsmodel->checkDirector($data->director);
    
            $this->moviesmodel->updateMovie($id, $data->title, $director_id, $genre_id);
            $this->view->response("La tarea fue modificada con exito", 200);

        } else
            $this->view->response("La tarea con id = {$id} no existe", 404);

    }
}
?>