<?php

include_once("models/Model.php");

class loginController {
    public $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke()
    {
        $suburl = $this->model->getSubUrl();

        if ($this->model->loggedIn()) {
            header("Location: $suburl/home");
            die();
        }

        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['login'])) {
            $username = htmlspecialchars($_POST['username']);
            $password = htmlentities($_POST['password']);

            if ($this->model->login($username, $password)) {
                $_SESSION['user'] = $username;
                header("Location: $suburl/home");
                die();
            }
            else {
                $message = "Wrong username or password.";
                include 'views/login.php';
                die();
            }
        }
        include 'views/login.php';
    }
}

?>