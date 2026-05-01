<?php 
    $studentdata = $_SESSION['student-data']??[];
?>
<div id = "book-for-student" class = "">
    <label>Student Email</label>
        <input 
            type="text" 
            placeholder="e.g. isabellelynch@gmail.com" 
            name = "student-email"
            value = "<?php echo htmlspecialchars($studentdata['email'] ?? ''); ?>">
    <input type = "hidden" id = "ClassID" name = "classid" value = "<?php echo htmlspecialchars($studentdata['class']??''); ?>"></input>
</div>