<?php

class User {
    public $id;
    public $username;
    public $email;
    public $registrationDate;

    public function __construct($id, $username, $email, $registrationDate) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->registrationDate = $registrationDate;
    }
}

?>