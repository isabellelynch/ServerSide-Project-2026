<?php
require_once(__DIR__ . "/../database-interactions/general.php");

function RoomCount(){
    try{
        $sql = "SELECT COUNT(*) AS Count 
                FROM Rooms";

        $result = QueryDatabase($sql);

        while ($row=$result->fetch(PDO::FETCH_ASSOC)){
            return $row['Count'];
        }
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function getRoomCapacity($room){
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
            return $row['Capacity'];
        }
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function isRoomBooked($day, $time, $room, $sem){
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