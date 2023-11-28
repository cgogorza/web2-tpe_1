<?php
require_once './app/models/inscripcion.model.php';
require_once './app/models/materia.model.php';
require_once './app/views/inscripcion.view.php';
require_once './app/helpers/auth.helper.php';

class InscripcionController {
    private $inscripcionModel;
    private $materiaModel;
    private $view;

    public function __construct() {
        AuthHelper::init();
        $this->inscripcionModel = new InscripcionModel();
        $this->materiaModel = new MateriaModel();
        $this->view = new InscripcionView();
        
    }

    public function showInscripciones($id) {        
        $inscripciones = $this->inscripcionModel->getInscripciones();
        $materias = $this->materiaModel->getMaterias();
        $this->view->showInscripciones($inscripciones,$materias,$id);
    }

    public function addInscripcion() {
        AuthHelper::verify();
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $objetivo = $_POST['objetivo'];
        $materia_id = $_POST['materia_id'];
        
        // Validaciones
        if (empty($nombre) || empty($email) || empty($objetivo) || empty($materia_id)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->inscripcionModel->insertInscripcion($nombre, $email, $objetivo, $materia_id);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showError("Error al insertar la tarea");
        }
    }

    function removeInscripcion($id) {
        AuthHelper::verify();
        $this->inscripcionModel->deleteInscripcion($id);
        header('Location: ' . BASE_URL);
    }

    function showInfo($id){
        $inscripciones = $this->inscripcionModel->getInscripciones();
        $this->view->showInfoInscripcion($inscripciones,$id);
    }

    function showEdit($id) {
        AuthHelper::verify();
        $materias = $this->materiaModel->getMaterias();
        $inscripciones = $this->inscripcionModel->getInscripcionbyId($id);
        $this->view->showEdicion($inscripciones, $id, $materias);
    }

    function modifyInscripcion($id) {
        AuthHelper::verify();
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $objetivo = $_POST['objetivo'];
        $materia_id = $_POST['materia_id'];
        
        // Validaciones
        if (empty($nombre) || empty($email) || empty($objetivo) || empty($materia_id)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->inscripcionModel->updateInscripcion($nombre, $email, $objetivo, $materia_id, $id);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showError("Error al modificar la tarea");
        }
    }
}