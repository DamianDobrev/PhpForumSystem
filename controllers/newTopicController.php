<?php

include_once("models/Model.php");

class newTopicController {
    public $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke($parameters)
    {
        $suburl = $this->model->getSubUrl();

        if (!$this->model->loggedIn()) {
            header("Location: $suburl/login");
            die();
        }

        $categoryId = intval($parameters[0]);

        $category = $this->model->getCategory($categoryId);

        $urlToCategory = "$suburl/category/$categoryId";

        if (isset($_POST["title"]) &&
            isset($_POST["text"]) &&
            isset($_POST["submit"])) {
            $title = htmlentities($_POST["title"]);
            $text = htmlentities($_POST["text"]);
            $userId = $this->model->getUserByUsername(htmlentities($_SESSION["user"]))->id;
            $tags = [];
            if(isset($_POST["tags"])) {
                $tagsStr = htmlentities($_POST["tags"]);
                trim($tagsStr);
                $tagsStr = preg_replace('/[\s,]+/', ',', $tagsStr);
                $tags = explode(',', $tagsStr);
                array_filter($tags);
                $tags = array_map('trim', $tags);
                $tags = array_map('strtolower', $tags);
            }
            if ($title && $text && $userId) {
                if($this->model->addTopic($categoryId, $title, $text, $userId, $tags)) {
                    header("Location: $suburl/category/$categoryId");
                    die();
                }
            }
            else {
                $message = "All fields are required.";
                include 'views/newTopic.php';
                die();
            }
        }

        include 'views/newTopic.php';
    }
}

?>