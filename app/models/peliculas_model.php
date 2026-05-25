<?php

class PeliculasModel {

    private $db;

    public function __construct() {

        $this->db = new PDO(
            'mysql:host=localhost;dbname=db_peliculas;charset=utf8',
            'root',
            ''
        );
    }

    public function getAll() {

        $query = $this->db->prepare(
            'SELECT peliculas.*, directores.nombre AS director
            FROM peliculas
            JOIN directores
            ON peliculas.id_director = directores.id_director'
        );

        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($id) {

        $query = $this->db->prepare(
            'SELECT peliculas.*, directores.nombre AS director
            FROM peliculas
            JOIN directores
            ON peliculas.id_director = directores.id_director
            WHERE peliculas.id_pelicula = ?'
        );

        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function insert(
        $nombre,
        $fecha_estreno,
        $nacionalidad,
        $director
    ) {

        $query = $this->db->prepare(
            'INSERT INTO peliculas
            (nombre, fecha_estreno, nacionalidad, id_director)
            VALUES (?,?,?,?)'
        );

        $query->execute([
            $nombre,
            $fecha_estreno,
            $nacionalidad,
            $director
        ]);

        return $this->db->lastInsertId();
    }

    public function delete($id) {

        $query = $this->db->prepare(
            'DELETE FROM peliculas
            WHERE id_pelicula = ?'
        );

        $query->execute([$id]);
    }
}