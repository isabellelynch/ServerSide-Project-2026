<?php
    require_once(ROOT . "/database-interactions/general.php");
    global $table;
    //link in Students table to go from active to inactive
    if (isset($_GET['action']) && $_GET['action'] === 'SetToInactive') 
    {
        $id = $_GET['id'];
        try 
        {
            UpdateStatus($table,$id);
            header("Location:$table.php" );
            exit();
        }
        catch (PDOException $e) 
        { 
            $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
        }
    }

?>