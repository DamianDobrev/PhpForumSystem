<?php
include_once("templates/header.php");
echo "<h2 class='title'>New topic for category: <a href='$urlToCategory' class='inlineLink'>$category->name</a></h2>";
if(isset($message)) {
    echo "<div class='errorMsg'>$message</div>";
}
?>

    <form method="post" class="styledForm">
        <div>
            <label for="title">Title*</label>
            <input type="text" id="title" name="title">
        </div>

        <div>
            <label for="text">Text*</label>
            <textarea id="text" name="text"></textarea>
        </div>

        <div>
            <label for="tags">Tags</label>
            <input type="text" id="tags" name="tags">
            <div class="example">Example: tag1, tag2, tag3</div>
        </div>

        <div>
            <input type="submit" name="submit" value="Create" class="button">
        </div>
    </form>


<?php


include_once("templates/footer.php");
