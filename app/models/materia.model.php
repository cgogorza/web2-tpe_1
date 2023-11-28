<?php
require_once './config.php';

class MateriaModel {
    private $db;
        function __construct() {
        
        $this->db = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8", 'root', '');
    }

    function getMaterias() {
        $query = $this->db->prepare('SELECT * FROM materias');
        $query->execute();

        $materias = $query->fetchAll(PDO::FETCH_OBJ);

        return $materias;
    }

    function getMateriabyId($id) {

        $query = $this->db->prepare('SELECT * FROM materias WHERE materia_id = ?');
        $query->execute([$id]);
        
        return  $query->fetchAll(PDO::FETCH_OBJ);
    }

    function deleteMateria($id) {
        $query = $this->db->prepare('DELETE FROM materias WHERE materia_id = ?');
        $query->execute([$id]);
    }

}