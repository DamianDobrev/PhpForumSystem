<?php
include_once("templates/header.php");
echo "<h2>New answer for topic: <a href='$urlToTopic' class='inlineLink'>\"$topic->title\"</a> ";
if (isset($username)) {
    echo "from user: $username";
}
else {
    echo "from guest";
}
echo "</h2>";
if(isset($message)) {
    echo "<div class='errorMsg'>$message</div>";
}
?>

    <form method="post" class="styledForm">
        <?php
        if (!isset($username)) : ?>
            <div>
                <label for="name">Your name *</label>
                <input type="text" id="name" name="name">
            </div>
        <?php endif; ?>
        <div>
            <label for="text">Text *</label>
            <textarea id="text" name="text"></textarea>
        </div>
        <div>
            <input type="submit" name="submit" value="Add answer" class="button">
        </div>
    </form>


<?php


include_once("templates/footer.php");
