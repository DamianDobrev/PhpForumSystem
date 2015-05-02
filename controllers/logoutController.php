<?php

include_once("models/Model.php");

class logoutController {
    public $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function invoke()
    {
        session_destroy(); // Delete all data in $_SESSION[]

        // Remove the PHPSESSID cookie from the browser
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 420 * 69,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );

        header('Location: home');
        die;
    }
}

?>