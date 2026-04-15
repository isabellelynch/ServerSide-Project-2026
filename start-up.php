<?php
    session_start();

    define("ROOT", __DIR__);

    if (!isset($_SESSION['room'])) {
        $_SESSION['room'] = 1;
    }

    if (!isset($_SESSION['semester'])) {
        $_SESSION['semester'] = 1;
    }

    if(!isset($_SESSION['other-form'])){
        $_SESSION['other-form'] = false;
    }
    if(!isset($_SESSION['header-form'])){
        $_SESSION['header-form'] = false;
    }
    if(!isset($_SESSION['updating'])){
        $_SESSION['updating'] = false;
    }

    require_once(ROOT . "/database-interactions/general.php"); 

    $form = match(getCurrentPage()){
        "Dashboard" => [ROOT . "/forms/form-body/booking-for-student.php",ROOT . "/forms/form-body/new-admin.php"],
        "Students" => [ROOT . "/forms/form-body/new-or-update.php", ROOT . "/forms/form-body/remove.html"],
        "Tutors" => [ROOT . "/forms/form-body/new-or-update.php", ROOT . "/forms/form-body/remove.html"],
        "Schedule" => [ROOT . "/forms/form-body/new-class.php", ROOT . "/forms/form-body/booking-for-student.php"],
        "Subjects" => [ROOT . "/forms/form-body/new-subject.html",ROOT . "/forms/form-body/remove.html"]
    };

    require_once(ROOT . "/basic-page-layout/header.php"); 
    require_once(ROOT . "/basic-page-layout/side-bar-nav.php");
    require_once(ROOT . "/forms/generate-form.php");
?>