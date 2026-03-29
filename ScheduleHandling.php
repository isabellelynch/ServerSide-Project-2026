<?php 
require_once("include-for-functions/DatabaseActions.php");


$schedule = generateSchedule();

if (!isset($_SESSION['room'])) {
    $_SESSION['room'] = 1;
}

if($_SERVER['REQUEST_METHOD'] === "POST"){
    global $schedule;
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
    $schedule = generateSchedule();
}



function generateSchedule(){
    $s = [];
    $result = SelectAllClasses($_SESSION['room']);
    
    while ($row = $result->fetch()) {
        $day = $row['Day'];
        $time = $row['Time'];

        $s[$day][$time] = [
            'class' => $row['Description'],
            'tutor' => $row['FirstName'] . " " . $row['Surname'],
            'enrollment' => $row['CurrentEnrollment'],
            'capacity' => $row['Capacity']
        ];
    }

    return $s;
}

?>