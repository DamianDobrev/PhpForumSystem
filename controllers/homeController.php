<?php

include_once("models/Model.php");

class homeController {
    public $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke()
    {
        $urlParts = explode('/', "$_SERVER[REQUEST_URI]");

        $allCategories = $this->model->getAllCategories();

        $categoryUrl = "http://$_SERVER[HTTP_HOST]/$urlParts[1]/category/";

        include 'views/home.php';
    }
}

?>