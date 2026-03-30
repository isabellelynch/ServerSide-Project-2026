<?php 
  include_once("include-for-functions/DatabaseActions.php");

  $tutors = GetAllTutorNames();
  $subjects = GetSubjectNames();
  $rooms = SelectAll("Rooms");
  global $days, $times;
?>

<div id = "book-for-student">
    <label>Student Email</label>
        <input type="text" placeholder="e.g. isabellelynch@gmail.com" name = "email"
        value = "<?php echo (isset($email))?$email:''; ?>">

    <input type = "hidden" id = "ClassID" name = "classid" value = ""></input>
</div>
<div id = "add-new-class">
    <label>Tutor</label>
    <select>
        <option id = "FormTutor" disabled selected hidden>Select tutor...</option>
        <?php foreach($tutors as $t): ?>
            <option>
                <?php echo $t['FirstName'] . " " . $t['Surname']; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Subject</label>
    <select>
        <option id = "FormSubject" disabled selected hidden>Select subject...</option>
        <?php foreach($subjects as $s): ?>
            <option>
                <?php echo $s; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Room</label>
    <select>
        <option id = "FormRoom" disabled selected hidden>Select room...</option>
        <?php foreach($rooms as $r): ?>
            <option>
                <?php echo $r['RoomNo'] . " - " . $r['Description'] . " (" . $r['Capacity'] . ")"; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Day</label>
    <select>
        <option id = "FormDay" disabled selected hidden>Select day...</option>
        <?php foreach($days as $d): ?>
            <option>
                <?php echo $d; ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Time</label>
    <select>
        <option id = "FormTime" disabled selected hidden>Select time...</option>
        <?php foreach($times as $t): ?>
            <option>
                <?php echo $t; ?>
            </option>
        <?php endforeach; ?>
    </select>

</div>