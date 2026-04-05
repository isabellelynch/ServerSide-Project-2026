<?php 
    include_once(ROOT . "/database-interactions/tutors.php");
    $tutors = GetAllTutorNames();

    include_once(ROOT . "/database-interactions/subjects.php");
    $subjects = GetSubjectNames();

    include_once(ROOT . "/database-interactions/rooms.php");
    $rooms = SelectAll("Rooms");
    
    include_once(ROOT . "/include-for-functions/day-mapper.php");
    global $days, $times;
?>

<div id = "add-new-class">
    <label>Tutor</label>
    <select>
        <option name = "FormTutor" disabled selected hidden>Select tutor...</option>
        <?php foreach($tutors as $t): ?>
            <option value = "<?php $t['TutorID']; ?>">
                <?php echo $t['FirstName'] . " " . $t['Surname']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Subject</label>
    <select>
        <option name = "FormSubject" disabled selected hidden>Select subject...</option>
        <?php foreach($subjects as $s): ?>
            <option>
                <?php echo $s; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Room</label>
    <select>
        <option name = "FormRoom" disabled selected hidden>Select room...</option>
        <?php foreach($rooms as $r): ?>
            <option>
                <?php echo $r['RoomNo'] . " - " . $r['Description'] . " (" . $r['Capacity'] . ")"; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Day</label>
    <select>
        <option name = "FormDay" disabled selected hidden>Select day...</option>
        <?php foreach($days as $d): ?>
            <option>
                <?php echo $d; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Time</label>
    <select>
        <option name = "FormTime" disabled selected hidden>Select time...</option>
        <?php foreach($times as $t): ?>
            <option>
                <?php echo "$t:00"; ?>
            </option>
        <?php endforeach; ?>
    </select>

</div>