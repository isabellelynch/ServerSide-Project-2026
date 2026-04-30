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

function AddTutor($tutor)
{
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO Tutors 
                    (FirstName, Surname, Email, PhoneNo,Status, RateCode) 
                    VALUES (:name, :surname, :email, :phone, 'A', :rate)");
                            
    $stmt->bindValue(':name', $tutor['name']);
    $stmt->bindValue(':surname', $tutor['surname']);
    $stmt->bindValue(':email', $tutor['email']);
    $stmt->bindValue(':phone', $tutor['phone']);  
    $stmt->bindValue(':rate', $tutor['rate']);  

    $stmt->execute();
}

function PermanentlyRemoveTutor($id){
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM Tutors 
                           WHERE TutorID = :id");

    $stmt->bindValue(':id', $id); 

    $stmt->execute();
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

function GetTutorRates(){
    $sql = "SELECT RateCode, HourlyRate  
            FROM TutorRates";

    $result = QueryDatabase($sql);

    return $result->fetchAll(PDO::FETCH_ASSOC);
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

function doesTutorEmailExist($e){
    global $pdo;
    $stmt = $pdo->prepare("SELECT TutorID FROM Tutors WHERE Email = :email");
    $stmt->bindValue(':email', $e);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        return $row['TutorID'];
    } 
    else {
        return false;
    }
}



?>