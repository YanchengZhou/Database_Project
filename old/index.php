<?php

session_start();

// Register the autoloader
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

$command = "login";

if (isset($_GET["command"]))
    $command = $_GET["command"];

// add after login
if (!isset($_SESSION["email"])) {
   // they need to see the login
   // go to mainpage before setting login page
   $command = "login";
}

// Instantiate the controller and run
$connect = new connectController($command);
$connect->run();
