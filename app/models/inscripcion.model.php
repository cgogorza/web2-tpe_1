<?php

require_once './config.php';

class InscripcionModel {
    private $db;
    

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=web2_tpe;charset=utf8', 'root', '');
    }
    //No está funcionando $host y $dbname.
    //Si se pone lo que estaba antes anda bien, el tema es el config.ini.
    
    function getInscripciones() {
        $query = $this->db->prepare('SELECT * FROM inscripciones');
        $query->execute();

        $inscripciones = $query->fetchAll(PDO::FETCH_OBJ);

        return $inscripciones;
    }

    function getInscripcionbyId($id) {

        $query = $this->db->prepare('SELECT * FROM inscripciones WHERE inscripcion_id = ?');
        $query->execute([$id]);
        
        return  $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getMaterias() {
        $query = $this->db->prepare('SELECT * FROM materias');
        $query->execute();

        $materias = $query->fetchAll(PDO::FETCH_OBJ);

        return $materias;
    }

    function insertInscripcion($nombre, $email, $objetivo, $materia_id) {
        $query = $this->db->prepare('INSERT INTO inscripciones (nombre, email, objetivo, materia_id) VALUES(?,?,?,?)');
        $query->execute([$nombre, $email, $objetivo, $materia_id]);

        return $this->db->lastInsertId();
    }

    function deleteInscripcion($id) {
        $query = $this->db->prepare('DELETE FROM inscripciones WHERE inscripcion_id = ?');
        $query->execute([$id]);
    }

    function updateInscripcion($nombre, $email, $objetivo, $materia_id, $id) {
        $query = $this->db->prepare('UPDATE inscripciones SET nombre = ?, email = ?, objetivo = ?,  materia_id = ? WHERE inscripcion_id = ?');
        $query->execute([$nombre, $email, $objetivo, $materia_id, $id]);
        return $query;
    }

}