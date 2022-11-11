<?php
require_once 'libs/Router.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
//(url,verb,controller,method)
//------------------------MOVIES------------------------------------
$router->addRoute('movies', 'GET', 'MovieApiController', 'getMovies');
$router->addRoute('movies', 'POST', 'MovieApiController', 'addMovie');
$router->addRoute('movies/:ID', 'GET', 'MovieApiController', 'getMovie');
$router->addRoute('movies/:ID', 'PUT', 'MovieApiController', 'updateMovie');
$router->addRoute('movies/:ID', 'DELETE', 'MovieApiController', 'deleteMovie');
//------------------------GENRES-------------------------------------
$router->addRoute('genres', 'GET', 'GenreApiController', 'getGenres');
$router->addRoute('genres', 'POST', 'GenreApiController', 'addGenre');
$router->addRoute('genres/:ID', 'GET', 'GenreApiController', 'getGenre');
$router->addRoute('genres/:ID', 'PUT', 'GenreApiController', 'updateGenre');
$router->addRoute('genres/:ID', 'DELETE', 'GenreApiController', 'deleteGenre');
//-----------------------DIRECTORS-----------------------------------
$router->addRoute('directors', 'GET', 'DirectorApiController', 'getDirectors');
$router->addRoute('directors', 'POST', 'DirectorApiController', 'addDirector');
$router->addRoute('directors/:ID', 'GET', 'DirectorApiController', 'getDirector');
$router->addRoute('directors/:ID', 'PUT', 'DirectorApiController', 'updateDirector');
$router->addRoute('directors/:ID', 'DELETE', 'DirectorApiController', 'deleteDirector');
// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);