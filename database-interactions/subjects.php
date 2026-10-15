<?php
require_once(__DIR__ . "/general.php");
require_once(__DIR__ . "/make-connection.php");

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

// returns the tutor's subject as ['SubjectCode' => ..., 'Description' => ...], or null
function getTutorSubjectDetails(int $tutorid):?array{
    global $pdo;
    $stmt = $pdo->prepare("SELECT s.SubjectCode, s.Description 
                        FROM Subjects s JOIN Tutors t ON 
                        t.SubjectCode = s.SubjectCode 
                        WHERE t.TutorID = :id");
    $stmt -> execute([":id" => $tutorid]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

function doesSubjectExist(string $code):bool{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Subjects WHERE SubjectCode = :c");
    $stmt->execute([":c" => $code]);
    return (int)$stmt->fetchColumn() > 0;
}

function doesSubjectNameExist(string $description):bool{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Subjects WHERE Description = :d");
    $stmt->execute([":d" => $description]);
    return (int)$stmt->fetchColumn() > 0;
}

// number of tutors who teach this subject - a subject in use can't be deleted
function subjectTutorCount(string $code):int{
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM Tutors WHERE SubjectCode = :c");
    $stmt->execute([":c" => $code]);
    return (int)$stmt->fetchColumn();
}

function addSubject(string $code, string $description):void{
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO Subjects (SubjectCode, Description) VALUES (:c, :d)");
    $stmt->execute([":c" => $code, ":d" => $description]);
}

function removeSubject(string $code):void{
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM Subjects WHERE SubjectCode = :c");
    $stmt->execute([":c" => $code]);
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