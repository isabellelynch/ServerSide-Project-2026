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

// returns the ID of the student with this email, or null if there isn't one
function getStudentIdByEmail(string $email):?int{
    global $pdo;
    try{
        $stmt = $pdo -> prepare("SELECT StudentID 
                                FROM Students 
                                WHERE Email = :email");
        $stmt->execute([
            ':email' => $email
        ]);

        $id = $stmt->fetchColumn();

        return ($id === false) ? null : (int)$id;

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}

function isStudentActive(int $id):bool{
    global $pdo;
    $stmt = $pdo -> prepare("SELECT Status FROM Students WHERE StudentID = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetchColumn() === 'A';
}

// true if another student (not the one being updated) already uses this email
function isEmailUsedByOtherStudent(string $email, int $id):bool{
    global $pdo;
    $stmt = $pdo -> prepare("SELECT COUNT(*) FROM Students WHERE Email = :email AND StudentID <> :id");
    $stmt->execute([':email' => $email, ':id' => $id]);
    return (int)$stmt->fetchColumn() > 0;
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