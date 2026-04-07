<?php
    require_once(__DIR__ . "/../database-interactions/make-connection.php");
    global $pdo;
    function createBooking($s, $c){
        global $pdo;
        $stmt = $pdo -> prepare("INSERT INTO Bookings(StudentID, BookingDate, ClassID) 
                VALUES (:student, SYSDATE(), :class)");
        
        $stmt -> bindValue(":student", $s);
        $stmt -> bindValue(":class", $c);
        $stmt -> execute();
    }
?>