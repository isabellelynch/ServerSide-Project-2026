<?php
    require_once("database-interactions/make-connection.php");
    global $pdo;

    if($_SERVER['REQUEST_METHOD'] === 'POST' &&
        isset($_POST['login-btn'])){
            $password = $_POST['password'];
            $email = $_POST['email'];
            if(ValidLogin($email, $password)){
                unset($_SESSION['msg']);
                unset($_SESSION['msgtitle']);
                header("Location:Dashboard/Dashboard.php");
                exit;
            }
        }

    function ValidLogin($email, $password){
        if(doesUserExist($email, $password) && isPasswordCorrect($password, $email)){
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['name'] = getName($email, $password);
            return true;
        }
        else{
            $_SESSION['msgtitle'] = "Invalid Login attempt";
            $_SESSION['msg'] = "Incorrect username/password please try again.";
            return false;
        }
    }

    function doesUserExist($email, $password){
        global $pdo;
        $stmt = $pdo -> prepare("SELECT COUNT(*) AS Count 
                                 FROM Admin 
                                 WHERE Email = :u");
        $stmt -> bindValue(":u", $email);
        $stmt -> execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result['Count'] === 1){
            return true;
        }
        else{
            return false;
        }
    }

    function getName($email, $password){
        global $pdo;
        $stmt = $pdo -> prepare("SELECT FirstName, Surname  
                                 FROM Admin 
                                 WHERE Email = :e");
        $stmt -> bindValue(":e", $email);
        $stmt -> execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['FirstName'] . " " . $result['Surname'];
    }

    function isPasswordCorrect($p, $e){
        global $pdo;
        $stmt = $pdo -> prepare("SELECT Password 
                                 FROM Admin 
                                 WHERE Email = :e");
        $stmt -> bindValue(":e", $e);
        $stmt -> execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $hash = $result['Password'];
        if(password_verify($p, $hash)){
            return true;
        }
        else{
            return false;
        }
    }
?>