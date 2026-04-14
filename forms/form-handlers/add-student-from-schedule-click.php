<?php
require_once(ROOT . "/database-interactions/classes.php");
require_once(ROOT . "/database-interactions/students.php");
require_once(ROOT . "/database-interactions/bookings.php");
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && isset($_POST['classid']) && $_POST['activeForm'] === "add"){
        $classid = $_POST['classid'];
        $email = $_POST['student-email'];
        if($email == ""){
            $_SESSION['msgtitle'] = "Error";
            $_SESSION['msg'] = "Please enter an email to add a student.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        $class = getClass($classid);
        

        if($class){
            if(!isClassFull($classid)){
                $studentID = doesEmailExist($email);
                if($studentID){
                    incrementEnrollment($classid);
                    createBooking($studentID, $classid);
                    $_SESSION['msg'] = "Student sucessfully added to the class.";
                    $_SESSION['msgtitle'] = "Success";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit;
                }
                else{
                    $_SESSION['msgtitle'] = "Error";
                    $_SESSION['msg'] = "Student cannot be added to the class because their email is not on the system,
                              please add them to the system and try again.";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit;
                }
            }
            else{
                $_SESSION['msgtitle'] = "Error";
                $_SESSION['msg'] = "Student cannot be added to the class as this class is full";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
        }
    }
}
?>