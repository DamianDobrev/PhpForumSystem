<?php

class Answer {
    public $id;
    public $userId;
    public $creatorName;
    public $dateOfCreation;
    public $text;

    public function __construct($id, $userId, $creatorName, $dateOfCreation, $text) {
        $this->id = $id;
        $this->userId = $userId;
        $this->creatorName = $creatorName;
        $this->dateOfCreation = $dateOfCreation;
        $this->text = $text;
    }
}

?>