<?php

require_once __DIR__ . '/app/controllers/peliculas.php';

require_once __DIR__ . '/app/controllers/directores.php';

require_once __DIR__ . '/app/middlewares/session.middleware.php';

require_once __DIR__ . '/app/middlewares/guard.middleware.php';

session_start();

define(
    'BASE_URL',
    '//' .
    $_SERVER['SERVER_NAME'] .
    ':' .
    $_SERVER['SERVER_PORT'] .
    dirname($_SERVER['PHP_SELF']) .
    '/'
);

$action = 'peliculas';

if (!empty($_GET['action'])) {

    $action = $_GET['action'];
}

$params = explode('/', $action);

$req = new StdClass();

$req = (new SessionMiddleware())->run($req);

switch ($params[0]) {

    case 'peliculas':

        $controller = new PeliculasController();

        $controller->showPeliculas();

        break;

    case 'pelicula':

        $controller = new PeliculasController();

        $id = $params[1];

        $controller->showPelicula($id);

        break;

    case 'add':

        $req = (new GuardMiddleware())->run($req);

        $controller = new PeliculasController();

        $controller->addPelicula();

        break;

    case 'delete':

        $req = (new GuardMiddleware())->run($req);

        $controller = new PeliculasController();

        $id = $params[1];

        $controller->deletePelicula($id);

        break;





    // =========================
    // DIRECTORES
    // =========================

    case 'directores':

        $controller = new DirectoresController();

        $controller->showDirectores();

        break;

    case 'addDirector':

        $req = (new GuardMiddleware())->run($req);

        $controller = new DirectoresController();

        $controller->addDirector();

        break;

    case 'deleteDirector':

        $req = (new GuardMiddleware())->run($req);

        $controller = new DirectoresController();

        $id = $params[1];

        $controller->deleteDirector($id);

        break;





    default:

        echo('404 Page not found');

        break;
}