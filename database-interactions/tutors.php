<?php
require_once(ROOT . "/database-interactions/general.php");

global $pdo;

function GetAllTutorNames(){
    $sql = "SELECT FirstName, Surname 
            FROM Tutors 
            WHERE Status = 'A'";

    $result = QueryDatabase($sql);

    return $result->fetchAll(PDO::FETCH_ASSOC);
}


function GetTutorRate($r){
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT HourlyRate 
                           FROM TutorRates 
                           WHERE RateCode = :r");
    $stmt->bindValue(':r', $r); 

    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['HourlyRate'];
}
?>