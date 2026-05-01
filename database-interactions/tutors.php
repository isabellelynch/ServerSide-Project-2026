<?php
global $pdo;
require_once("general.php");

function GetSpecificTutorNames($sub){
    global $pdo;
    try{
        $stmt = $pdo -> prepare("SELECT TutorID, FirstName, Surname 
                                FROM Tutors 
                                WHERE Status = 'A' AND 
                                SubjectCode = :sub");
        $stmt -> execute([
            ":sub" => $sub
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function GetAllTutorNames(){
    try{
        $sql = "SELECT TutorID, FirstName, Surname 
                FROM Tutors 
                WHERE Status = 'A'";

        $result = QueryDatabase($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function AddTutor($tutor)
{
    global $pdo;
    try{
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
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}

function PermanentlyRemoveTutor($id){
    global $pdo;
    try{
        $stmt = $pdo->prepare("DELETE FROM Tutors 
                            WHERE TutorID = :id");

        $stmt->execute([
            ':id' => $id
        ]);
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function GetTutorRate($r){
    global $pdo;
    try{
        $stmt = $pdo->prepare("SELECT HourlyRate 
                            FROM TutorRates 
                            WHERE RateCode = :r");
        $stmt->execute([
            ':r' => $r
        ]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['HourlyRate'];
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function GetTutorRates(){
    try{
        $sql = "SELECT RateCode, HourlyRate  
                FROM TutorRates";

        $result = QueryDatabase($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function ensureTutorTeachesSubject($t, $s){
    global $pdo;
    try{
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
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}

function doesTutorEmailExist($e){
    global $pdo;
    try{
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
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>