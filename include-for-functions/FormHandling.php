<?php
require_once("DatabaseActions.php");
require_once("Validation.php");

//link in Students table to go from active to inactive
if (isset($_GET['action']) && $_GET['action'] === 'SetToInactive') 
{
    $id = $_GET['id'];
    try 
    {
        UpdateStatus("Student",$id); 
        header("Location:Students.php");
    }
    catch (PDOException $e) 
    { 
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
    }
}










?>