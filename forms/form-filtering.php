<?php
require_once("../database-interactions/subjects.php");
require_once("../database-interactions/tutors.php");
require_once("../include-for-functions/day-mapper.php");
require_once("../Schedule/schedule-handling.php");

$room = "";

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
    global $room;
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
    global $room;
    
    $daynum = $_GET['id'];
    $free = getFreeTimes($daynum, $room, 1);
    foreach($free as $f){
        echo "<option value='$f'>$f:00</option>";
    }
    


}
?>