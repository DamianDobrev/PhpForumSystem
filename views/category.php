<?php
include_once("templates/header.php");

echo "<h2 class='title'>$category->name</h2>";
echo "<div><a href=\"$newTopicUrl\"><button class='button'>New topic</button></a></div>";
echo "<ul class='itemSet'>";
foreach ($topics as $index => $topic) {
    echo "<li><a href='$topicUrl$topic->id'>$topic->title</a> <span class='date1'>[$topic->creationDate]</span><div class='setInfo'>Answers: ".count($topic->answers)."</div></li>";
}
echo "</ul>";
echo "<div><a href=\"$newTopicUrl\"><button class='button'>New topic</button></a></div>";

include_once("templates/footer.php");