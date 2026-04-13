//Add student to a class when class slot is clicked on timetable, using email
<?php
require_once("../database-interactions/classes.php");
require_once("../database-interactions/students.php");
require_once("../database-interactions/bookings.php");
global $msg, $msgtitle;

$msgtitle = "Error";

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
?>