<?php
require_once(ROOT . "/database-interactions/tutors.php");

global $msg, $msgtitle;
$msgtitle = "Error";

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && $_POST['activeForm'] === "new-class"){
        $_SESSION['new-class'] = true;
        $tutor = $_POST['FormTutor']??"";
        if($tutor === "") {
            $msg = "Tutor must be chosen.";
            return;
        }

        $subject = $_POST['FormSubject']??"";
        if($subject === "") {
            $msg = "Subject must be chosen.";
            return;
        }

        $room = $_POST['FormRoom']??"";
        if($room === "") {
            $msg = "Room must be chosen.";
            return;
        }

        $day = $_POST['FormDay']??"";
        if($day === "") {
            $msg = "Day must be chosen.";
            return;
        }
        
        $time = $_POST['FormTime']??"";
        if($time === "") {
            $msg = "Time must be chosen.";
            return;
        }

        if(ensureTutorTeachesSubject($tutor, $subject) === 1){
            if(isRoomFree($day, $time, $room) === true){
                $_SESSION['new-class'] = false;
            }
            else{
                $msg = "The chosen room is not free at the chosen day and time.";
            }
        }
        else{
            $msg = "Chosen tutor does not teach chosen subject";
        }
    }
}


?>