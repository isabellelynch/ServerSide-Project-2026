<?php
    require_once(__DIR__ . "/../database-interactions/general.php");
    require_once(__DIR__ . "/../database-interactions/students.php");

    global $table;

    //link in Students table to go from active to inactive
    if (isset($_GET['action']) && $_GET['action'] === 'SetToInactive') 
    {
        $id = $_GET['id'];
        try 
        {
            UpdateStatus($table,$id);
            header("Location: $table.php" );
            exit();
        }
        catch (PDOException $e) 
        { 
            $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
        }
    }

    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['save-btn']) && isset($_POST['remove-id'])){
        $id = (int)$_POST['remove-id'];
        PermanentlyRemoveStudent($id);
    }

?>