<?php
    define('ROOT', __DIR__);

    if (!isset($_SESSION['room'])) {
        $_SESSION['room'] = 1;
    }

    if (!isset($_SESSION['semester'])) {
        $_SESSION['semester'] = 1;
    }
    
    require_once(ROOT . "/include-for-display/side-bar-nav.php");
    require_once(ROOT . "/include-for-display/header.php");
    require_once(ROOT . "/forms/generate-form.php");
    
?>