<?php
require_once './app/models/materia.model.php';
require_once './app/models/inscripcion.model.php';
require_once './app/views/inscripcion.view.php';
require_once './app/helpers/auth.helper.php';

class MateriaController {
    private $materiaModel;
    private $inscripcionModel;
    private $view;

    public function __construct() {
        AuthHelper::init();
        $this->materiaModel = new MateriaModel();
        $this->inscripcionModel = new InscripcionModel();
        $this->view = new InscripcionView();
        
    }

    public function showMaterias() {       
        $materias = $this->materiaModel->getMaterias();
        $this->view->showMaterias($materias);
    }

    public function showFormInscripcion(){
        $materias = $this->materiaModel->getMaterias();
        $this->view->showFormInscripcion($materias);
    }

    function removeMateria($id) {
        AuthHelper::verify();
        $materias = $this->materiaModel->getMaterias();
        $inscripciones = $this->inscripcionModel->getInscripciones();
        $contador = 0;
        foreach ($materias as $materia) {
            if($materia->materia_id==$id){
                foreach ($inscripciones as $inscripcion) {
                    if($inscripcion->materia_id==$id){
                        $contador ++;
                    }
                }
                if($contador == 0){
                    $this->materiaModel->deleteMateria($id);
                    $this->view->showSuccess("Materia eliminada con exito");
                } else{
                    $this->view->showError("Hay alumnos inscriptos. Comunicarse con la cátedra.");
                }
            }
        }
    }

    function showInfoMateria($id){
        $materias = $this->materiaModel->getMateriabyId($id);
        $this->view->showInfoMaterias($materias, $id);
    }

    function showEdit($id) {
        AuthHelper::verify();
        $materias = $this->materiaModel->getMaterias();
        $inscripciones = $this->inscripcionModel->getInscripcionbyId($id);
        $this->view->showEdicion($inscripciones, $id, $materias);
    }

    
}