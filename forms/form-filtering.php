<?php
require_once("../database-interactions/subjects.php");
require_once("../database-interactions/tutors.php");
require_once("../include-for-functions/day-mapper.php");
require_once("../Schedule/schedule-handling.php");

if(isset($_GET['action']) && $_GET['action'] === 'tutorChanged'){
    $id = $_GET['id'];
    $subject = getTutorSubject($id);
    echo "<option>$subject</option>";
}

if(isset($_GET['action']) && $_GET['action'] === 'subjectChanged'){
    $id = $_GET['id'];
    $tutors = GetSpecificTutorNames($id);
    foreach($tutors as $t){
        $tutorid = $t['TutorID'];
        $name = $t['FirstName'] . " " . $t['Surname'];
        echo "<option value = '$tutorid'>$name</option>";
    }
}

if(isset($_GET['action']) && $_GET['action'] === "roomChanged"){
    $_SESSION['room'] = $_GET['id'];
    $_SESSION['free-slots'] = getFreeScheduleSlots($_SESSION['room']);
    foreach ($_SESSION['free-slots'] as $day => $times){
        if (!empty($times)){
            $daynum = GetDayNum($day);
            echo "<option value='$daynum'>$day</option>";
        }
    }
}
if(isset($_GET['action']) && $_GET['action'] === "dayChanged"){
    $daynum = $_GET['id'];
    $index = GetDay($daynum);
    
    foreach($_SESSION['free-slots'][$index] as $t){
        echo "<option>$t</option>";
    } 
}
?>