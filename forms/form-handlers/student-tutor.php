<?php
require_once(ROOT . "/database-interactions/general.php");
require_once(ROOT . "/database-interactions/students.php");
require_once(ROOT . "/database-interactions/tutors.php");
require_once(ROOT . "/database-interactions/bookings.php");
require_once(ROOT . "/include-for-functions/Validation.php");

$table = getCurrentPage();
$person = substr($table, 0, -1);

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn'])){
        if($_POST['activeForm'] === "new" || $_POST['activeForm'] === "update"){
            $firstname = trim($_POST['firstname'])??"";
            $surname = trim($_POST['surname'])??"";
            $email = trim($_POST['email'])??"";
            $phone = trim($_POST['phone'])??"";

            $_SESSION['form-data'] = [
                'name' => $firstname,
                'surname' => $surname,
                'email' => $email,
                'phone' => $phone
            ];

            if($table === "Tutors"){
                $rate = trim($_POST['rate'])??"";
                $_SESSION['form-data']['rate'] = $rate;
            }
            if($firstname === "" || $surname === "" || $email === "" || $phone === "" || $rate === ""){
                errorHandler("All fields must be entered to continue.");
            }
            elseif(ValidName($firstname, "Firstname") !== "Valid"){
                unset($_SESSION['form-data']['name']);
                errorHandler(ValidName($firstname, "Firstname"));
            }
            elseif(ValidName($surname, "Surname") !== "Valid"){
                unset($_SESSION['form-data']['surname']);
                errorHandler(ValidName($surname, "Surname"));
            }
            elseif(ValidEmail($email) !== "Valid"){
                unset($_SESSION['form-data']['email']);
                errorHandler(ValidEmail($email));
            }
            elseif(ValidPhoneNumber($phone) !== "Valid"){
                unset($_SESSION['form-data']['phone']);
                errorHandler(ValidPhoneNumber($phone));
            }

            if($_POST['activeForm'] === "new"){
                if($table == "Students" && doesEmailExist($email) !== false ||
                    $table == "Tutors" && doesTutorEmailExist($email) !== false){
                    errorHandler("$person with the email $email already exists on our system.");
                }
                else{
                    if($person == "Student"){
                        AddStudent($_SESSION['form-data']);
                    }
                    else if($person == "Tutor"){
                        AddTutor($_SESSION['form-data']);
                    }
                    unset($_SESSION['form-data']);
                    successMsg("$firstname $surname successfully added as a $person.");
                }
            }

            if($_POST['activeForm'] === "update"){
                $id = trim($_POST['update-id'])??'';
                if($person == "Student"){
                    $_SESSION['form-data']['id'] = $id;
                    UpdateStudent($_SESSION['form-data']);
                }
                else if($person == "Tutor"){
                    $_SESSION['form-data']['rate'] = $rate;
                    UpdateTutor($_SESSION['form-data']);
                }
                unset($_SESSION['form-data']);
                successMsg("$firstname $surname has been updated successfully");
            }
        }
        else if($_POST['activeForm'] === "delete"){
            $id = trim($_POST['remove-id'])??'';
            if($person == "Student"){
                RemoveStudentFromClasses($id);
                RemoveStudentBookings($id);
                PermanentlyRemoveStudent($id);
            }
            else if($person == "Tutor"){
                PermanentlyRemoveTutor($id);
            }
            unset($_SESSION['form-data']);
            successMsg("$person has been removed successfully");
        }
        
    }

}

?>