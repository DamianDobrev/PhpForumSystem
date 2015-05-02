<?php

session_start();

require_once('includes/config.php');
require_once('controllers/homeController.php');
require_once('controllers/categoryController.php');
require_once('controllers/topicController.php');
require_once('controllers/loginController.php');
require_once('controllers/logoutController.php');
require_once('controllers/registerController.php');
require_once('controllers/newTopicController.php');
require_once('controllers/newAnswerController.php');
require_once('controllers/profileController.php');
require_once('controllers/errorController.php');

$homeUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$requestPartsArray = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if (strlen($requestPartsArray[2]) == 0) {
    header('Location: '.$homeUrl.'home');
    die();
}
else {
    $controllerName = strtolower($requestPartsArray[2]);
    $controllerFileName = $controllerName.'Controller';
}

if ($controllerName != "content" && !file_exists("controllers/$controllerFileName.php")) {
    header('HTTP/1.1 404 Not Found'); //This may be put inside err.php instead
    $_GET['e'] = 404;
    header("Location: http://$_SERVER[HTTP_HOST]/phpForumSystem/error");
    die();
}
if ($controllerName != "content") {
    $controller = new $controllerFileName();

    $parameters = array_slice($requestPartsArray, 3);
    if (count($parameters) > 0) {
        $controller->invoke($parameters);
    }
    else {
        $controller->invoke();
    }
}

?>
