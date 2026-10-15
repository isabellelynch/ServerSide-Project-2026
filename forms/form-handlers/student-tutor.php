<?php
require_once(ROOT . "/database-interactions/general.php");
require_once(ROOT . "/database-interactions/students.php");
require_once(ROOT . "/database-interactions/tutors.php");
require_once(ROOT . "/database-interactions/subjects.php");
require_once(ROOT . "/database-interactions/bookings.php");
require_once(ROOT . "/include-for-functions/Validation.php");

$table = getCurrentPage();
$person = substr($table, 0, -1);

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn'])){
        $activeForm = $_POST['activeForm'] ?? "";

        if($activeForm === "new" || $activeForm === "update"){
            $firstname = trim($_POST['firstname'] ?? "");
            $surname = trim($_POST['surname'] ?? "");
            $email = trim($_POST['email'] ?? "");
            $phone = trim($_POST['phone'] ?? "");
            $rate = "";
            $subject = "";

            $_SESSION['form-data'] = [
                'name' => $firstname,
                'surname' => $surname,
                'email' => $email,
                'phone' => $phone
            ];

            if($table === "Tutors"){
                $rate = trim($_POST['rate'] ?? "");
                $subject = trim($_POST['subject'] ?? "");
                $_SESSION['form-data']['rate'] = $rate;
                $_SESSION['form-data']['subject'] = $subject;
            }

            if($firstname === "" || $surname === "" || $email === "" || $phone === "" ||
               ($table === "Tutors" && ($rate === "" || $subject === ""))){
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
            elseif($table === "Tutors" && !isValidRateCode($rate)){
                errorHandler("Please choose a valid rate.");
            }
            elseif($table === "Tutors" && !doesSubjectExist($subject)){
                errorHandler("Please choose a valid subject.");
            }

            try{
                if($activeForm === "new"){
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

                if($activeForm === "update"){
                    $id = (int)trim($_POST['update-id'] ?? '0');
                    if($id <= 0 || !Exists($table, $id)){
                        errorHandler("$person could not be found, please try again.");
                    }

                    // the new email can't belong to someone else
                    if($person == "Student" && isEmailUsedByOtherStudent($email, $id) ||
                       $person == "Tutor" && isEmailUsedByOtherTutor($email, $id)){
                        errorHandler("Another " . strtolower($person) . " already uses the email $email.");
                    }

                    $_SESSION['form-data']['id'] = $id;
                    if($person == "Student"){
                        UpdateStudent($_SESSION['form-data']);
                    }
                    else if($person == "Tutor"){
                        UpdateTutor($_SESSION['form-data']);
                    }
                    unset($_SESSION['form-data']);
                    successMsg("$firstname $surname has been updated successfully");
                }
            }catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

        }
        else if($activeForm === "delete"){
            try{
                $id = (int)trim($_POST['remove-id'] ?? '0');
                if($id <= 0 || !Exists($table, $id)){
                    errorHandler("$person could not be found, please try again.");
                }
                if($person == "Student"){
                    RemoveStudentFromClasses($id);
                    RemoveStudentBookings($id);
                    PermanentlyRemoveStudent($id);
                }
                else if($person == "Tutor"){
                    // deleting a tutor would leave their classes (and bookings) without a tutor
                    if(tutorHasClasses($id)){
                        errorHandler("This tutor has classes on the schedule, so they can't be removed. " .
                                     "Set them to Inactive instead.");
                    }
                    PermanentlyRemoveTutor($id);
                }
                unset($_SESSION['form-data']);
                successMsg("$person has been removed successfully");
            }catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }

    }

}

?>
