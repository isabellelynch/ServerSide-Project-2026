<?php
require_once(ROOT . "/include-for-functions/Validation.php");
require_once(ROOT . "/database-interactions/make-connection.php");
require_once(ROOT . "/database-interactions/general.php");

global $pdo, $page, $firstname, $surname, $email;
$firstname = isset($_POST['firstname'])?trim($_POST['firstname']):'';
$surname = isset($_POST['surname'])?trim($_POST['surname']):'';
$email = isset($_POST['email'])?trim($_POST['email']):'';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && $_POST['activeForm'] === "new-admin"){
        $AdminPassword = trim($_POST['admin-password']??"");
        $confirm = trim($_POST['admin-password-confirm']??"");
        $AdminHash = password_hash($AdminPassword, PASSWORD_DEFAULT);


        if($firstname === "" || $surname === "" || $email === "" || $AdminPassword === ""){
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
        elseif($AdminPassword !== $confirm){
            errorHandler("Passwords must match to continue.");
        }
        elseif(!ValidatePassword($AdminPassword)){
            errorHandler("Password must contain more than 8 digits, one uppercase, one lowercase and a special character");
        }

        if(isEmailUnique($email)){
            addAdminMember($firstname, $surname, $email, $AdminHash);
            successMsg("$firstname $surname successfully added as an admin member.");
        }
        else{
            errorHandler("Email already exists as an admin member");
        }
    }
}

function addAdminMember($firstname, $surname, $email, $password){
    global $pdo;
    try{
        $stmt = $pdo -> prepare("INSERT INTO Admin (Firstname, Surname, Email, Password) 
                             VALUES (:f, :s, :e, :p)");
        $stmt -> execute([
            ":f" => $firstname,
            ":s" => $surname,
            ":e" => $email,
            ":p" => $password
        ]); 
    }
    catch(PDOException $e){
        $output = "Database server error : " . $e->getMessage();
        echo $output;
    }
}

function isEmailUnique($email){
    global $pdo;
    $stmt = $pdo -> prepare("SELECT COUNT(*) AS Count 
                             FROM Admin 
                             WHERE Email = :e");
    $stmt -> execute([
        ":e" => $email
    ]); 
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    if($result['Count'] != 0){
        return false;
    }
    else{
        return true;
    }
}
?>