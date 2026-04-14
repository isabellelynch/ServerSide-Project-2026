<?php
require_once(ROOT . "/include-for-functions/Validation.php");
require_once(ROOT . "/database-interactions/make-connection.php");
global $pdo;

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && isset($_POST['admin-password']) && $_POST['activeForm'] === "new-admin"){
        $firstname = trim($_POST['firstname']??"");
        $surname = trim($_POST['surname']??"");
        $email = trim($_POST['email']??"");
        $password = trim($_POST['admin-password']??"");

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
        if(isEmailUnique($email)){
            addAdminMember($firstname, $surname, $email, $hash);
            $_SESSION['msgtitle'] = "Success";
            $_SESSION['msg'] = "$firstname $surname successfully added as an admin member.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
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