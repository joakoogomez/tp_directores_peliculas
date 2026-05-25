<?php

require_once __DIR__ . '/../models/peliculas.model.php';
require_once __DIR__ . '/../models/directores.model.php';

require_once __DIR__ . '/../views/peliculas.view.php';
require_once __DIR__ . '/../views/error.view.php';

class PeliculasController {

    private $model;

    private $directorModel;

    private $view;

    private $errorView;

    public function __construct() {

        $this->model = new PeliculasModel();

        $this->directorModel = new DirectoresModel();

        $this->view = new PeliculasView();

        $this->errorView = new ErrorView();
    }

    public function showPeliculas() {

        $peliculas = $this->model->getAll();

        $directores = $this->directorModel->getAll();

        $this->view->renderPeliculas(
            $peliculas,
            $directores
        );
    }

    public function showPelicula($id) {

        $pelicula = $this->model->get($id);

        if (!$pelicula) {

            return $this->errorView->renderError(
                "La película no existe"
            );
        }

        $this->view->renderPelicula($pelicula);
    }

    public function addPelicula() {

        if (
            empty($_POST['nombre']) ||
            empty($_POST['fecha_estreno']) ||
            empty($_POST['nacionalidad']) ||
            empty($_POST['director'])
        ) {

            return $this->errorView->renderError(
                "Complete todos los campos"
            );
        }

        $nombre = $_POST['nombre'];

        $fecha_estreno = $_POST['fecha_estreno'];

        $nacionalidad = $_POST['nacionalidad'];

        $director = $_POST['director'];

        $id = $this->model->insert(
            $nombre,
            $fecha_estreno,
            $nacionalidad,
            $director
        );

        if (!$id) {

            return $this->errorView->renderError(
                "Error al insertar película"
            );
        }

        header("Location: " . BASE_URL . "peliculas");
    }

    public function deletePelicula($id) {

        $pelicula = $this->model->get($id);

        if (!$pelicula) {

            return $this->errorView->renderError(
                "La película no existe"
            );
        }

        $this->model->delete($id);

        header("Location: " . BASE_URL . "peliculas");
    }
}