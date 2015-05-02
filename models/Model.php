<?php

include_once("Category.php");
include_once("Topic.php");
include_once("Answer.php");
include_once("User.php");
include_once("Tag.php");

class Model
{
    public function getSubUrl() {
        return "http://$_SERVER[HTTP_HOST]/phpForumSystem";
    }

    public function throwError ($statusCode) {
        if($statusCode == 404) {
            header('HTTP/1.1 404 Not Found');
            $_GET['e'] = 404;
            $subUrl = $this->getSubUrl();
            header("Location: $subUrl/error");
            die();
        }
    }

    public function getAllCategories() {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to the database!");

        $categories = mysqli_query($connection, 'SELECT * FROM `categories`');

        $categoriesOutput = [];

        while ($category = mysqli_fetch_array($categories)) {
            $id = $category["Id"];
            $name = $category["Name"];
            $topics = $this->getTopicsByCategory($id);

            array_push($categoriesOutput, new Category($id, $name, $topics));
        }

        return $categoriesOutput;
    }

    public function getCategory($categoryId) {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to the database!");

        $categoryQuery = mysqli_query($connection, 'SELECT * FROM `categories` WHERE Id = '.$categoryId);

        $categoryFetched = mysqli_fetch_array($categoryQuery);

        if (!$categoryFetched) {
            $this->throwError(404);
        }

        $id = $categoryFetched["Id"];
        $name = $categoryFetched["Name"];
        $topics = $this->getTopicsByCategory($id);

        return new Category($id, $name, $topics);
    }

    private function getTopicsByCategory($categoryId) {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to the database!");

        $topics = mysqli_query($connection, 'SELECT * FROM `topics`');

        $topicsOutput = [];

        while ($topic = mysqli_fetch_array($topics)) {
            $currentCatId = intval($topic['CategoryId']);
            if ($currentCatId == $categoryId) {
                array_push(
                    $topicsOutput,
                    new Topic(
                        intval($topic['Id']),
                        $topic['UserId'],
                        $topic['Title'],
                        $topic['Text'],
                        $topic['DateOfCreation'],
                        $this->getAnswersByTopic(intval($topic['Id'])),
                        $this->getTagsByTopic(intval($topic['Id']))
                    )
                );
            }
        }

        return $topicsOutput;
    }

    public function getTopic($topicId) {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to the database!");

        $topicQuery = mysqli_query($connection, 'SELECT * FROM `topics` WHERE Id = '.$topicId);

        $topicFetched = mysqli_fetch_array($topicQuery);

        if (!$topicFetched) {
            $this->throwError(404);
        }

        return new Topic(
            $topicFetched["Id"],
            $topicFetched["UserId"],
            $topicFetched["Title"],
            $topicFetched["Text"],
            $topicFetched["DateOfCreation"],
            $this->getAnswersByTopic($topicId),
            $this->getTagsByTopic($topicId)
        );
    }

    private function getAnswersByTopic($topicId){
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to the database!");

        $answers = mysqli_query($connection, 'SELECT * FROM `answers` WHERE TopicId = '.$topicId);

        $answersOutput = [];

        // add answers to answerOutput array
        while ($answer = mysqli_fetch_array($answers)) {
            array_push(
                $answersOutput,
                new Answer(
                    intval($answer['Id']),
                    $answer['UserId'],
                    $answer['AuthorName'],
                    $answer['DateOfCreation'],
                    $answer['Text']
                )
            );
        }

        return $answersOutput;
    }

    private function getTagsByTopic($topicId){
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to the database!");

        $query = 'SELECT t.Id, t.Name FROM tags t INNER JOIN topictags tt ON t.Id = tt.TagId WHERE tt.TopicId = '.$topicId.'';

        $tags = mysqli_query($connection, $query);

        $tagsOutput = [];

        // add answers to answerOutput array
        while ($tag = mysqli_fetch_array($tags)) {
            array_push(
                $tagsOutput,
                new Tag(
                    intval($tag['Id']),
                    $tag['Name']
                )
            );
        }

        return $tagsOutput;
    }

    public function login($username, $password) {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to the database!");

        $user = mysqli_query($connection, 'SELECT * FROM `users` WHERE Username = "'.$username.'"');

        $userObj = mysqli_fetch_object($user);

        if ($userObj && password_verify($password, $userObj->Password)) {
            return true;
        }

        return false;
    }

    public function loggedIn() {
        return isset($_SESSION['user']);
    }

    public function register($username, $password, $email) {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to the database!");

        $user = $this->getUserByUsername($username);
        if ($user) {
            return false;
        }

        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];

        $passwordHashed = password_hash($password, PASSWORD_BCRYPT, $options);

        mysqli_query($connection,
            'INSERT INTO `users`(`Username`, `Password`, `Email`) VALUES ("'.$username.'","'.$passwordHashed.'","'.$email.'")');

        return true;
    }

    public function getUsernameById ($id) {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to the database!");

        $user = mysqli_query($connection, 'SELECT * FROM `users` WHERE Id = '.$id.'');

        $userFetched = mysqli_fetch_object($user);

        return $userFetched->Username;
    }

    public function getUserByUsername ($username) {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to the database!");

        $user = mysqli_query($connection, 'SELECT * FROM `users` WHERE Username = "'.$username.'"');

        $userObj = mysqli_fetch_object($user);
        return new User($userObj->Id, $userObj->Username, $userObj->Email, $userObj->RegistrationDate);
    }

    public function addTopic ($categoryId, $title, $text, $userId, $tags) {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to the database!");

        mysqli_query($connection,
            'INSERT INTO `topics`(`Title`, `Text`, `CategoryId`, `UserId`) VALUES ("'.$title.'","'.$text.'","'.$categoryId.'","'.$userId.'")', MYSQLI_USE_RESULT);

        if (array_count_values($tags) == 0) {
            return true;
        }

        $idOfCurrentTopic = mysqli_insert_id($connection);
        $allTagsQuery = mysqli_query($connection, 'SELECT * FROM `tags`');
        $allTags = [];

        while($tag = mysqli_fetch_array($allTagsQuery)) {
            $allTags[$tag["Id"]] = $tag["Name"];
        }

        foreach($tags as $tag) {
            if (in_array($tag, $allTags)) {
                $key = array_search($tag, $allTags);
                mysqli_query($connection,
                    'INSERT INTO `topictags`(`TopicId`, `TagId`) VALUES ('.$idOfCurrentTopic.','.$key.')');
            }
            else {

                mysqli_query($connection,
                    'INSERT INTO `tags`(`Name`) VALUES ("'.$tag.'")');
                $key = mysqli_insert_id($connection);
                mysqli_query($connection,
                    'INSERT INTO `topictags`(`TopicId`, `TagId`) VALUES ('.$idOfCurrentTopic.','.$key.')');
            }
        }

        return true;
    }

    public function addAnswer($topicId, $text, $userId, $authorName) {
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("Could not connect to the database!");

        if ($userId == null) {
            mysqli_query($connection,
                'INSERT INTO `answers`(`Text`, `UserId`, `AuthorName`, `TopicId`) VALUES ("'.$text.'", NULL , "'.$authorName.'", '.$topicId.')');
        }
        else {
            mysqli_query($connection,
                'INSERT INTO `answers`(`Text`, `UserId`, `AuthorName`, `TopicId`) VALUES ("'.$text.'", '.$userId.' , NULL, '.$topicId.')');
        }


        return true;
    }
}

?>