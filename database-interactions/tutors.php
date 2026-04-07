<?php
global $pdo;
require_once("general.php");

function GetSpecificTutorNames($sub){
    global $pdo;
    $stmt = $pdo -> prepare("SELECT TutorID, FirstName, Surname 
                             FROM Tutors 
                             WHERE Status = 'A' AND 
                             SubjectCode = :sub");
    $stmt -> bindValue(":sub", $sub);
    $stmt -> execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function GetAllTutorNames(){
    $sql = "SELECT TutorID, FirstName, Surname 
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

function ensureTutorTeachesSubject($t, $s){
    global $pdo;

    $stmt = $pdo->prepare("SELECT COUNT(*) AS Count 
                            FROM TutorSubjects 
                            WHERE TutorID = :tid AND
                            SubjectCode = :scode");
    
    $stmt -> bindValue(":tid", $t);
    $stmt -> bindValue(":scode", $s);

    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['Count'];
}

?>