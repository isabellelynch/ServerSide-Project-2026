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
        if(doesUserExist($email, $password)){
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
                                 WHERE Email = :u AND 
                                 Password = :p");
        $stmt -> bindValue(":u", $email);
        $stmt -> bindValue(":p", $password);
        $stmt -> execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $result['Count'];
        if($count === 1){
            return true;
        }
        else{
            return false;
        }
    }

    function getName($email, $password){
        global $pdo;
        $stmt = $pdo -> prepare("SELECT Name 
                                 FROM Admin 
                                 WHERE Email = :e AND 
                                 Password = :p");
        $stmt -> bindValue(":e", $email);
        $stmt -> bindValue(":p", $password);
        $stmt -> execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['Name'];
    }
?>