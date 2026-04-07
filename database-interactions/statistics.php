<?php
require_once(__DIR__ . "/../database-interactions/general.php");

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
    $sql = "SELECT COUNT(*) AS Count 
            FROM Bookings 
            WHERE EXTRACT(YEAR FROM BookingDate) = EXTRACT(YEAR FROM SYSDATE())";

    $result = QueryDatabase($sql);
    while ($row=$result->fetch()){
        return $row['Count'];
    }
}

?>