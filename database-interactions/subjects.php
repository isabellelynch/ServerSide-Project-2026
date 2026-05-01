<?php
require_once("general.php");
require_once("make-connection.php");

global $pdo;

function GetSubjectNames(){
    try{
        $sql = "SELECT Description, SubjectCode 
                FROM Subjects";
        
        $result = QueryDatabase($sql);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}

function getSubjectCount(){
    try{
        $sql = "SELECT COUNT(*) AS Count 
                FROM Subjects";

        $result = QueryDatabase($sql);

        while ($row=$result->fetch(PDO::FETCH_ASSOC)){
            return $row['Count'];
        }
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function getTutorSubject($tutorid){
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

        return $result['Description'];

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>