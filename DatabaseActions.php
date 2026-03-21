<?php

session_start();

require_once('Validation.php');

require_once("MakeConnection.php");

$pdo = MakeConnection();

function getCurrentPage(){
    return str_replace(".php", "", basename($_SERVER['PHP_SELF']));
}

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
    
    
function SelectAll()
{
    $sql = "SELECT * FROM " . getCurrentPage();
    return QueryDatabase($sql);
}

function Exists($table,$id)
{
    global $pdo;
    $sql = "SELECT count(*) FROM ${table}s where ${table}ID = :id";
    
    $exists = $pdo->prepare($sql);
    
    $exists->bindValue(':id', $id);
    $exists->execute();
    
    if($exists->fetchColumn() > 0)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

function UpdateStatus($table, $id) 
{
    global $pdo;
    if(Exists("Student",$id) == 1)
    {
            $sql = "UPDATE ${table}s 
                    SET Status = CASE 
                    WHEN Status = 'A' THEN 'I' 
                    ELSE 'A'
                    END
                    WHERE ${table}ID = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id); 
            $stmt->execute(); 
    }
    else
    {
        echo "Student could not be found in the database";
    }
}




     
?>
<?php

session_start();

require_once('Validation.php');

require_once("MakeConnection.php");

$pdo = MakeConnection();

function getCurrentPage(){
    return str_replace(".php", "", basename($_SERVER['PHP_SELF']));
}

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
    
    
function SelectAll()
{
    $sql = "SELECT * FROM " . getCurrentPage();
    return QueryDatabase($sql);
}

function Exists($table,$id)
{
    global $pdo;
    $sql = "SELECT count(*) FROM ${table}s where ${table}ID = :id";
    
    $exists = $pdo->prepare($sql);
    
    $exists->bindValue(':id', $id);
    $exists->execute();
    
    if($exists->fetchColumn() > 0)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

function UpdateStatus($table, $id) 
{
    global $pdo;
    if(Exists("Student",$id) == 1)
    {
            $sql = "UPDATE ${table}s 
                    SET Status = CASE 
                    WHEN Status = 'A' THEN 'I' 
                    ELSE 'A'
                    END
                    WHERE ${table}ID = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id); 
            $stmt->execute(); 
    }
    else
    {
        echo "Student could not be found in the database";
    }
}




     
?>