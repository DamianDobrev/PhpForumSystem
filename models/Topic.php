<?php

class Topic {
    public $id;
    public $creatorId;
    public $title;
    public $text;
    public $creationDate;
    public $answers;
    public $tags;

    public function __construct($id, $creatorId, $title, $text, $creationDate, $answers, $tags) {
        $this->id = $id;
        $this->creatorId = $creatorId;
        $this->title = $title;
        $this->text = $text;
        $this->creationDate = $creationDate;
        $this->answers = $answers;
        $this->tags = $tags;
    }
}

?>