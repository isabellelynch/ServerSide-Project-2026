<?php
global $pdo;
require_once("general.php");

function GetSpecificTutorNames(string $sub):?array{
    global $pdo;
    try{
        $stmt = $pdo -> prepare("SELECT TutorID, FirstName, Surname 
                                FROM Tutors 
                                WHERE Status = 'A' AND 
                                SubjectCode = :sub");
        $stmt -> execute([
            ":sub" => $sub
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: null;

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function GetAllTutorNames():?array{
    try{
        $sql = "SELECT TutorID, FirstName, Surname 
                FROM Tutors 
                WHERE Status = 'A'";

        $result = QueryDatabase($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC) ?: null;
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function AddTutor(array $tutor):void
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

function PermanentlyRemoveTutor(int $id):void{
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

function GetTutorRate(string $r):int{
    global $pdo;
    try{
        $stmt = $pdo->prepare("SELECT HourlyRate 
                            FROM TutorRates 
                            WHERE RateCode = :r");
        $stmt->execute([
            ':r' => $r
        ]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ? (int) $result['HourlyRate'] : null; 

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function GetTutorRates():?array{
    try{
        $sql = "SELECT RateCode, HourlyRate  
                FROM TutorRates";

        $result = QueryDatabase($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC) ?: null;

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function ensureTutorTeachesSubject(int $t, string $s):bool{
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

        return (int)$result['Count'] > 0;

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}

function doesTutorEmailExist(string $e):bool{
    global $pdo;
    try{
        $stmt = $pdo->prepare("SELECT TutorID 
                            FROM Tutors 
                            WHERE Email = :email");
        $stmt->execute([
            ':email' => $e
        ]);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row !== false;
        
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>