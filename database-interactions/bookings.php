<?php
    require_once(__DIR__ . "/../database-interactions/make-connection.php");
    require_once(__DIR__ . "/../database-interactions/classes.php");

    global $pdo;
    function createBooking($s, $c){
        global $pdo;
        try{
            $stmt = $pdo -> prepare("INSERT INTO Bookings(StudentID, BookingDate, ClassID) 
                                     VALUES (:student, SYSDATE(), :class)");
        
            $stmt -> execute([
                ":student" => $s,
                ":class" => $c
            ]);
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }

    function RemoveStudentBookings($id){
        global $pdo;
        try{
            $stmt = $pdo -> prepare("DELETE FROM Bookings 
                                    WHERE StudentID = :id");
                                    
            $stmt -> execute([":id" => $id]);

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
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
        try{
            $stmt = $pdo -> prepare("SELECT * 
                                     FROM Bookings 
                                     WHERE StudentID = :id");

            $stmt -> execute([":id" => $id]);
            
            return $stmt -> fetchAll(PDO::FETCH_ASSOC);

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }
?>