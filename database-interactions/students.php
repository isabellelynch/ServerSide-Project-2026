<?php
    require_once(__DIR__ . "/../database-interactions/make-connection.php");
    global $pdo;

function AddStudent($student)
{
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO Students 
                    (FirstName, Surname, Email, PhoneNo,Status) 
                    VALUES (:name, :surname, :email, :phone, 'A')");
                            
    $stmt->execute([
        ':name' => $student['name'],
        ':surname' => $student['surname'],
        ':email' => $student['email'],
        ':phone' => $student['phone']
    ]);
}

function PermanentlyRemoveStudent($id){
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM Students 
                           WHERE StudentID = :id");

    $stmt->execute([
        ':id' => $id
    ]);
}

function UpdateStudent($student){
    global $pdo;

    $stmt = $pdo->prepare("UPDATE Students SET 
                            FirstName = :firstname, 
                            Surname = :surname, 
                            Email = :email, 
                            PhoneNo = :phone 
                            WHERE StudentID = :id");

    $stmt->execute([
        ':firstname' => $student['name'],
        ':surname' => $student['surname'],
        ':email' => $student['email'],
        ':phone' => $student['phone'],
        ':id' => $student['id']
    ]);
}

function doesEmailExist($e){
    global $pdo;
    $stmt = $pdo -> prepare("SELECT StudentID 
                             FROM Students 
                             WHERE Email = :email");
    $stmt->execute([
        ':email' => $e
    ]);
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        return $row['StudentID'];
    } 
    else {
        return false;
    }
}

?>