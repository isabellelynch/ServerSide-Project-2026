<?php 
require_once("include-for-functions/DatabaseActions.php");

if (!isset($_SESSION['room'])) {
    $_SESSION['room'] = 1;
}
if (!isset($_SESSION['semester'])) {
    $_SESSION['semester'] = 1;
}

$semesters = [
    [
        'number' => previousSemester(),
        'name' => 'Previous'
    ],
    [
        'number' => getCurrentSemester(),
        'name' => 'Current'
    ],
    [
        'number' => nextSemester(),
        'name' => 'Next'
    ]
];

$schedule = generateSchedule();

if($_SERVER['REQUEST_METHOD'] === "POST"){
    global $schedule;
    global $semesters;
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
    if(isset($_POST['previous-sem'])){
        foreach ($semesters as $i => $sem) {
            if ($i == $_SESSION['semester']) {
                $index = $i;
                break;
            }
        }
        if($index == 0){
            return;
        }
        else{
            $_SESSION['semester'] = $index - 1;
        }
    }
    if(isset($_POST['next-sem'])){
        foreach ($semesters as $i => $sem) {
            if ($i == $_SESSION['semester']) {
                $index = $i;
                break;
            }
        }
        if($index == count($semesters) - 1){
            return;
        }
        else{
            $_SESSION['semester'] = $index + 1;
        }
    }
    $schedule = generateSchedule();
}

function generateSchedule(){
    global $semesters;
    $s = [];
    $semesterNum = $semesters[$_SESSION['semester']]['number'];
    $result = SelectAllClasses($_SESSION['room'], $semesterNum);
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

function getCurrentSemester(){
    $year = date("y");
    $month = date("m");
    $semester = 1;
    if($month > 6){
        $semester = 2;
    }
    return $year . $semester;
}

function nextSemester(){
    $current = getCurrentSemester();
    $num = substr($current, -1);
    if($num == 2){
        $next = (int)substr($current,0,-1) + 1;
        $next = (string)$next . "1";
    }
    else{
        $next = substr($current,0,-1) . "2";
    }

    return $next;
}

function previousSemester(){
    $current = getCurrentSemester();
    $num = substr($current, -1);
    if($num == 2){
        $prev = substr($current,0,-1) . "1";
       
    }
    else{
        $prev = (int)substr($current,0,-1) - 1;
        $prev = (string)$prev . "2";
    }
    return $prev;
}

?>