<?php
include_once("templates/header.php");
echo "<h2 class='title'>All categories </h2>";
echo "<ul class='itemSet'>";
foreach ($allCategories as $index => $category) {
    $catid = $index+1;
    echo "<li><a href='$categoryUrl$category->id'>$catid $category->name</a><div class='setInfo'>Posts: ".count($category->topics)."</div></li>";
}
echo "</ul>";

include_once("templates/footer.php");