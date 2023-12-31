<?php
require_once './app/views/auth.view.php';
require_once './app/models/user.model.php';
require_once './app/helpers/auth.helper.php';
require_once './pass.php';

class AuthController {
    private $view;
    private $model;

    function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function auth() {
        $email= $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            $this->view->showLogin('Faltan completar datos');
            return;
        }

        // Se busca el usuario
        $user = $this->model->getByEmail($email);
        if (!empty($user) && password_verify($password, $user->password)) {

        //Se realiza autenticación de usuario   
            AuthHelper::login($user);        
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showLogin('Usuario inválido');
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: " . "login");
    }
}
