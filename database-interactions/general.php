<?php

require_once("make-connection.php");

global $pdo;

function QueryDatabase(string $sql)
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
    
function SelectAll($table)
{
    try{
        $sql = "SELECT * FROM $table";

        $result = QueryDatabase($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}

function Exists($table,$id)
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
        
        return (count($stmt->fetch(PDO::FETCH_ASSOC))>0);

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } 
}

function GetActive($table){
    try{
        $sql = "SELECT COUNT(*) AS Count 
                FROM $table 
                WHERE Status = 'A'";

        $result = QueryDatabase($sql);

        while ($row=$result->fetch(PDO::FETCH_ASSOC)){
            return $row['Count'];
        }
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function UpdateStatus($table, $id) 
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

function getCurrentPage(){
    try{
        return str_replace(".php", "", basename($_SERVER['PHP_SELF']));
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function errorHandler($msg){
    $_SESSION['msgtitle'] = "Error";
    $_SESSION['msg'] = $msg;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

function successMsg($msg){
    $_SESSION['msgtitle'] = "Success";
    $_SESSION['msg'] = $msg;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

?>