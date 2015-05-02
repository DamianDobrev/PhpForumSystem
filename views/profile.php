<?php
include_once("templates/header.php");
echo "<h2 class='title'>User profile for $user->username</h2>";

if(isset($message)) {
    echo "<div class='errorMsg'>$message</div>";
}
?>

<?php
echo "<div class='pLabel'>Username: </div><span>$user->username</span>";
echo "<div class='pLabel'>Email: </div><span>$user->email</span>";
echo "<div class='pLabel'>Registration Date: </div><span>$user->registrationDate</span>";
?>

<?php


include_once("templates/footer.php");
