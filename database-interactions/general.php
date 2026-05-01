<?php

require_once("make-connection.php");

global $pdo;

function QueryDatabase(string $sql):PDOStatement
{
    global $pdo;
    try
    {
        return $pdo->query($sql);
    }
    catch(Exception $e)
    {
        $output = "Unable to query the database : " . $e->getMessage();
        echo $output;
    }
}
    
function SelectAll(string $table):?array
{
    try{
        $sql = "SELECT * FROM $table";

        $result = QueryDatabase($sql);

        if ($result === null) {
            return null;
        }

        return $result->fetchAll(PDO::FETCH_ASSOC);

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}

function Exists(string $table, int $id):bool
{
    global $pdo;

    $tableID = substr($table, 0, -1) . "ID";

    try{
        $stmt = $pdo -> prepare("SELECT * 
                                FROM $table 
                                WHERE $tableID = :id");

        $stmt->execute([
            ':id' => $id
        ]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } 
}

function GetActive(string $table):?int{
    try{
        $sql = "SELECT COUNT(*) AS Count 
                FROM $table 
                WHERE Status = 'A'";

        $result = QueryDatabase($sql);

        if ($result) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            return (int) $row['Count'];
        }

        return 0;

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function UpdateStatus(string $table, int $id):void
{
    global $pdo;

    $tableID = substr($table, 0, -1) . "ID";
    try{
        if(Exists($table,$id) === true)
        {
            $sql = "UPDATE $table 
                    SET Status = CASE 
                    WHEN Status = 'A' THEN 'I' 
                    ELSE 'A'
                    END
                    WHERE $tableID = :id";
                    
            $stmt = $pdo -> prepare($sql); 
            $stmt->execute([
                ':id' => $id
            ]); 
        }
        else
        {
            echo "Student could not be found in the database";
        }
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function getCurrentPage():string{
    try{
        return str_replace(".php", "", basename($_SERVER['PHP_SELF']));
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function errorHandler(string $msg):void{
    $_SESSION['msgtitle'] = "Error";
    $_SESSION['msg'] = $msg;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

function successMsg(string $msg):void{
    $_SESSION['msgtitle'] = "Success";
    $_SESSION['msg'] = $msg;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
function addAdminMember(string $firstname, string $surname, string $email, string $password):void{
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

function isAdminEmailUnique(string $email):bool{
    global $pdo;
    try{
        $stmt = $pdo -> prepare("SELECT COUNT(*) AS Count 
                                FROM Admin 
                                WHERE Email = :e");
        $stmt -> execute([
            ":e" => $email
        ]); 

        $result = $stmt -> fetch(PDO::FETCH_ASSOC);

        return $result['Count'] == 0;
        
    }catch(PDOException $e){
        $output = "Database server error : " . $e->getMessage();
        echo $output;
    }
}
?>