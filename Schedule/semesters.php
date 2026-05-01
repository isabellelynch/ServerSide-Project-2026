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

if (!isset($_SESSION['semester'])) {
    $_SESSION['semester'] = 1;
}

function getSemesterNameByNumber(int $number):?string {
    global $semesters;

    foreach ($semesters as $semester) {

        if ($semester['number'] == $number) {

            return $semester['name'];

        }
    }
    
    return null;
}

function getSemesterNumberByName(string $name):?int {
    global $semesters;

    foreach ($semesters as $semester) {

        if ($semester['name'] == $name) {

            return $semester['number'];

        }
    }
    
    return null;
}

function getCurrentSemester():int{
    $year = date("y");
    $month = date("m");
    $semester = ($month > 6) ? 2 : 1;
    return $year . $semester;
}

function nextSemester():int{
    $current = getCurrentSemester();
    $num = substr($current, -1);
    if($num == 2){
        $next = (int)substr($current,0,-1) + 1;
        $next = (string)$next . "1";
    }
    else{
        $next = substr($current,0,-1) . "2";
    }

    return (int)$next;
}

function previousSemester():int{
    $current = getCurrentSemester();
    $num = substr($current, -1);
    if($num == 2){
        $prev = substr($current,0,-1) . "1";
       
    }
    else{
        $prev = (int)substr($current,0,-1) - 1;
        $prev = (string)$prev . "2";
    }
    return (int)$prev;
}

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if (isset($_POST['previous-sem'])) {
        if ($_SESSION['semester'] > 0) {
            $_SESSION['semester']--;
        }
    }

    if (isset($_POST['next-sem'])) {
        if ($_SESSION['semester'] < count($semesters) - 1) {
            $_SESSION['semester']++;
        }
    }
}
?>