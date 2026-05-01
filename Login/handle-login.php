<?php
    require_once("database-interactions/make-connection.php");
    global $pdo;

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login-btn'])){
            $password = trim($_POST['password'])??'';
            $email = trim($_POST['email'])??'';

            if($email === "" || $password === ""){
                $_SESSION['msgtitle'] = "Invalid Login attempt";
                $_SESSION['msg'] = "Username and Password must be entered, please try again.";
                header("Location:" . $_SERVER['PHP_SELF']);
                exit;
            }

            if(ValidLogin($email, $password)){
                unset($_SESSION['msg']);
                unset($_SESSION['msgtitle']);
                header("Location:Dashboard/Dashboard.php");
                exit;
            }
        }

    function ValidLogin(string $email, string $password):bool{
        global $pdo;
        try{
            $stmt = $pdo->prepare("SELECT FirstName, Surname, Password 
                                   FROM Admin 
                                   WHERE Email = :e");

            $stmt->execute([":e" => $email]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['Password'])) {
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $user['FirstName'] . " " . $user['Surname'];
                unset($_SESSION['msg'], $_SESSION['msgtitle']);
                return true;
            }

            $_SESSION['msgtitle'] = "Invalid Login attempt";
            $_SESSION['msg'] = "Incorrect username/password combination, please try again.";
            return false;  
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
        
    }

?>