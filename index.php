<?php
    require("connect-db.php");

    session_start();
    if(isset($_SESSION["userID"]) && isset($_SESSION["email"]) && isset($_SESSION["name"])) {
        echo "logged in as " . $_SESSION["name"]. " userID: " . $_SESSION["userID"]
        . " email: ". $_SESSION["email"];
    } else {
        echo "You have not logged in";
    }
?>

<br>
<a href="login.php"> go to login </a>
<br>
<a href="signup.php"> go to sign up </a>
<br>
<a href="upload.php"> go to upload </a>