<?php 
    require_once(ROOT . "/forms/form-handlers/add-student-from-schedule-click.php"); 
    global $showadminform;
?>
<div id = "book-for-student" class = "<?php if($showadminform) echo "dontshow"; ?>">
    <label>Student Email</label>
        <input 
            type="text" 
            placeholder="e.g. isabellelynch@gmail.com" 
            name = "student-email">
    <input type = "hidden" id = "ClassID" name = "classid" value = ""></input>
</div>