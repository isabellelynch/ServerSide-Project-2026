<?php

include_once("include-for-functions/DatabaseActions.php");


//link in Students table to go from active to inactive
if (isset($_GET['action']) && $_GET['action'] === 'SetToInactive') 
{
    $id = $_GET['id'];
    $table = str_replace(".php", "", $_SESSION['current_page']);
    try 
    {
        UpdateStatus($table,$id);
        header("Location:" . $_SESSION['current_page']);
        exit();
    }
    catch (PDOException $e) 
    { 
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
    }
}

?>