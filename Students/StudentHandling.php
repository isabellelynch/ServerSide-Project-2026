<?php
require_once("../include-for-functions/DatabaseActions.php");
unset($_SESSION['error']);
global $pdo;
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['save-btn']) && isset($_POST['classid'])){
        $classid = $_POST['classid'];
        $email = $_POST['email'];
        if($email == ""){
            $error = "Please enter an email to add a student.";
            return;
        }

        global $pdo;

        $stmt = $pdo->prepare("SELECT * 
                                FROM Classes 
                                WHERE ClassID = :id");

        $stmt->bindValue(':id', $classid);

        $stmt->execute();

        $class = $stmt->fetch(PDO::FETCH_ASSOC);

        if($class){
            if(!isClassFull($classid)){
                $studentID = doesEmailExist($email);
                if($studentID){
                    incrementEnrollment($classid);
                    createBooking($studentID, $classid);
                    $success = "Student sucessfully added to the class.";
                }
                else{
                    $error = "Student cannot be added to the class because their email is not on the system,
                              please add them to the system and try again.";
                }

            }
            else{
                $error = "Student cannot be added to the class as this class is full";
            }
        }
    }
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

function getRoomCapacity($room){
    global $pdo;
    $stmt = $pdo->prepare("SELECT Capacity FROM Rooms WHERE RoomNo = :room");
    $stmt->bindValue(':room', $room);
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['Capacity'];
    }

}

function doesEmailExist($e){
    global $pdo;
    $stmt = $pdo->prepare("SELECT StudentID FROM Students WHERE Email = :email");
    $stmt->bindValue(':email', $e);
    $stmt->execute();
    
    if ($stmt->rowCount() === 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['StudentID'];
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

function createBooking($s, $c){
    global $pdo;
    $stmt = $pdo -> prepare("INSERT INTO Bookings(StudentID, BookingDate, ClassID) 
            VALUES (:student, SYSDATE(), :class)");
    
    $stmt -> bindValue(":student", $s);
    $stmt -> bindValue(":class", $c);
    $stmt -> execute();
}
?>