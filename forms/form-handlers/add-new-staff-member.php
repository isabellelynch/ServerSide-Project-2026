<?php
require_once(ROOT . "/include-for-functions/Validation.php");

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && isset($_POST['admin-password']) && $_POST['activeForm'] === "new-admin"){
        $firstname = $_POST['firstname']??"";
        $surname = $_POST['surname']??"";
        $email = $_POST['email']??"";
        $password = $_POST['admin-password']??"";
        if($firstname === "" || $surname === "" || $email === "" || $password === ""){
            $_SESSION['msgtitle'] = "Error";
            $_SESSION['msg'] = "All fields must be entered to continue.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        if(ValidName($firstname, "Firstname") !== "Valid"){
            $_SESSION['msgtitle'] = "Error";
            $_SESSION['msg'] = ValidName($firstname, "Firstname");
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        if(ValidName($surname, "Surname") !== "Valid"){
            $_SESSION['msgtitle'] = "Error";
            $_SESSION['msg'] = ValidName($surname, "Surname");
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
        if(ValidEmail($email) !== "Valid"){
            $_SESSION['msgtitle'] = "Error";
            $_SESSION['msg'] = ValidName($email);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
        if(!ValidatePassword($password)){
            $_SESSION['msgtitle'] = "Error";
            $_SESSION['msg'] = "Password must be in correct formation to continue.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

    }
}
?>