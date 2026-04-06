<?php
global $pdo;
require_once("general.php");
require_once("subjects.php");



if(isset($_GET['action']) && $_GET['action'] === 'tutorsubject'){
    $id = $_GET['id'];
    $subject = getTutorSubject($id);
    echo "<option>$subject</option>";  
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