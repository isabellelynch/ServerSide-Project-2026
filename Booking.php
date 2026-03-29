<?php 
include_once("include-for-functions/DatabaseActions.php");
$tutors = GetAllTutorNames();
$subjects = GetSubjectNames();
$rooms = GetRoomDetails();
$days = ["Monday","Tuesday","Wednesday","Thursday","Friday"];
$times = [];
for($i = 9; $i <= 17; $i ++){
  if($i < 10){
    $times[] = "0$i:00";
  }
  else{
    $times[] = "$i:00";
  }
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
                    <?php echo $t['FirstName'] . " " . $t['Surname']; ?>
                </option>
            <?php endforeach; ?>
          </select>
        
        <label>Subject</label>
          <select>
            <option disabled selected hidden>Select subject...</option>
            <?php foreach($subjects as $s): ?>
                <option>
                    <?php echo $s; ?>
                </option>
            <?php endforeach; ?>
          </select>

        <label>Room</label>
        <select>
            <option disabled selected hidden>Select room...</option>
            <?php foreach($rooms as $r): ?>
                <option>
                    <?php echo $r['RoomNo'] . " - " . $r['Description'] . " (" . $r['Capacity'] . ")"; ?>
                </option>
            <?php endforeach; ?>
        </select>
        

        <label>Day</label>
        <select>
            <option disabled selected hidden>Select day...</option>
            <?php foreach($days as $d): ?>
                <option>
                    <?php echo $d; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Time</label>
        <select>
            <option disabled selected hidden>Select time...</option>
            <?php foreach($times as $t): ?>
                <option>
                    <?php echo $t; ?>
                </option>
            <?php endforeach; ?>
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
