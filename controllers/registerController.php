<?php

include_once("models/Model.php");

class registerController {
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

        if (isset($_POST['username']) &&
            isset($_POST['password']) &&
            isset($_POST['passwordConfirm']) &&
            isset($_POST['email']) &&
            isset($_POST['submit']))
        {
            $username = htmlentities($_POST['username']);
            $password = htmlentities($_POST['password']);
            $passwordConfirm = htmlentities($_POST['passwordConfirm']);
            $email = htmlentities($_POST['email']);

            if ($password && $password === $passwordConfirm && $username && $email) {
                if ($this->model->register($username, $password, $email)) {
                    if ($this->model->login($username, $password)) {
                        $_SESSION['user'] = $username;
                        header("Location: $suburl/home");
                        die();
                    }
                }
                else {
                    $message = "There is already a user with that name or email.";
                    include 'views/register.php';
                    die();
                }
            }
            else if ($password != $passwordConfirm) {
                $message = "Passwords don't match.";
                include 'views/register.php';
                die();
            }
            else {
                $message = "All fields are required.";
                include 'views/register.php';
                die();
            }
        }

        include 'views/register.php';
    }
}

?>