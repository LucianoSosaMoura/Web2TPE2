<?php
require_once 'libs/Router.php';
require_once 'Controller/ApiController.php';
require_once 'Controller/ApiUserController.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('destacadas', 'GET', 'ApiController', 'obtenerDestacadas');
$router->addRoute('destacadas/:ID', 'GET', 'ApiController', 'obtenerDestacada');
$router->addRoute('destacadas', 'POST', 'ApiController', 'insertarDestacada');
$router->addRoute('destacadas/:ID', 'PUT', 'ApiController', 'actualizarDestacada');
$router->addRoute('destacadas/:ID', 'DELETE', 'ApiController', 'eliminarDestacada');

$router->addRoute('auth/token', 'GET', 'ApiUserController', 'obtenerToken');


// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
