<?php
require "./app/controllers/inscripcion.controller.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'listar'; 
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);
$inscripciones_controller = new InscripcionController();
switch ($params[0]) {
    case 'listar':
        $inscripciones_controller->showInscripciones(null);
        break;
    case 'inscripcion':
        $inscripciones_controller->showFormInscripcion();
        break;
    case 'agregar':
        $inscripciones_controller->addInscripcion();
        break;
    case 'info':
        $inscripciones_controller->showInfo($params[1]);
        break;
    case 'materias':
        $inscripciones_controller->showMaterias();
        break;
    case 'filtro':
        $inscripciones_controller->showInscripciones($params[1]);
        break;
    default: 
        echo "404 Page Not Found";
        break;
}
//Crear una aplicación MVC para listar los nombres de 
//productos de una casa de limpieza. 
//Al seleccionar uno se debe navegar a otra página 
//donde se vea la descripción y precio.
