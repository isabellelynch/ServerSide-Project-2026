<?php
require_once(ROOT . "/database-interactions/classes.php");
require_once(ROOT . "/database-interactions/students.php");
require_once(ROOT . "/database-interactions/bookings.php");
require_once(ROOT . "/database-interactions/general.php");
global $page;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && isset($_POST['classid']) && $_POST['activeForm'] === "add"){
        $classid = $_POST['classid'] ?? '';
        $email = trim($_POST['student-email'] ?? '');

        $_SESSION['student-data'] = [
            'class' => $classid,
            'email' => $email
        ];

        if($email == ""){
            errorHandler("Please enter an email to add a student.");
        }
        if(!isClassFull($classid)){
            $studentID = doesEmailExist($email);
            if($studentID != false){
                if(!hasStudentBookedClass($studentID, $classid)){
                    incrementEnrollment($classid);
                    createBooking($studentID, $classid);
                    unset($_SESSION['student-data']);
                    successMsg("Student sucessfully added to the class.");
                }
                else{
                    errorHandler("Student has already booked this class");
                }
            }
            else{
                errorHandler("Student cannot be added to the class because their email is not on the system,
                            please add them to the system and try again.");
            }
        }
        else{
            errorHandler("Student cannot be added to the class as this class is full");
        }
    }
}
?>