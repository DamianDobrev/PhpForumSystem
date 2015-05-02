<?php

include_once("models/Model.php");

class newAnswerController {
    public $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke($parameters)
    {
        $suburl = $this->model->getSubUrl();

        if ($this->model->loggedIn()) {
            $username = $_SESSION['user'];
        }

        $topicId = intval($parameters[0]);

        $topic = $this->model->getTopic($topicId);

        $urlToTopic = "$suburl/topic/$topicId";

        if (isset($_POST["text"]) &&
            isset($_POST["submit"])) {
            $text = htmlentities($_POST["text"]);
            $authorName = "";
            $userId = null;
            if ($this->model->loggedIn()) {
                $userId = $this->model->getUserByUsername(htmlentities($_SESSION["user"]))->id;
                $authorName = $_SESSION["user"];
            }
            else if (isset($_POST["name"])) {
                $authorName = htmlentities($_POST["name"]);
            }
            else {
                $message = "Name is required if you are not logged in.";
                include 'views/newAnswer.php';
                die();
            }

            if ($text && $authorName) {
                $this->model->addAnswer($topicId, $text, $userId, $authorName);
                header("Location: $suburl/topic/$topicId");
                die();
            }
            else {
                $message = "All fields are required.";
                include 'views/newAnswer.php';
                die();
            }
        }

        include 'views/newAnswer.php';
    }
}

?>