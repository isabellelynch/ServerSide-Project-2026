<?php 
require_once("../database-interactions/classes.php");
require_once("../database-interactions/students.php");
require_once("../database-interactions/classes.php");
require_once("../database-interactions/bookings.php");
require_once("semesters.php");
require_once("../database-interactions/rooms.php");

global $semesters, $days, $times, $msg, $msgtitle;

$msgtitle = "Error";

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

//Add student to a class when class slot is clicked on timetable, using email
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && isset($_POST['classid']) && $_POST['activeForm'] === "add"){
        $classid = $_POST['classid'];
        $email = $_POST['email'];
        if($email == ""){
            $msg = "Please enter an email to add a student.";
            return;
        }

        $class = getClass($classid);

        if($class){
            if(!isClassFull($classid)){
                $studentID = doesEmailExist($email);
                if($studentID){
                    incrementEnrollment($classid);
                    createBooking($studentID, $classid);
                    $msg = "Student sucessfully added to the class.";
                    $msgtitle = "Success";
                }
                else{
                    $msg = "Student cannot be added to the class because their email is not on the system,
                              please add them to the system and try again.";
                }
            }
            else{
                $msg = "Student cannot be added to the class as this class is full";
            }
        }
    }
    
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