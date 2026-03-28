<?php 
include_once("include-for-functions/DatabaseActions.php");
$tutors = [];
$result = GetAllTutorNames();

while($row = $result -> fetch()){
    $tutors = [
        'firstname' => $row['FirstName'],
        'surname' => $row['Surname']
    ];
}

$result = GetSubjectNames();

while($row = $result -> fetch()){
    $subjects = [
        'description' => $row['Description']
    ];
}


?>

<div class="modal-overlay" id="modalOverlay">

  <div class="modal">

    <div class="modal-head">
      <div><h3 id="modalTitle">New Booking</h3><p id="modalSub">Schedule a student session</p></div>
      <button class="modal-x">X</button>
    </div>


    <form class="modal-form">
        <label>Student Email</label><input type="text" placeholder="e.g. isabellelynch@gmail.com"/>
        <label>Tutor</label>
          <select>
            <option>Select tutor...</option>
            <?php foreach($tutors as $t): ?>
                <option>
                    <?php echo $t['firstname'] . " " . $t['surname']; ?>
                </option>
            <?php endforeach; ?>
          </select>
        
        <label>Subject</label>
          <select>
            <option>Select subject...</option>
            <?php foreach($subjects as $s): ?>
                <option>
                    <?php echo $s['description']; ?>
                </option>
            <?php endforeach; ?>
          </select>

        <label>Room</label>
        <select>
            <option>Select room...</option>
            <option>Maths HL</option><option>English HL</option>
            <option>Biology</option><option>Chemistry</option>
            <option>French</option><option>Irish</option>
            <option>History</option><option>Accounting</option>
        </select>
        

        <label>Day</label>
        <select>
            <option>Select day...</option>
            <option>Maths HL</option><option>English HL</option>
            <option>Biology</option><option>Chemistry</option>
            <option>French</option><option>Irish</option>
            <option>History</option><option>Accounting</option>
        </select>

        <label>Time</label>
        <select>
            <option>Select time...</option>
            <option>Maths HL</option><option>English HL</option>
            <option>Biology</option><option>Chemistry</option>
            <option>French</option><option>Irish</option>
            <option>History</option><option>Accounting</option>
        </select>

    <div class="modal-footer">
      <button class="btn-ghost">Cancel</button>
      <button class="btn-primary">Save Booking</button>
    </div>
    </form>
 </div>
</div>
<div class="toast" id="toast">
  <strong id="toastTitle">✅ Booking Saved</strong>
  <span id="toastMsg">The session has been added to the calendar.</span>
</div>
