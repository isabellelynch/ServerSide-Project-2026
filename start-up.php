<?php
    session_start();

    define("ROOT", __DIR__);

    // relative path from the current page back to the project folder ("" or "../"),
    // so links and redirects work whatever the project folder is called
    $scriptDir = realpath(dirname($_SERVER['SCRIPT_FILENAME']));
    $depth = ($scriptDir === realpath(ROOT)) ? 0 : substr_count(substr($scriptDir, strlen(realpath(ROOT))), DIRECTORY_SEPARATOR);
    define("BASE", str_repeat("../", $depth));

    require_once(ROOT . "/database-interactions/general.php");
    require_once(ROOT . "/database-interactions/subjects.php");

    $page = getCurrentPage();

    if($page !== "Login" && !isset($_SESSION['name'])){
        header("Location: " . BASE . "Login.php");
        exit();
    }

    // already signed in - skip the login page
    if($page === "Login" && isset($_SESSION['name'])){
        header("Location: " . BASE . "Dashboard/Dashboard.php");
        exit();
    }

    $form = match($page){
        "Dashboard" => [ROOT . "/forms/form-body/booking-for-student.php",ROOT . "/forms/form-body/new-admin.php"],
        "Students" => [ROOT . "/forms/form-body/new-or-update.php", ROOT . "/forms/form-body/remove.php"],
        "Tutors" => [ROOT . "/forms/form-body/new-or-update.php", ROOT . "/forms/form-body/remove.php"],
        "Schedule" => [ROOT . "/forms/form-body/new-class.php", ROOT . "/forms/form-body/booking-for-student.php"],
        "Subjects" => [ROOT . "/forms/form-body/new-subject.php", ROOT . "/forms/form-body/remove.php"],
        default => []
    };

    $formHandlers = match($page){
        "Dashboard" => [ROOT . "/forms/form-handlers/add-new-staff-member.php",ROOT . "/forms/form-handlers/student-class-booking.php"],
        "Students" => [ROOT . "/forms/form-handlers/student-tutor.php"],
        "Tutors" => [ROOT . "/forms/form-handlers/student-tutor.php"],
        "Schedule" => [ROOT . "/forms/form-handlers/student-class-booking.php", ROOT . "/forms/form-handlers/add-new-class.php"],
        "Subjects" => [ROOT . "/forms/form-handlers/subjects.php"],
        default => []
    };

    // form handlers run before any HTML is sent, so they can redirect back to the page afterwards
    foreach($formHandlers as $fh){
        require_once($fh);
    }

    $pageTitle = "$page | Grinds Booking Admin System";

    $pageDescription = match($page){
        "Dashboard" => "Overview of bookings, schedules, tutors and student activity in the Grinds Booking Admin System.",
        "Students" => "Manage student profiles within the grinds booking system.",
        "Tutors" => "Manage tutor profiles within the grinds booking system.",
        "Schedule" => "Create and manage class schedules, room allocations and time slots for all grinds sessions.",
        "Subjects" => "Organise and manage subjects offered in the system, including assignments to tutors and classes.",
        "Login" => "Sign in to access the Grinds Booking Admin System and manage students, tutors, schedules and subjects.",
        default => "Grinds Booking Admin System."
    };

    $pageKeyWords = match($page){
        "Dashboard" => "grinds admin dashboard, booking system overview, education management system, tutor scheduling dashboard, student management admin, class scheduling overview",
        "Students" => "student management system, student profiles admin, enrolment tracking, grinds booking students, education database students, class registration system",
        "Tutors" => "tutor management system, tutor availability scheduling, teacher admin panel, grinds tutor system, staff scheduling system, tutor class assignments",
        "Schedule" => "class scheduling system, timetable management, room booking system, time slot scheduler, grinds schedule planner, education timetable admin",
        "Subjects" => "subject management system, curriculum administration, subject allocation system, grinds subjects list, education course management, class subject setup",
        "Login" => "login, grinds admin, education system, tutor booking, student management, schedule system",
        default => "grinds booking system"
    };

    if($page !== "Login"){

        $badge = match($page){
            "Students" => GetActive("Students") . " Active Students",
            "Tutors" => GetActive("Tutors") . " Active Tutors",
            "Subjects" => getSubjectCount() . " Subjects",
            default => date("F Y")
        };
    }


?>
