<?php
require_once(ROOT . "/database-interactions/classes.php");
require_once(ROOT . "/database-interactions/students.php");
require_once(ROOT . "/database-interactions/bookings.php");
require_once(ROOT . "/database-interactions/general.php");
global $page;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && isset($_POST['classid']) && $_POST['activeForm'] === "add"){
        $_SESSION['other-form'][$page] = true;
        $_SESSION['header-form'][$page] = false;
        $_SESSION['updating'][$page] = true;
        $_SESSION['class'] = $_POST['classid'];
        $classid = $_SESSION['class'];
        $email = $_POST['student-email'];
        if($email == ""){
            errorHandler("Please enter an email to add a student.");
        }

        if(!isClassFull($classid)){
            $studentID = doesEmailExist($email);
            if($studentID != false){
                if(hasStudentBookedClass($studentID, $classid) !== false){
                    incrementEnrollment($classid);
                    createBooking($studentID, $classid);
                    $_SESSION['updating'][$page] = false;
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