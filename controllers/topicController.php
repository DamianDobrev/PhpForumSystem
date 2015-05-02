<?php

include_once("models/Model.php");

class topicController {
    public $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke($parameters)
    {
        $urlParts = explode('/', "$_SERVER[REQUEST_URI]");

        $topicId = intval($parameters[0]);

        $topic = $this->model->getTopic($topicId);

        $topicCreator = $this->model->getUserByUsername($this->model->getUsernameById($topic->creatorId));

        $answers = $topic->answers;

        $newAnswerUrl = "http://$_SERVER[HTTP_HOST]/$urlParts[1]/newAnswer/$topicId";

        include 'views/topic.php';
    }
}

?>