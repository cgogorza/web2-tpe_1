<?php
require "./app/controllers/inscripcion.controller.php";
require "./app/controllers/auth.controller.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'listar'; 
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);
$inscripciones_controller = new InscripcionController();
$controller = new AuthController();
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
    case 'login':
        $controller = new AuthController();
        $controller->showLogin(); 
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default: 
        echo "404 Page Not Found";
        break;
}

