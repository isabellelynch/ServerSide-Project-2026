<?php
global $pdo;
require_once("general.php");

function GetSpecificTutorNames($sub){
    global $pdo;
    $stmt = $pdo -> prepare("SELECT TutorID, FirstName, Surname 
                             FROM Tutors 
                             WHERE Status = 'A' AND 
                             SubjectCode = :sub");
    $stmt -> execute([
        ":sub" => $sub
    ]);

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
    $stmt->execute([
        ':name' => $tutor['name'],
        ':surname' => $tutor['surname'],
        ':email' => $tutor['email'],
        ':phone' => $tutor['phone'],
        ':rate' => $tutor['rate']
    ]);
}

function PermanentlyRemoveTutor($id){
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM Tutors 
                           WHERE TutorID = :id");

    $stmt->execute([
        ':id' => $id
    ]);
}

function GetTutorRate($r){
    global $pdo;
    
    $stmt = $pdo->prepare("SELECT HourlyRate 
                           FROM TutorRates 
                           WHERE RateCode = :r");
    $stmt->execute([
        ':r' => $r
    ]);
    
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

    $stmt = $pdo -> prepare("SELECT COUNT(*) AS Count 
                            FROM Tutors 
                            WHERE TutorID = :tid AND
                            SubjectCode = :scode");

    $stmt->execute([
        ":tid" => $t,
        ":scode" => $s
    ]);
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['Count'] > 0;
}

function doesTutorEmailExist($e){
    global $pdo;
    $stmt = $pdo->prepare("SELECT TutorID 
                           FROM Tutors 
                           WHERE Email = :email");
    $stmt->execute([
        ':email' => $e
    ]);
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        return $row['TutorID'];
    } 
    else {
        return false;
    }
}



?>