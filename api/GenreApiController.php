<?php

require_once "./models/GenresModel.php";
require_once "./models/MoviesModel.php";

class GenreApiController extends APIController {

    private $genresmodel;
    private $moviesmodel;

    public function __construct() {
        
        parent::__construct();
        $this->genresmodel = new GenresModel();
        $this->moviesmodel = new MoviesModel();
    
    }
    
    public function getGenres($params = null) {
    
        $genres = $this->genresmodel->getGenres();
        $this->view->response($genres, 200);
    
    }
    
    public function getGenre($params = null) {
    
        $id = $params[':ID'];
        $genre = $this->genresmodel->getGenre($id);
    
        if($genre)
            $this->view->response($genre, 200);
        else
            $this->view->response("El genero con id = {$id} no existe", 404);
    
    }
    
    public function addGenre($params = null) {
    
        $data = $this->getData();
        $id = $this->genresmodel->addGenre($data->genre);
        $genre = $this->genresmodel->getGenre($id);
        
        if ($genre) 
            $this->view->response($genre, 201);
        else
            $this->view->response("El genero no fue agregado", 500);
    
    }

    public function updateGenre($params = null) {
        
        $id = $params[':ID'];
        $data = $this->getData();
        $genre = $this->genresmodel->getGenre($id);
        
        if ($genre) {
            $this->genresmodel->updateGenre($id, $data->genre);
            $this->view->response("El genero fue modificado con exito", 200);
        } else
            $this->view->response("El genero con id = {$id} no existe", 404);
    
    }

    public function deleteGenre($params = null) {
        
        $id = $params[':ID'];
        $genre = $this->genresmodel->getGenre($id);
        
        if ($genre) {
            $this->moviesmodel->deleteMoviesbyGenre($id);
            $this->genresmodel->deleteGenre($id);
            $this->view->response("El genero fue borrado con exito", 200);
        } else 
            $this->view->response("El genero con id = {$id} no existe", 404);

    }
}
?>