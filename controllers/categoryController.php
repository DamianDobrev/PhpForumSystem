<?php

include_once("models/Model.php");

class categoryController {
    public $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke($parameters)
    {
        $urlParts = explode('/', "$_SERVER[REQUEST_URI]");

        $categoryId = intval($parameters[0]);

        $category = $this->model->getCategory($categoryId);
        $topics = $category->topics;
        $topicUrl = "http://$_SERVER[HTTP_HOST]/$urlParts[1]/topic/";
        $newTopicUrl = "http://$_SERVER[HTTP_HOST]/$urlParts[1]/newTopic/$categoryId";

        include 'views/category.php';
    }
}

?>