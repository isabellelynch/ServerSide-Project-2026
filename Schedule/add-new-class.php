<?php
require_once(ROOT . "/database-interactions/tutors.php");

global $msg, $msgtitle;
$msgtitle = "Error";

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && $_POST['activeForm'] === "new-class"){
        $tutor = $_POST['FormTutor']??"";
        $subject = $_POST['FormSubject']??"";
        $room = $_POST['FormRoom']??"";
        $day = $_POST['FormDay']??"";
        $time = $_POST['FormTime']??"";

        if(ensureTutorTeachesSubject($tutor, $subject) === 1){

        }
        else{

        }
    }
}


?>