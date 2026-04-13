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
    <select name = "FormTutor" id = "FormTutor">
        <option disabled selected hidden>Select tutor...</option>
        <?php foreach($tutors as $t): ?>
            <option value = "<?php echo $t['TutorID']; ?>">
                <?php echo $t['FirstName'] . " " . $t['Surname']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Subject</label>
    <select name = "FormSubject" id = "FormSubject">
        <option disabled selected hidden>Select subject...</option>
        <?php foreach($subjects as $s): ?>
            <option value = "<?php echo $s['SubjectCode']; ?>">
                <?php echo $s['Description']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Room</label>
    <select id = "FormRoom" name = "FormRoom">
        <option disabled selected hidden>Select room...</option>
        <?php foreach($rooms as $r): ?>
            <option value = "<?php echo $r['RoomNo']; ?>">
                <?php echo $r['RoomNo'] . " - " . $r['Description'] . " (" . $r['Capacity'] . ")"; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Day</label>
    <select id = "FormDay" name = "FormDay">
        <option disabled selected hidden>Select day...</option>
        <?php foreach($days as $d): ?>
            <option value = "<?php echo GetDayNum($d); ?>">
                <?php echo $d; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Time</label>
    <select id = "FormTime" name = "FormTime">
        <option disabled selected hidden>Select time...</option>
        <?php foreach($times as $t): ?>
            <option value = "<?php echo $t; ?>">
                <?php echo "$t:00"; ?>
            </option>
        <?php endforeach; ?>
    </select>

</div>
