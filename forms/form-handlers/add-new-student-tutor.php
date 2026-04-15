<?php
require_once(ROOT . "/database-interactions/general.php");
require_once(ROOT . "/include-for-functions/Validation.php");

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && $_POST['activeForm'] === "new"){
        $table = getCurrentPage();

        $firstname = trim($_POST['firstname']??"");
        $surname = trim($_POST['surname']??"");
        $email = trim($_POST['email']??"");
        $phone = trim($_POST['phone']??"");

        if($table === "Tutors"){
            $rate = trim($_POST['rate']??"");
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

    }
}

?>