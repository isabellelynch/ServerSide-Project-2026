<?php
require_once(ROOT . "/database-interactions/general.php");
require_once(ROOT . "/database-interactions/students.php");
require_once(ROOT . "/database-interactions/tutors.php");
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

            if($table === "Tutors"){
                $rate = trim($_POST['rate'])??"";
            }
            if($firstname === "" || $surname === "" || $email === "" || $phone === "" || $rate === ""){
                errorHandler("All fields must be entered to continue.");
            }
            elseif(ValidName($firstname, "Firstname") !== "Valid"){
                errorHandler(ValidName($firstname, "Firstname"));
            }
            elseif(ValidName($surname, "Surname") !== "Valid"){
                errorHandler(ValidName($surname, "Surname"));
            }
            elseif(ValidEmail($email) !== "Valid"){
                errorHandler(ValidEmail($email));
            }
            elseif(ValidPhoneNumber($phone) !== "Valid"){
                errorHandler(ValidPhoneNumber($phone));
            }

            $personArray = [];
            $personArray['name'] = $firstname;
            $personArray['surname'] = $surname;
            $personArray['email'] = $email;
            $personArray['phone'] = $phone;

            if($_POST['activeForm'] === "new"){
                if($table == "Students" && doesEmailExist($email) !== false ||
                    $table == "Tutors" && doesTutorEmailExist($email) !== false){
                    errorHandler("$person with the email $email already exists on our system.");
                }
                else{
                    if($person == "Student"){
                        AddStudent($personArray);
                    }
                    else if($person == "Tutor"){
                        $personArray['rate'] = $rate;
                        AddTutor($personArray);
                    }
                    successMsg("$firstname $surname successfully added as a $person.");
                }
            }
            if($_POST['activeForm'] === "update"){
                $id = trim($_POST['update-id'])??'';
                if($person == "Student"){
                    $personArray['id'] = $id;
                    UpdateStudent($personArray);
                }
                else if($person == "Tutor"){
                    $personArray['rate'] = $rate;
                    UpdateTutor($personArray);
                }
                successMsg("$firstname $surname has been updated successfully");
            }
        }
        else if($_POST['activeForm'] === "delete"){
            $id = trim($_POST['remove-id'])??'';
            if($person == "Student"){
                PermanentlyRemoveStudent($id);
            }
            else if($person == "Tutor"){
                PermanentlyRemoveTutor($id);
            }
            successMsg("$person has been removed successfully");
        }
        
    }

}

?>