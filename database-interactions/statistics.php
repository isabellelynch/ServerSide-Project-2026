<?php
    require_once(ROOT . "/database-interactions/general.php");

    $rev = GetYearlyRevenueDifference();

    if($rev === 0){
        $result = "No change on last year.";
    }
    else{
        $result = (($rev > 0) ? "Up " : "Down ") . "$rev on last year.";
    }

    function GetYearlyRevenue():?int{
        try{
            $sql = "SELECT SUM(tr.HourlyRate) AS Count
                    FROM Bookings b 
                    JOIN Classes c ON c.ClassID = b.ClassID 
                    JOIN Tutors t ON c.TutorID = t.TutorID 
                    JOIN TutorRates tr ON t.RateCode = tr.RateCode 
                    WHERE EXTRACT(YEAR FROM b.BookingDate) = EXTRACT(YEAR FROM SYSDATE())";

            $result = QueryDatabase($sql);

            if ($result) {
                $row = $result->fetch(PDO::FETCH_ASSOC);
                return (int)$row['Count']; 
            }
            
            return null;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function GetYearlyRevenueDifference():?int{
        try{
            $thisYear = GetYearlyRevenue();

            if ($thisYear === null) {
                return null;
            }

            $sql = "SELECT SUM(tr.HourlyRate) AS Count 
                    FROM Bookings b  
                    JOIN Classes c ON c.ClassID = b.ClassID 
                    JOIN Tutors t ON c.TutorID = t.TutorID 
                    JOIN TutorRates tr ON t.RateCode = tr.RateCode 
                    WHERE EXTRACT(YEAR FROM b.BookingDate) = EXTRACT(YEAR FROM SYSDATE()) - 1";

            $result = QueryDatabase($sql);

            if ($result) {
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $lastYear = $row['Count'] ?? 0;
            } else {
                $lastYear = 0;
            }

            return $thisYear - $lastYear;

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function GetThisYearsBookings():?int{
        try{
            $sql = "SELECT COUNT(*) AS Count 
                    FROM Bookings 
                    WHERE EXTRACT(YEAR FROM BookingDate) = EXTRACT(YEAR FROM SYSDATE())";

            $result = QueryDatabase($sql);

            if ($result) {
                $row = $result->fetch(PDO::FETCH_ASSOC);
                return (int)$row['Count'];
            }
            
            return null;

        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

?>