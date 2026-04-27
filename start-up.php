<?php
    session_start();

    define("ROOT", __DIR__);

    require_once(ROOT . "/database-interactions/general.php"); 

    $page = getCurrentPage();

    if (!isset($_SESSION['room'])) {
        $_SESSION['room'] = 1;
    }

    if (!isset($_SESSION['semester'])) {
        $_SESSION['semester'] = 1;
    }

    if(!isset($_SESSION['other-form'][$page])){
        $_SESSION['other-form'] = false;
    }
    if(!isset($_SESSION['header-form'][$page])){
        $_SESSION['header-form'] = false;
    }
    if(!isset($_SESSION['updating'][$page])){
        $_SESSION['updating'] = false;
    }

    $form = match($page){
        "Dashboard" => [ROOT . "/forms/form-body/booking-for-student.php",ROOT . "/forms/form-body/new-admin.php"],
        "Students" => [ROOT . "/forms/form-body/new-or-update.php", ROOT . "/forms/form-body/remove.php"],
        "Tutors" => [ROOT . "/forms/form-body/new-or-update.php", ROOT . "/forms/form-body/remove.php"],
        "Schedule" => [ROOT . "/forms/form-body/new-class.php", ROOT . "/forms/form-body/booking-for-student.php"],
        "Subjects" => [ROOT . "/forms/form-body/new-subject.html",ROOT . "/forms/form-body/remove.html"]
    };

    require_once(ROOT . "/basic-page-layout/header.php"); 
    require_once(ROOT . "/basic-page-layout/side-bar-nav.php");
?>