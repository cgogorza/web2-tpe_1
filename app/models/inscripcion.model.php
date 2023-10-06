<?php

class InscripcionModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=web2;charset=utf8', 'root', '');
    }

    function getInscripciones() {
        $query = $this->db->prepare('SELECT * FROM inscripciones');
        $query->execute();

        $inscripciones = $query->fetchAll(PDO::FETCH_OBJ);

        return $inscripciones;
    }
    function getMaterias() {
        $query = $this->db->prepare('SELECT * FROM materias');
        $query->execute();

        $materias = $query->fetchAll(PDO::FETCH_OBJ);

        return $materias;
    }

    function insertInscripcion($nombre, $email, $objetivo, $materia_id,) {
        $query = $this->db->prepare('INSERT INTO inscripciones (nombre, email, objetivo, materia_id) VALUES(?,?,?,?)');
        $query->execute([$nombre, $email, $objetivo, $materia_id]);

        return $this->db->lastInsertId();
    }

    function deleteInscripcion($id) {
        $query = $this->db->prepare('DELETE FROM inscripciones WHERE inscripcion_id = ?');
        $query->execute([$id]);
    }

}