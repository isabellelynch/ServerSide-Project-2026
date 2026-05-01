<?php
require_once("general.php");
require_once("make-connection.php");

global $pdo;

function GetSubjectNames():?array{
    try{
        $sql = "SELECT Description, SubjectCode 
                FROM Subjects";
        
        $result = QueryDatabase($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function getSubjectCount():int{
    try{
        $sql = "SELECT COUNT(*) AS Count 
                FROM Subjects";

        $result = QueryDatabase($sql);

        $row = $result->fetch(PDO::FETCH_ASSOC);

        return (int) $row['Count'];

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function getTutorSubject(int $tutorid):?string{
    global $pdo;
    try{
        $stmt = $pdo->prepare("SELECT Description 
                            FROM Subjects s JOIN Tutors t ON 
                            t.SubjectCode = s.SubjectCode 
                            WHERE t.TutorID = :id");
        $stmt -> execute([
            ":id" => $tutorid
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result['Description'];
        } else {
            return null;
        }

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>