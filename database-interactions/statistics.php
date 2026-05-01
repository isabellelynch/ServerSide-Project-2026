<?php
    require_once(__DIR__ . "/../database-interactions/general.php");

    $rev = GetYearlyRevenueDifference();

    if($rev === 0){
        $result = "No change on last year.";
    }
    else{
        $result = ((GetYearlyRevenueDifference() > 0)?"Up ":"Down " ). "$rev on last year.";
    }

    function GetYearlyRevenue(){
        try{
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
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function GetYearlyRevenueDifference(){
        try{
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
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function GetThisYearsBookings(){
        try{
            $sql = "SELECT COUNT(*) AS Count 
                    FROM Bookings 
                    WHERE EXTRACT(YEAR FROM BookingDate) = EXTRACT(YEAR FROM SYSDATE())";

            $result = QueryDatabase($sql);
            while ($row=$result->fetch()){
                return $row['Count'];
            }
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

?>