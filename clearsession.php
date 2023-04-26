<?php
    session_start();
    session_unset();

    // Destroy the session
    session_destroy();

    if (isset($_GET['return_url'])) {
        // Redirect back to the original PHP file
        header('Location: ' . $_GET['return_url']);
        header("Refresh:0");
        exit();
    }

?>