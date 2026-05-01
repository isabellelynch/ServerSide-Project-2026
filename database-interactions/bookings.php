<?php
    require_once(__DIR__ . "/../database-interactions/make-connection.php");
    require_once(__DIR__ . "/../database-interactions/classes.php");

    global $pdo;
    function createBooking($s, $c){
        global $pdo;
        $stmt = $pdo -> prepare("INSERT INTO Bookings(StudentID, BookingDate, ClassID) 
                VALUES (:student, SYSDATE(), :class)");
        
        $stmt -> execute([
            ":student" => $s,
            ":class" => $c
        ]);
    }

    function RemoveStudentBookings($id){
        global $pdo;

        $stmt = $pdo -> prepare("DELETE FROM Bookings 
                                 WHERE StudentID = :id");
        $stmt -> execute([":id" => $id]);
    }

    function RemoveStudentFromClasses($id){
        $bookings = GetBookings($id);

        foreach($bookings as $b){
            $classid = $b['ClassID'];
            decrementEnrollment($classid);
        }
    }

    function GetBookings($id){
        global $pdo;
        $stmt = $pdo -> prepare("SELECT * 
                                 FROM Bookings 
                                 WHERE StudentID = :id");
        $stmt -> execute([":id" => $id]);
        return $stmt -> fetchAll(PDO::FETCH_ASSOC);
    }
?>