<?php
require_once './app/models/inscripcion.model.php';
require_once './app/views/inscripcion.view.php';
require_once './app/helpers/auth.helper.php';

class InscripcionController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new InscripcionModel();
        $this->view = new InscripcionView();
        
    }

    public function showInscripciones($id) {
        
        $inscripciones = $this->model->getInscripciones();
        $materias = $this->model->getMaterias();
        
        $this->view->showInscripciones($inscripciones,$materias,$id);
    }

    public function showMaterias() {
        
        $materias = $this->model->getMaterias();
        
        $this->view->showMaterias($materias);
    }

    public function showFormInscripcion(){
        $materias = $this->model->getMaterias();
        $this->view->showFormInscripcion($materias);
    }

    public function addInscripcion() {

        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $objetivo = $_POST['objetivo'];
        $materia_id = $_POST['materia_id'];
        
        // validaciones
        if (empty($nombre) || empty($email) || empty($objetivo) || empty($materia_id)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertInscripcion($nombre, $email, $objetivo, $materia_id);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showError("Error al insertar la tarea");
        }
    }

    function removeInscripcion($id) {
        AuthHelper::verify();
        $this->model->deleteInscripcion($id);
        header('Location: ' . BASE_URL);
    }

    function showInfo($id){
        $inscripciones = $this->model->getInscripciones();
        $this->view->showInfoInscripcion($inscripciones,$id);
    }

    function showEdit($id) {
        AuthHelper::verify();
        $materias = $this->model->getMaterias();
        $inscripciones = $this->model->getInscripcionbyId($id);
        $this->view->mostrarEdicion($inscripciones, $id, $materias);
    }

    function modifyInscripcion($id) {
        AuthHelper::verify();
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $objetivo = $_POST['objetivo'];
        $materia_id = $_POST['materia_id'];
        
        // validaciones
        if (empty($nombre) || empty($email) || empty($objetivo) || empty($materia_id)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->updateInscripcion($nombre, $email, $objetivo, $materia_id, $id);
        if ($id) {
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showError("Error al modificar la tarea");
        }
    }
}