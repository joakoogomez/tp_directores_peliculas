<?php

class PeliculasView {

    public function renderPeliculas(
        $peliculas,
        $directores
    ) {

        $count = count($peliculas);

        require_once __DIR__ . '/../templates/peliculas.phtml';
    }

    public function renderPelicula($pelicula) {

        require_once __DIR__ . '/../templates/pelicula-detalle.phtml';
    }
}