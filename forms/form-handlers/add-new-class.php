<?php
require_once(ROOT . "/database-interactions/tutors.php");
require_once(ROOT . "/database-interactions/classes.php");
require_once(ROOT . "/database-interactions/rooms.php");

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && $_POST['activeForm'] === "new-class"){
        var_dump($_POST);
        $tutor = $_POST['FormTutor']??"";
        if($tutor === "") errorHandler("Tutor must be chosen.");
        
        $subject = $_POST['FormSubject']??"";
        if($subject === "") errorHandler("Subject must be chosen.");

        $room = $_POST['FormRoom']??"";
        if($room === "") errorHandler("Room must be chosen.");

        $day = $_POST['FormDay']??"";
        if($day === "") errorHandler("Day must be chosen.");
        
        $time = $_POST['FormTime']??"";
        if($time === "") errorHandler("Time must be chosen.");

        if(ensureTutorTeachesSubject($tutor, $subject) !== 1) errorHandler("Chosen tutor does not teach chosen subject");

        if(isRoomBooked($day, $time, $room)) errorHandler("The chosen room is not free at the chosen day and time.");
        
        if(tutorAlreadyBooked($tutor, $day, $time)) errorHandler("The chosen tutor already has a class at that day/time.");
        
        $sem = $semesters[$_SESSION['semester']];

        $class = [];
        $class['tutor'] = $tutor;
        $class['day'] = $day;
        $class['time'] = $time;
        $class['room'] = $room;
        $class['semester'] = $sem['number'];

        addNewClass($class);
    }
}


?>