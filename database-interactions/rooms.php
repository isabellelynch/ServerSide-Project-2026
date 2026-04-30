<?php
require_once(__DIR__ . "/../database-interactions/general.php");

function RoomCount(){
    $sql = "SELECT COUNT(*) AS Count 
            FROM Rooms";

    $result = QueryDatabase($sql);

    while ($row=$result->fetch(PDO::FETCH_ASSOC)){
        return $row['Count'];
    }
}

function getRoomCapacity($room){
    global $pdo;
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

}

function isRoomBooked($day, $time, $room){
    global $pdo;

    $stmt = $pdo->prepare("
        SELECT 1 
        FROM Classes 
        WHERE Day = :d 
        AND Time = :t 
        AND RoomNo = :r
        LIMIT 1
    ");

    $stmt->execute([
        ':d' => $day,
        ':t' => $time,
        ':r' => $room
    ]);

    return $stmt -> fetch() !== false;
}


?>