<?php 
require_once("../database-interactions/classes.php");
require_once("semesters.php");
require_once("../database-interactions/rooms.php");
require_once("../database-interactions/make-connection.php");
global $pdo, $semesters, $days, $times;


function generateSchedule(){
    global $semesters;
    $s = [];
    $sem = $semesters[$_SESSION['semester']]['number'];
    $result = SelectAllClasses($_SESSION['room'], $sem);
    foreach($result as $row){
        $day = $row['Day'];
        $time = $row['Time'];
        $s[$day][$time] = [
            'class' => $row['Description'],
            'tutor' => $row['FirstName'] . " " . $row['Surname'],
            'enrollment' => $row['CurrentEnrollment'],
            'capacity' => $row['Capacity'],
            'id' => $row['ClassID']
        ];
    }
    return $s;
}


function getFreeScheduleSlots($room){
    global $times;
    $_SESSION['room'] = $room;
    $schedule = generateSchedule();
    $freeSlots = [];
    for($i = 0; $i <= 4; $i ++) {
        foreach ($times as $time) {
            if (!isset($schedule[$i][$time])) {
                $freeSlots[$i][] = $time;
            }
        }
    }
    return $freeSlots;
}


function getFreeTimes($day, $room, $semester){
    global $pdo, $times;
    $stmt = $pdo -> prepare("SELECT Time 
                             FROM Classes 
                             WHERE Day = :d AND 
                             RoomNo = :r AND 
                             SemesterNo = :s");

    $stmt -> bindValue(":d", $day);
    $stmt -> bindValue(":r", $room);
    $stmt -> bindValue(":s", $semester);
    $stmt -> execute();

    $fulltimes = $stmt->fetch(PDO::FETCH_ASSOC);

    $free = [];
    var_dump($fulltimes['Time']);

    $occupiedTimes = $fulltimes['Time'];
    
    
    var_dump($occupiedTimes);

    foreach ($times as $t) {
        if (!in_array($t, $occupiedTimes)) {
            $free[] = $t;
        }
    }
  

    return $free;

}


//handle the changing of the room via buttons on the top of the schedule
if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['previous-room'])){
        $_SESSION['room']--;
        if($_SESSION['room'] <= 0){
            $_SESSION['room'] = RoomCount();
        }  
    }
    if(isset($_POST['next-room'])){
        $_SESSION['room']++;
        if($_SESSION['room'] > RoomCount()){
            $_SESSION['room'] = 1;
        }
    }
}
?>