<?php
include_once("templates/header.php");

echo "<h2 class='title'>$topic->title</h2>";
echo "<div class='muchText'>$topic->text<span class='posterName'>by $topicCreator->username</span></div>";
echo "<ul class='answerSet'>";
foreach ($answers as $index => $answer) {
    if ($answer->userId != null) {
        $nameOfPoster = $this->model->getUserByUsername($this->model->getUsernameById($answer->userId))->username.' [user]';
    }
    else {
        $nameOfPoster = $answer->creatorName.' [guest]';
    }
    echo "<li><div>By: $nameOfPoster, on: $answer->dateOfCreation</div><div>$answer->text</div></li>";
}
echo "</ul>";
echo "<div><a href='$newAnswerUrl'><button class='button'>New answer</button></a></div>";
echo "<h3>Tags</h3>";
echo "<ul class='tagsUl'>";
foreach ($topic->tags as $tag) {
    echo "<li>$tag->name</li>";
}
echo "</ul>";

include_once("templates/footer.php");