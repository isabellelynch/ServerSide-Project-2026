<?php
    require_once(ROOT . "/database-interactions/make-connection.php");
    global $pdo;

function AddStudent(array $student):void
{
    global $pdo;
    try{
        $stmt = $pdo->prepare("INSERT INTO Students 
                        (FirstName, Surname, Email, PhoneNo,Status) 
                        VALUES (:name, :surname, :email, :phone, 'A')");
                                
        $stmt->execute([
            ':name' => $student['name'],
            ':surname' => $student['surname'],
            ':email' => $student['email'],
            ':phone' => $student['phone']
        ]);
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}

function PermanentlyRemoveStudent(int $id):void{
    global $pdo;
    try{
        $stmt = $pdo->prepare("DELETE FROM Students 
                            WHERE StudentID = :id");

        $stmt->execute([
            ':id' => $id
        ]);
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function UpdateStudent(array $student):void{
    global $pdo;
    try{
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
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function doesEmailExist(string $e):bool{
    global $pdo;
    try{
        $stmt = $pdo -> prepare("SELECT StudentID 
                                FROM Students 
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