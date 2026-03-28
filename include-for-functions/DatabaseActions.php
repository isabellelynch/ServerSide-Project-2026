<?php

session_start();

require_once("Validation.php");

require_once("MakeConnection.php");

$pdo = MakeConnection();

function getCurrentPage(){
    return str_replace(".php", "", basename($_SERVER['PHP_SELF']));
}

function QueryDatabase(string $sql)
{
    global $pdo;
    try
    {
        return $pdo->query($sql);
    }
    catch(PDOException $e)
    {
        $output = "Unable to query the database : " . $e->getMessage();
        echo $output;
    }
}
    
function SelectAllClasses($room){
    $sql = "SELECT t.FirstName, t.Surname, s.Description, c.Day, c.Time, c.CurrentEnrollment, r.Capacity 
            FROM Classes c
            JOIN Tutors t ON c.TutorID = t.TutorID 
            JOIN Subjects s ON t.SubjectCode = s.SubjectCode 
            JOIN Rooms r ON r.RoomNo = c.RoomNo 
            WHERE c.RoomNo = $room";
    return QueryDatabase($sql);
}
function SelectAll()
{
    $sql = "SELECT * FROM " . getCurrentPage();
    return QueryDatabase($sql);
}

function Exists($table,$id)
{
    global $pdo;
    $sql = "SELECT count(*) FROM ${table}s where ${table}ID = :id";
    
    $exists = $pdo->prepare($sql);
    
    $exists->bindValue(':id', $id);
    $exists->execute();
    
    if($exists->fetchColumn() > 0)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}

function UpdateStatus($table, $id) 
{
    global $pdo;
    if(Exists("Student",$id) == 1)
    {
            $sql = "UPDATE ${table}s 
                    SET Status = CASE 
                    WHEN Status = 'A' THEN 'I' 
                    ELSE 'A'
                    END
                    WHERE ${table}ID = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $id); 
            $stmt->execute(); 
    }
    else
    {
        echo "Student could not be found in the database";
    }
}

function AddStudent($student)
{
    global $pdo;

    $stmt = $pdo->prepare("INSERT INTO Students 
                    (FirstName, Surname, Email, PhoneNo,Status) 
                    VALUES (:name, :surname, :email, :phone, 'A')");
                            
    $stmt->bindValue(':name', $student['name']);
    $stmt->bindValue(':surname', $student['surname']);
    $stmt->bindValue(':email', $student['email']);
    $stmt->bindValue(':phone', $student['phone']);  

    $stmt->execute();

    $student = [];
    
}

function PermanentlyRemoveStudent($student){
    global $pdo;

    $stmt = $pdo->prepare("DELETE FROM Students 
                           WHERE StudentID = :id");

    $stmt->bindValue(':id', $student['id']); 

    $stmt->execute();

    $student = [];
}

function UpdateStudent($student){
    global $pdo;

    $stmt = $pdo->prepare("UPDATE Students SET 
                            FirstName = :firstname, 
                            Surname = :surname, 
                            Email = :email, 
                            PhoneNo = :phone 
                            WHERE StudentID = :id");

    $stmt->bindValue(':firstname', $student['name']);
    $stmt->bindValue(':surname', $student['surname']);
    $stmt->bindValue(':email', $student['email']);
    $stmt->bindValue(':phone', $student['phone']);  
    $stmt->bindValue(':id', $student['id']); 

    $stmt->execute();

    $student = [];
}

function GetActive($table){
    $sql = "SELECT COUNT(*) AS Count FROM $table WHERE Status = 'A'";
    $result = QueryDatabase($sql);
    while ($row=$result->fetch()){
        return $row['Count'];
    }
}

function GetYearlyRevenue(){
    $sql = "SELECT SUM(tr.HourlyRate) AS Count
            FROM Bookings b 
            JOIN Classes c ON c.ClassID = b.ClassID 
            JOIN Tutors t ON c.TutorID = t.TutorID 
            JOIN TutorRates tr ON t.RateCode = tr.RateCode 
            WHERE EXTRACT(YEAR FROM b.BookingDate) = EXTRACT(YEAR FROM SYSDATE())";

    $result = QueryDatabase($sql);

    while ($row=$result->fetch()){
        return $row['Count'];
    }
}

function GetYearlyRevenueDifference(){
    $thisYear = GetYearlyRevenue();
    $sql = "SELECT SUM(tr.HourlyRate) AS Count 
            FROM Bookings b  
            JOIN Classes c ON c.ClassID = b.ClassID 
            JOIN Tutors t ON c.TutorID = t.TutorID 
            JOIN TutorRates tr ON t.RateCode = tr.RateCode 
            WHERE EXTRACT(YEAR FROM b.BookingDate) = EXTRACT(YEAR FROM SYSDATE()) - 1";

    $result = QueryDatabase($sql);

    while ($row=$result->fetch()){
        $lastYear = $row['Count'];
    }

    return $thisYear - $lastYear;

}

function GetThisYearsBookings(){
    $sql = "SELECT COUNT(*) AS Count FROM Bookings WHERE BookingDate = EXTRACT(YEAR FROM SYSDATE())";
    $result = QueryDatabase($sql);
    while ($row=$result->fetch()){
        return $row['Count'];
    }
}


function GetAllTutorNames(){
    $sql = "SELECT FirstName, Surname 
            FROM Tutors 
            WHERE Status = 'A'";
    return QueryDatabase($sql);
}

function GetSubjectNames(){
    $sql = "SELECT DISTINCT Description 
            FROM Subjects";
    return QueryDatabase($sql);
}
?>