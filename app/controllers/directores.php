<?php

require_once __DIR__ . '/../models/directores.model.php';

require_once __DIR__ . '/../views/directores.view.php';

require_once __DIR__ . '/../views/error.view.php';

class DirectoresController {

    private $model;

    private $view;

    private $errorView;

    public function __construct() {

        $this->model = new DirectoresModel();

        $this->view = new DirectoresView();

        $this->errorView = new ErrorView();
    }

    public function showDirectores() {

        $directores = $this->model->getAll();

        $this->view->renderDirectores($directores);
    }

    public function addDirector() {

        if (
            empty($_POST['nombre']) ||
            empty($_POST['fecha_nacimiento']) ||
            empty($_POST['edad'])
        ) {

            return $this->errorView->renderError(
                "Complete todos los campos"
            );
        }

        $nombre = $_POST['nombre'];

        $fecha = $_POST['fecha_nacimiento'];

        $edad = $_POST['edad'];

        $this->model->insert(
            $nombre,
            $fecha,
            $edad
        );

        header("Location: " . BASE_URL . "directores");
    }

    public function deleteDirector($id) {

        $this->model->delete($id);

        header("Location: " . BASE_URL . "directores");
    }
}