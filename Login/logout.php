<?php
    // ends the admin's session and returns to the login page
    session_start();
    $_SESSION = [];
    session_destroy();
    header("Location: ../Login.php");
    exit();
?>
