<?php
// Returns <option> lists for the "Add Class" form's dropdowns.
// Called by JavaScript (filterForm in grindbookingsys.js) whenever a tutor, subject, room or day is chosen.

require_once(__DIR__ . "/../start-up.php");      // session, login check and ROOT
require_once(ROOT . "/database-interactions/subjects.php");
require_once(ROOT . "/database-interactions/tutors.php");
require_once(ROOT . "/include-for-functions/day-mapper.php");
require_once(ROOT . "/Schedule/schedule-handling.php");
require_once(ROOT . "/Schedule/semesters.php");

global $semesters;

$action = $_GET['action'] ?? '';
$e = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES);

// tutor chosen - show only the subject that tutor teaches
if($action === 'tutorChanged'){
    $subject = getTutorSubjectDetails((int)($_GET['id'] ?? 0));
    if($subject){
        echo "<option value='{$e($subject['SubjectCode'])}' selected>{$e($subject['Description'])}</option>";
    }
}

// subject chosen - show only the active tutors who teach it
if($action === 'subjectChanged'){
    $tutors = GetSpecificTutorNames((string)($_GET['id'] ?? ''));
    if(empty($tutors)){
        echo "<option value='' disabled selected>No active tutors teach this subject</option>";
    }
    else{
        echo "<option value='' disabled selected hidden>Select tutor...</option>";
    }
    foreach($tutors as $t){
        echo "<option value='{$e($t['TutorID'])}'>{$e($t['FirstName'] . " " . $t['Surname'])}</option>";
    }
}

// room chosen - show the days that still have a free slot in that room
if($action === "roomChanged"){
    $freeslots = getFreeScheduleSlots((int)($_GET['id'] ?? 0));

    echo "<option value='' disabled selected hidden>Select day...</option>";
    foreach ($freeslots as $daynum => $times){
        if (!empty($times)){
            $dayname = GetDay($daynum);
            echo "<option value='$daynum'>$dayname</option>";
        }
    }
}

// day chosen - show the free start times in that room on that day,
// for the semester currently shown on the schedule
if($action === "dayChanged"){
    $daynum = (int)($_GET['id'] ?? 0);
    $room = (int)($_GET['room'] ?? 0);

    $sem = $semesters[$_SESSION['semester'] ?? 1]['number'];
    $free = getFreeTimes($daynum, $room, $sem);

    echo "<option value='' disabled selected hidden>Select time...</option>";
    foreach($free as $f){
        echo "<option value='$f'>$f:00</option>";
    }
}
?>
