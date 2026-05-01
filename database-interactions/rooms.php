<?php
require_once(__DIR__ . "/../database-interactions/general.php");

function RoomCount():?int{
    try{
        $sql = "SELECT COUNT(*) AS Count 
                FROM Rooms";

        $result = QueryDatabase($sql);

        $row = $result->fetch(PDO::FETCH_ASSOC);

        return $row['Count'] ?? null;

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

        if ($stmt->rowCount() === 1) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return (int)$row['Capacity'];
        }
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
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