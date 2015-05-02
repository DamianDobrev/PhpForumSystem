<?php

class Category {
    public $id;
    public $name;
    public $topics;

    public function __construct($id, $name, $topics) {
        $this->id = $id;
        $this->name = $name;
        $this->topics = $topics;
    }
}

?>