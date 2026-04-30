<?php 
    require_once(ROOT . "/forms/form-handlers/student-class-booking.php"); 
    global $page;
    $booking = $_SESSION['other-form'][$page]??false;
?>
<div id = "book-for-student" class = "<?php echo ($booking === true)?'showthisform':'dontshow'; ?>">
    <label>Student Email</label>
        <input 
            type="text" 
            placeholder="e.g. isabellelynch@gmail.com" 
            name = "student-email">
    <input type = "hidden" id = "ClassID" name = "classid" value = "<?php echo $_SESSION['class']??''; ?>"></input>
</div>