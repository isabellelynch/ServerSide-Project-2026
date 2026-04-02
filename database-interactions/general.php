<?php
require_once(ROOT . "/database-interactions/make-connection.php");

global $pdo;

function QueryDatabase(string $sql)
{
    global $pdo;
    try
    {
        return $pdo->query($sql);
    }
    catch(PDOException $e)
    {
        $output = "Unable to query the database : " . $e->getMessage();
        echo $output;
    }
}
    
function SelectAll($table)
{
    $sql = "SELECT * FROM $table";
    $result = QueryDatabase($sql);
    return $result->fetchAll(PDO::FETCH_ASSOC);
}

function Exists($table,$id)
{
    global $pdo;
    $tableID = substr($table, 0, -1) . "ID";
    
    $sql = "SELECT * FROM $table WHERE $tableID = :id";
    
    $exists = $pdo->prepare($sql);

    $exists->bindValue(':id', $id);
    $exists->execute();
    
    if(count($exists->fetch(PDO::FETCH_ASSOC))>0){
        return true;
    }
    return false;
}

function GetActive($table){
    $sql = "SELECT COUNT(*) AS Count FROM $table WHERE Status = 'A'";
    $result = QueryDatabase($sql);
    while ($row=$result->fetch(PDO::FETCH_ASSOC)){
        return $row['Count'];
    }
}

function UpdateStatus($table, $id) 
{
    global $pdo;

    $tableID = substr($table, 0, -1) . "ID";

    if(Exists($table,$id) === true)
    {
        $sql = "UPDATE $table 
                SET Status = CASE 
                WHEN Status = 'A' THEN 'I' 
                ELSE 'A'
                END
                WHERE $tableID = :id";
                
        $stmt = $pdo->prepare($sql); 
        $stmt->bindValue(':id', $id); 
        $stmt->execute(); 
    }
    else
    {
        echo "Student could not be found in the database";
    }
}

function getCurrentPage(){
    return str_replace(".php", "", basename($_SERVER['PHP_SELF']));
}

?>