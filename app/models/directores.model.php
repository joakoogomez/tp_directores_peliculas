<?php

class DirectoresModel {

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
            'SELECT * FROM directores'
        );

        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insert(
        $nombre,
        $fecha,
        $edad
    ) {

        $query = $this->db->prepare(
            'INSERT INTO directores
            (nombre, fecha_nacimiento, edad)
            VALUES (?,?,?)'
        );

        $query->execute([
            $nombre,
            $fecha,
            $edad
        ]);
    }

    public function delete($id) {

        $query = $this->db->prepare(
            'DELETE FROM directores
            WHERE id_director = ?'
        );

        $query->execute([$id]);
    }
}