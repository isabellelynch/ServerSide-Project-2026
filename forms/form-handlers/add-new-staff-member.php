<?php
require_once(ROOT . "/include-for-functions/Validation.php");
require_once(ROOT . "/database-interactions/make-connection.php");
require_once(ROOT . "/database-interactions/general.php");
global $pdo, $page;



if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && isset($_POST['admin-password']) && $_POST['activeForm'] === "new-admin"){
        $_SESSION['header-form'][$page] = true;
        $_SESSION['other-form'][$page] = false;

        $_SESSION['admin-firstname'] = trim($_POST['firstname']??"");
        $AdminFirstname = $_SESSION['admin-firstname'];

        $_SESSION['admin-surname'] = trim($_POST['surname']??"");
        $AdminSurname = $_SESSION['admin-surname'];

        $_SESSION['admin-email'] = trim($_POST['email']??"");
        $AdminEmail = $_SESSION['admin-email'];

        $AdminPassword = trim($_POST['admin-password']??"");
        $confirm = trim($_POST['admin-password-confirm']??"");
        $AdminHash = password_hash($password, PASSWORD_DEFAULT);


        if($AdminFirstname === "" || $AdminSurname === "" || $AdminEmail === "" || $AdminPassword === ""){
            errorHandler("All fields must be entered to continue.");
        }

        elseif(ValidName($AdminFirstname, "Firstname") !== "Valid"){
            errorHandler(ValidName($AdminFirstname, "Firstname"));
        }

        elseif(ValidName($AdminSurname, "Surname") !== "Valid"){
            errorHandler(ValidName($AdminSurname, "Surname"));
        }
        elseif(ValidEmail($AdminEmail) !== "Valid"){
            errorHandler(ValidEmail($AdminEmail));
        }
        elseif($AdminPassword !== $confirm){
            errorHandler("Passwords must match to continue.");
        }
        elseif(!ValidatePassword($AdminPassword)){
            errorHandler("Password must contain more than 8 digits, one uppercase, one lowercase and a special character");
        }


        if(isEmailUnique($AdminEmail)){
            addAdminMember($AdminFirstname, $AdminSurname, $AdminEmail, $AdminHash);
            unset($_SESSION['admin-firstname'], $_SESSION['admin-surname'], $_SESSION['admin-email']);
            successMsg("$AdminFirstname $AdminSurname successfully added as an admin member.");
            
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