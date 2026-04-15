<?php
require_once(ROOT . "/include-for-functions/Validation.php");
require_once(ROOT . "/database-interactions/make-connection.php");
require_once(ROOT . "/database-interactions/general.php");
global $pdo;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && isset($_POST['admin-password']) && $_POST['activeForm'] === "new-admin"){
        $_SESSION['header-form'] = true;
        $_SESSION['other-form'] = false;
        $_SESSION['updating'] = true;

        $firstname = trim($_POST['firstname']??"");
        $_SESSION['new-firstname'] = $firstname;

        $surname = trim($_POST['surname']??"");
        $_SESSION['new-surname'] = $surname;

        $email = trim($_POST['email']??"");
        $_SESSION['new-email'] = $email;

        $password = trim($_POST['admin-password']??"");
        $confirm = trim($_POST['admin-password-confirm']??"");
        $hash = password_hash($password, PASSWORD_DEFAULT);


        if($firstname === "" || $surname === "" || $email === "" || $password === ""){
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
        elseif($password !== $confirm){
            errorHandler("Passwords must match to continue.");
        }
        elseif(!ValidatePassword($password)){
            errorHandler("Password must contain more than 8 digits, one uppercase, one lowercase and a special character");
        }


        if(isEmailUnique($email)){
            addAdminMember($firstname, $surname, $email, $hash);
            unset($_SESSION['header-form']);
            unset($_SESSION['other-form']);
            unset($_SESSION['updating']);
            unset($_SESSION['new-firstname']);
            unset($_SESSION['new-surname']);
            unset($_SESSION['new-email']);
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
        $stmt -> bindValue(":f", $firstname);
        $stmt -> bindValue(":s", $surname);
        $stmt -> bindValue(":e", $email);
        $stmt -> bindValue(":p", $password);
        $stmt -> execute(); 
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
    $stmt -> bindValue(":e", $email);
    $stmt -> execute(); 
    $result = $stmt -> fetch(PDO::FETCH_ASSOC);
    if($result['Count'] != 0){
        return false;
    }
    else{
        return true;
    }
}
?>