<?php

include_once("models/Model.php");

class profileController {
    public $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke()
    {
        $suburl = $this->model->getSubUrl();

        if (!$this->model->loggedIn()) {
            header("Location: $suburl/login");
            die();
        }

        $user = $this->model->getUserByUsername($_SESSION["user"]);

        include 'views/profile.php';
    }
}

?>