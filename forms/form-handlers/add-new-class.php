<?php
require_once(ROOT . "/database-interactions/tutors.php");
require_once(ROOT . "/database-interactions/classes.php");
require_once(ROOT . "/database-interactions/rooms.php");
require_once(ROOT . "/database-interactions/general.php");
require_once(ROOT . "/Schedule/semesters.php");

global $semesters;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && ($_POST['activeForm'] ?? "") === "new-class"){
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

        if(!ctype_digit((string)$day) || $day < 1 || $day > 5) errorHandler("Please choose a day from Monday to Friday.");
        if(!ctype_digit((string)$time) || $time < 9 || $time > 17) errorHandler("Please choose a time between 9:00 and 17:00.");
        if(getRoomCapacity((int)$room) === 0) errorHandler("Please choose a valid room.");

        if(!ensureTutorTeachesSubject((int)$tutor, $subject)) errorHandler("Chosen tutor does not teach chosen subject");
        
        $sem = $semesters[$_SESSION['semester']]['number'];

        if(isRoomBooked((int)$day, (int)$time, (int)$room, $sem)) errorHandler("The chosen room is not free at the chosen day and time.");

        if(tutorAlreadyBooked((int)$tutor, (int)$day, (int)$time, $sem)) errorHandler("The chosen tutor already has a class at that day/time.");

        $class = [
            'tutor' => $tutor,
            'day' => $day,
            'time' => $time,
            'room' => $room,
            'semester' => $sem
        ];

        if(doesClassExist($class)) errorHandler("There is already a class scheduled during this time period.");

        addNewClass($class);

        successMsg("Class added successfully");
    }
}


?>