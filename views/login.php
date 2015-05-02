<?php
include_once("templates/header.php");
echo "<h2 class='title'>Login</h2>";

if(isset($message)) {
    echo "<div class='errorMsg'>$message</div>";
}
?>

<form method="post" class="styledForm">
    <div>
        <label for="username">Username*</label>
        <input type="text" id="username" name="username">
    </div>

    <div>
        <label for="password">Password*</label>
        <input type="password" id="password" name="password">
    </div>

    <div>
        <input type="submit" name="login" value="Login" class="button">
    </div>
</form>


<?php


include_once("templates/footer.php");
