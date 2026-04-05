<?php
    require_once(ROOT . "/database-interactions/make-connection.php");
    require_once(ROOT . "/database-interactions/rooms.php");
    global $pdo;

    function SelectAllClasses($room, $semester){
        global $pdo;
        $stmt = $pdo -> prepare("SELECT c.ClassID, t.FirstName, t.Surname, s.Description, 
                                c.Day, c.Time, c.CurrentEnrollment, r.Capacity 
                                FROM Classes c
                                JOIN Tutors t ON c.TutorID = t.TutorID 
                                JOIN Subjects s ON t.SubjectCode = s.SubjectCode 
                                JOIN Rooms r ON r.RoomNo = c.RoomNo 
                                WHERE c.RoomNo = :room AND c.SemesterNo = :sem");

        $stmt->bindValue(':room', $room); 
        $stmt->bindValue(':sem', $semester);
        $stmt->execute(); 
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }

    function isClassFull($id){
        global $pdo;
        $stmt = $pdo -> prepare("SELECT CurrentEnrollment, RoomNo 
                                FROM Classes 
                                WHERE ClassID = :id");
        $stmt->bindValue(':id', $id); 
        $stmt -> execute();
        $class = $stmt -> fetch(PDO::FETCH_ASSOC);

        $current = $class['CurrentEnrollment'];
        $cap = getRoomCapacity($class['RoomNo']);
        if($current >= $cap){
            return true;
        }
        else {
            return false;
        }
    }

    function incrementEnrollment($id){
        global $pdo;
        $stmt = $pdo -> prepare("UPDATE Classes 
                                SET CurrentEnrollment = CurrentEnrollment + 1 
                                WHERE ClassID = :id");
        $stmt -> bindValue(":id", $id);
        $stmt -> execute();
    }

    function getClass($id){
        global $pdo;

        $stmt = $pdo->prepare("SELECT * 
                                FROM Classes 
                                WHERE ClassID = :id");

        $stmt->bindValue(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
?>