<?php

class InscripcionView {
    public function showInscripciones($inscripciones,$materias,$id) {
        require 'templates/ListaInscripciones.phtml';
    }

    public function showFormInscripcion(){
        require 'templates/form_inscripciones.phtml';
    }

    public function showMaterias($materias) {
        require 'templates/listaMaterias.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
    
    public function showInfoInscripcion($inscripciones,$id){
        require 'templates/infoInscripcion.phtml';
    }
}