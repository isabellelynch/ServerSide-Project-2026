<?php
require_once(ROOT . "/database-interactions/general.php");

function GetSubjectNames(){
    $sql = "SELECT DISTINCT Description 
            FROM Subjects";
    
    $result = QueryDatabase($sql);

    return $result->fetchAll(PDO::FETCH_COLUMN);
}
?>