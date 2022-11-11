<?php

require_once "./models/DirectorsModel.php";
require_once "./models/MoviesModel.php";

class DirectorApiController extends APIController {

    private $directorsmodel;
    private $moviesmodel;

    public function __construct() {
    
        parent::__construct();
        $this->directorsmodel = new DirectorsModel();
        $this->moviesmodel = new MoviesModel();
    
    }
    
    public function getDirectors($params = null) {
    
        $directors = $this->directorsmodel->getDirectors();
        $this->view->response($directors, 200);
    
    }
    
    public function getGenre($params = null) {
    
        $id = $params[':ID'];
        $director = $this->directorsmodel->getDirector($id);
    
        if($director)
            $this->view->response($director, 200);
        else
            $this->view->response("El director con id = {$id} no existe", 404);
    
    }
    
    public function addDirector($params = null) {
    
        $data = $this->getData();
        $id = $this->directorsmodel->addDirector($data->director);
        $director = $this->directorsmodel->getDirector($id);
    
        if ($director) 
            $this->view->response($director, 201);
        else
            $this->view->response("El genero no fue agregado", 500);
    
    }

    public function updateDirector($params = null) {
        
        $id = $params[':ID'];
        $data = $this->getData();
        $director = $this->directorsmodel->getDirector($id);
    
        if ($director) {
            $this->directorsmodel->updatedirector($id, $data->director);
            $this->view->response("El director fue modificado con exito", 200);
        } else
            $this->view->response("El director con id = {$id} no existe", 404);
    }

    public function deleteDirector($params = null) {

        $id = $params[':ID'];
        $director = $this->directorsmodel->getDirector($id);

        if ($director) {
            $this->moviesmodel->deleteMoviesbyDirector($id);
            $this->directorsmodel->deleteDirector($id);
            $this->view->response("El director fue borrado con exito", 200);
        } else 
            $this->view->response("El director con id = {$id} no existe", 404);
    
    }
}
?>