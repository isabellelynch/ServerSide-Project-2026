<?php
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

function getSemesterNameByNumber($number) {
    global $semesters;

    foreach ($semesters as $semester) {

        if ($semester['number'] == $number) {

            return $semester['name'];

        }
    }
    
    return null;
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

if($_SERVER['REQUEST_METHOD'] === "POST"){
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
}
?>