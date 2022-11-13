<?php
require_once "./api/APIController.php";
require_once "./api/APIView.php";
require_once "./models/MoviesModel.php";
require_once "./models/DirectorsModel.php";
require_once "./models/GenresModel.php";

class MovieApiController extends APIController {
    
    private $moviesmodel;
    //private $directorsmodel;
    private $genresmodel;
    
    
    public function __construct() {

        parent::__construct();
        $this->moviesmodel = new MoviesModel();
        //$this->directorsmodel = new DirectorsModel();
        $this->genresmodel = new GenresModel();

    }
    
    public function getMovies($params = null) {
        $order = null;
        $sort = null;
        $id = null;
        if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            if (isset($_GET['order'])) {
                $order = $_GET['order'];
            }
            if (isset($_GET['genre'])) {
                $id = $_GET['genre'];
                
                $genre = $this->genresmodel->getGenre($id);
                
                if (!$genre) {
                    $this->view->response("El genero con id = {$id} no existe", 404);
                    die();
                }
            }
        }    
        
        switch ($sort) {
            case 'title':
                if ($order == 'asc' || $order == null) {
                    
                    $movies = $this->moviesmodel->getMoviesSortTitleAsc($id);

                } elseif ($order == 'desc') {
                    $movies = $this->moviesmodel->getMoviesSortTitleDesc($id);
                } else {
                    $this->view->response('Direccion url incorrecta', 400);
                    die();
                }
                $this->view->response($movies,200);
                break;
            case 'director':
                if ($order == 'asc' || $order == null) {
                    $movies = $this->moviesmodel->getMoviesSortDirectorAsc($id);
                } elseif ($order == 'desc') {
                    $movies = $this->moviesmodel->getMoviesSortDirectorDesc($id);
                } else {
                    $this->view->response('Direccion url incorrecta', 400);
                    die();
                }
                $this->view->response($movies,200);
                break;
            case 'genre':
                if ($order == 'asc' || $order == null) {
                    $movies = $this->moviesmodel->getMoviesSortGenreAsc($id);
                } elseif ($order == 'desc') {
                    $movies = $this->moviesmodel->getMoviesSortGenreDesc($id);
                } else {
                    $this->view->response('Direccion url incorrecta', 400);
                    die();
                }
                $this->view->response($movies,200);
                break;
            case null:
                $movies = $this->moviesmodel->getMovies();
                $this->view->response($movies, 200);
                break;
            default:
                $this->view->response("Direccion url incorrecta", 400);
                break;
        }
        

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
        
        //$genre_id = $this->genresmodel->checkGenre($data->Genre);
        //$director_id = $this->directorsmodel->checkDirector($data->director);
    
        $id = $this->moviesmodel->addMovie($data->Tittle, $data->Director_id, $data->Genre_id);
        
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

            //$genre_id = $this->genresmodel->checkGenre($data->genre);
            //$director_id = $this->directorsmodel->checkDirector($data->director);
    
            $this->moviesmodel->updateMovie($id, $data->Tittle, $data->Director_id, $data->Genre_id);
            $this->view->response("La tarea fue modificada con exito", 200);

        } else
            $this->view->response("La tarea con id = {$id} no existe", 404);

    }

    public function error($params = null) {
        $this->view->response("Direccion url incorrecta", 400);
    }
}
?>