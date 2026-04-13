<?php 
require_once("../database-interactions/classes.php");
require_once("semesters.php");
require_once("../database-interactions/rooms.php");

global $semesters, $days, $times;

function generateSchedule(){
    global $semesters;
    $s = [];
    $sem = $semesters[$_SESSION['semester']]['number'];
    $room = $_SESSION['room'];
    $result = SelectAllClasses($room, $sem);
    foreach($result as $row){
        $day = $row['Day'];
        $time = $row['Time'];
        $s[$day][$time] = [
            'class' => $row['Description'],
            'tutor' => $row['FirstName'] . " " . $row['Surname'],
            'enrollment' => $row['CurrentEnrollment'],
            'capacity' => $row['Capacity'],
            'id' => $row['ClassID']
        ];
    }

    return $s;
}


function getFreeScheduleSlots($room){
    global $days, $times;
    $_SESSION['room'] = $room;
    $schedule = generateSchedule();
    $freeSlots = [];
    foreach ($days as $day) {
        foreach ($times as $time) {
            if (!isset($schedule[$day][$time])) {
                $freeSlots[$day][] = $time;
            }
        }
    }
    return $freeSlots;
}



//handle the changing of the room via buttons on the top of the schedule
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['previous-room'])){
        $_SESSION['room']--;
        if($_SESSION['room'] <= 0){
            $_SESSION['room'] = RoomCount();
        }  
    }
    if(isset($_POST['next-room'])){
        $_SESSION['room']++;
        if($_SESSION['room'] > RoomCount()){
            $_SESSION['room'] = 1;
        }
    }
}
?>