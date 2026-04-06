<?php
require_once(ROOT . "/database-interactions/general.php");

function RoomCount(){
    $sql = "SELECT COUNT(*) AS Count FROM Rooms";
    $result = QueryDatabase($sql);
    while ($row=$result->fetch()){
        return $row['Count'];
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

function isRoomFree($day, $time, $room){
    $stmt = $pdo->prepare("SELECT COUNT(*) AS Count 
                           FROM Classes 
                           WHERE Day = :d AND 
                           Time = :t AND 
                           RoomNo = :r");
    $stmt->bindValue(':d', $day);
    $stmt->bindValue(':t', $time);
    $stmt->bindValue(':r', $room);
    $stmt->execute();

    if ($stmt->rowCount() === 0) {
        return true;
    }
    else{
        return false;
    }
}


?>