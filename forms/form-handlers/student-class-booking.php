<?php
require_once(ROOT . "/database-interactions/classes.php");
require_once(ROOT . "/database-interactions/students.php");
require_once(ROOT . "/database-interactions/bookings.php");
require_once(ROOT . "/database-interactions/general.php");
global $page;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && isset($_POST['classid']) && ($_POST['activeForm'] ?? "") === "add"){
        $classid = (int)($_POST['classid'] ?? 0);
        $email = trim($_POST['student-email'] ?? '');

        $_SESSION['student-data'] = [
            'class' => $classid,
            'email' => $email
        ];

        if($email == ""){
            errorHandler("Please enter an email to add a student.");
        }
        if($classid <= 0 || getClass($classid) === false){
            errorHandler("Please choose a class on the schedule first.");
        }
        if(!isClassFull($classid)){

            // look up the ID of the student with this email
            $studentID = getStudentIdByEmail($email);

            if($studentID !== null){

                if(!isStudentActive($studentID)){
                    errorHandler("This student is set to Inactive, so they can't be booked into classes.");
                }

                if(!hasStudentBookedClass($studentID, $classid)){
                    incrementEnrollment($classid);
                    createBooking($studentID, $classid);
                    unset($_SESSION['student-data']);
                    successMsg("Student successfully added to the class.");
                }
                else{
                    errorHandler("Student has already booked this class");
                }
            }
            else{
                errorHandler("Student cannot be added to the class because their email is not on the system, please add them to the system and try again.");
            }
        }
        else{
            errorHandler("Student cannot be added to the class as this class is full");
        }
    }
}
?>
