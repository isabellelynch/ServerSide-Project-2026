<?php
    require_once(__DIR__ . "/../database-interactions/make-connection.php");
    require_once(__DIR__ . "/../database-interactions/rooms.php");
    global $pdo;

    function SelectAllClasses($room, $semester){
        global $pdo;
        try{
            $stmt = $pdo -> prepare("SELECT c.ClassID, t.FirstName, t.Surname, s.Description, 
                                c.Day, c.Time, c.CurrentEnrollment, r.Capacity 
                                FROM Classes c
                                JOIN Tutors t ON c.TutorID = t.TutorID 
                                JOIN Subjects s ON t.SubjectCode = s.SubjectCode 
                                JOIN Rooms r ON r.RoomNo = c.RoomNo 
                                WHERE c.RoomNo = :room AND c.SemesterNo = :sem");
            $stmt->execute([
                ':room' => $room,
                ':sem' => $semester
            ]); 
            
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }

    function isClassFull($id){
        global $pdo;
        try{
            $stmt = $pdo -> prepare("SELECT CurrentEnrollment, RoomNo 
                                    FROM Classes 
                                    WHERE ClassID = :id");
            $stmt -> execute([
                ':id' => $id
            ]);

            $class = $stmt -> fetch(PDO::FETCH_ASSOC);
            $current = $class['CurrentEnrollment'];
            $cap = getRoomCapacity($class['RoomNo']);

            return ($current >= $cap);

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function incrementEnrollment($id){
        global $pdo;
        try{
            $stmt = $pdo -> prepare("UPDATE Classes 
                                    SET CurrentEnrollment = CurrentEnrollment + 1 
                                    WHERE ClassID = :id");
            $stmt -> execute([
                ":id" => $id
            ]);
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function decrementEnrollment($id){
        global $pdo;
        try{
            $stmt = $pdo -> prepare("UPDATE Classes 
                                    SET CurrentEnrollment = CurrentEnrollment - 1 
                                    WHERE ClassID = :id");
            $stmt -> execute([
                ":id" => $id
            ]);
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function getClass($id){
        global $pdo;
        try{
            $stmt = $pdo->prepare("SELECT * 
                                    FROM Classes 
                                    WHERE ClassID = :id");

            $stmt->execute([
                ':id' => $id
            ]);
            
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function hasStudentBookedClass($s, $c){
        global $pdo;
        try{
            $stmt = $pdo->prepare("SELECT * 
                                FROM Bookings  
                                WHERE StudentID = :student AND
                                ClassID = :class");
            $stmt->execute([
                ':student' => $s,
                ':class' => $c
            ]);

            return $stmt->fetch() !== false;

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function addNewClass($class){
        global $pdo;
        try{
            $stmt = $pdo->prepare("INSERT INTO Classes 
                                (TutorID, Day, Time, RoomNo, SemesterNo) 
                                VALUES (:tutor, :day, :time, :room, :semester)");
                                    
            $stmt->execute([
                ':tutor' => $class['tutor'],
                ':day' => $class['day'],
                ':time' => $class['time'],
                ':room' => $class['room'],
                ':semester' => $class['semester']
            ]);
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function doesClassExist($class){
        global $pdo;
        try{
            $stmt = $pdo->prepare("SELECT COUNT(*) AS classCount 
                                FROM Classes 
                                WHERE TutorID = :tutor 
                                AND Day = :day 
                                AND Time = :time 
                                AND RoomNo = :room 
                                AND SemesterNo = :semester");

            $stmt->execute([
                ':tutor' => $class['tutor'],
                ':day' => $class['day'],
                ':time' => $class['time'],
                ':room' => $class['room'],
                ':semester' => $class['semester']
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result['classCount'] > 0;

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } 
    }

    function tutorAlreadyBooked($tutor, $day, $time, $sem){
        global $pdo;
        try{
            $stmt = $pdo->prepare("SELECT * 
                                FROM Classes 
                                WHERE TutorID = :tutorID AND 
                                Day = :day AND 
                                Time = :time 
                                SemesterNo = :sem");
            $stmt->execute([
                ':tutorID' => $tutor,
                ':day' => $day,
                ':time' => $time,
                ':sem' => $sem
            ]);

            return $stmt->fetch() !== false; 

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }       
    }
?>