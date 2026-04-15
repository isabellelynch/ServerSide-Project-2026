<?php 
    require_once(ROOT . "/forms/form-handlers/add-student-from-schedule-click.php"); 
    $booking = $_SESSION['other-form']??false;
?>
<div id = "book-for-student" class = "<?php echo ($booking === true)?'showthisform':'dontshow'; ?>">
    <label>Student Email</label>
        <input 
            type="text" 
            placeholder="e.g. isabellelynch@gmail.com" 
            name = "student-email">
    <input type = "hidden" id = "ClassID" name = "classid" value = "<?php echo $_SESSION['class']??''; ?>"></input>
</div>