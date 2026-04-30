<?php
    require_once(__DIR__ . "/../database-interactions/make-connection.php");
    global $pdo;

function AddStudent($student)
{
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO Students 
                    (FirstName, Surname, Email, PhoneNo,Status) 
                    VALUES (:name, :surname, :email, :phone, 'A')");
                            
    $stmt->bindValue(':name', $student['name']);
    $stmt->bindValue(':surname', $student['surname']);
    $stmt->bindValue(':email', $student['email']);
    $stmt->bindValue(':phone', $student['phone']);  

    $stmt->execute();
}

function PermanentlyRemoveStudent($id){
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM Students 
                           WHERE StudentID = :id");

    $stmt->bindValue(':id', $id); 

    $stmt->execute();
}

function UpdateStudent($student){
    global $pdo;

    $stmt = $pdo->prepare("UPDATE Students SET 
                            FirstName = :firstname, 
                            Surname = :surname, 
                            Email = :email, 
                            PhoneNo = :phone 
                            WHERE StudentID = :id");

    $stmt->bindValue(':firstname', $student['name']);
    $stmt->bindValue(':surname', $student['surname']);
    $stmt->bindValue(':email', $student['email']);
    $stmt->bindValue(':phone', $student['phone']);  
    $stmt->bindValue(':id', $student['id']); 

    $stmt->execute();
}

function doesEmailExist($e){
    global $pdo;
    $stmt = $pdo->prepare("SELECT StudentID FROM Students WHERE Email = :email");
    $stmt->bindValue(':email', $e);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        return $row['StudentID'];
    } 
    else {
        return false;
    }
}

?>