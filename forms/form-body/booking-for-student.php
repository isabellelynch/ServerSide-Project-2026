<div id = "book-for-student" class = "">
    <label>Student Email</label>
        <input 
            type="text" 
            placeholder="e.g. isabellelynch@gmail.com" 
            name = "student-email">
    <input type = "hidden" id = "ClassID" name = "classid" value = "<?php echo $_SESSION['class']??''; ?>"></input>
</div>