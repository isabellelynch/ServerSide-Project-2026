<?php
require_once(__DIR__ . "/../database-interactions/general.php");

function RoomCount():?int{
    try{
        $sql = "SELECT COUNT(*) AS Count 
                FROM Rooms";

        $result = QueryDatabase($sql);

        $row = $result->fetch(PDO::FETCH_ASSOC);

        return isset($row['Count']) ? (int)$row['Count'] : null;

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function getRoomCapacity(int $room):int{
    global $pdo;
    try{
        $stmt = $pdo -> prepare("SELECT Capacity 
                                FROM Rooms 
                                WHERE RoomNo = :room");
        $stmt->execute([
            ':room' => $room
        ]);

        $capacity = $stmt->fetchColumn();
        return ($capacity === false) ? 0 : (int)$capacity;
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return 0;
    }
}

function isRoomBooked(int $day, int $time, int $room, int $sem):bool{
    global $pdo;
    try{
        $stmt = $pdo->prepare("
            SELECT 1 
            FROM Classes 
            WHERE Day = :d 
            AND Time = :t 
            AND RoomNo = :r 
            AND SemesterNo = :s 
            LIMIT 1
        ");

        $stmt->execute([
            ':d' => $day,
            ':t' => $time,
            ':r' => $room,
            ':s' => $sem
        ]);

        return $stmt -> fetch() !== false;

    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>