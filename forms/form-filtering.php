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
    $room = $_GET['id'];

    $freeslots = getFreeScheduleSlots($room);

    foreach ($freeslots as $day => $times){
        if (!empty($times)){
            $daynum = $day + 1;
            $dayname = GetDay($daynum);
            echo "<option value='$daynum'>$dayname</option>";
        }
    }
}
if(isset($_GET['action']) && $_GET['action'] === "dayChanged"){
    $daynum = $_GET['id'];
    $room = $_GET['room'];

    $sem = $_SESSION['semester']??getCurrentSemester();
    $free = getFreeTimes($daynum, $room, $sem);

    foreach($free as $f){
        echo "<option value='$f'>$f:00</option>";
    }
}
?>