<?php
require "./app/controllers/inscripcion.controller.php";
require "./app/controllers/auth.controller.php";

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'listar'; // acción por defecto si no envían
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'login':
        $controller = new AuthController();
        $controller->showLogin(); 
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'listar':
        $controller = new InscripcionController();
        $controller->showInscripciones(null);
        break;
    case 'inscripcion':
        $controller = new InscripcionController();
        $controller->showFormInscripcion();
        break;
    case 'agregar':
        $controller = new InscripcionController();
        $controller->addInscripcion();
        break;
    case 'eliminar':
        $controller = new InscripcionController();
        $controller->removeInscripcion($params[1]);
        break;
    case 'mostrarEdicion':
        $controller = new InscripcionController();
        $controller->showEdit($params[1]);
        break;
    case 'editar':
        $controller = new InscripcionController();
        $controller->modifyInscripcion($params[1]);
        break;
    case 'info':
        $controller = new InscripcionController();
        $controller->showInfo($params[1]);
        break;
    case 'materias':
        $controller = new InscripcionController();
        $controller->showMaterias();
        break;
    case 'filtro':
        $controller = new InscripcionController();
        $controller->showInscripciones($params[1]);
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default: 
        echo "404 Page Not Found";
        break;
}

