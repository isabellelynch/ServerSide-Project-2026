<?php 
    if($msg != ""){
        $showForm = true;
    }
    else{
        $showForm = false;
    }
?>
<div id="overlay"  style="display: <?php echo $showForm ? 'block' : 'none'; ?>">
</div>

<div id="StudentFormContainer" style="display: <?php echo $showForm ? 'block' : 'none'; ?>">

    <h3 id = 'FormHeader' ><?php if($header) echo $header; ?></h3>
    <form method = 'POST' action = "" id = "AddStudentForm">

            <label>First Name :</label><br>
                <input type = 'text' name = 'FirstName' value = "<?php echo (isset($student['name']))?htmlspecialchars($student['name']):""; ?>">

            <label>Surname :</label><br>
                <input type = 'text' name = 'Surname' value = "<?php echo (isset($student['surname']))?htmlspecialchars($student['surname']):""; ?>">

            <label>Email :</label><br>
                <input type = 'text' name = 'Email' placeholder = 'example@example.com' value = "<?php echo (isset($student['email']))?htmlspecialchars($student['email']):""; ?>">

            <label>Phone Number :</label><br>
                <input type = 'text' name = 'PhoneNo' placeholder = '086-0000000' value = "<?php echo (isset($student['phone']))?htmlspecialchars($student['phone']):""; ?>">

            <input type = 'hidden' name = 'id' value = "">

        <div class = 'ButtonContainer'>
            <button 
                style="display: <?php echo $add ? 'block' : 'none'; ?>"
                type="submit" 
                name = 'AddStudentBtn' 
                id = 'AddStudentBtn'>
                Add Student
            </button>

            <button 
                style="display: <?php echo $update ? 'block' : 'none'; ?>"
                type="submit" 
                name = 'UpdateStudentBtn' 
                id = 'UpdateStudentBtn'>
                Update Student
            </button>

            <button 
                style="display: <?php echo $update ? 'block' : 'none'; ?>"
                type="submit" 
                name = 'PermanentRemoval' 
                id = 'PermanentRemoval'>
                Remove Student
            </button>

            <button 
                type="button" 
                name = 'CloseForm' 
                id = 'CloseForm'>
                Close
            </button>
        </div>
    </form>

</div>
<div id = 'popup' 
    style="display: <?php echo $showForm ? 'block' : 'none'; ?>">
    <p>
        <?php if($msg != "") echo $msg; ?>
    </p>
</div>

    