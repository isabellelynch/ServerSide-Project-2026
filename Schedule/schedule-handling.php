<?php 
require_once(ROOT . "/database-interactions/classes.php");
require_once(ROOT . "/Schedule/semesters.php");
global $semesters;

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


?>