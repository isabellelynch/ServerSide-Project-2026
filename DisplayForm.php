<div id="overlay">
</div>

<div id="StudentFormContainer">

    <h3 id = 'FormHeader' ></h3>
    <form method = 'POST' action = "" id = "AddStudentForm">

            <label>First Name :</label><br>
                <input type = 'text' name = 'FirstName' value = "<?php echo (isset($firstName))?htmlspecialchars($firstName):""; ?>">

            <label>Surname :</label><br>
                <input type = 'text' name = 'Surname' value = "<?php echo (isset($surname))?htmlspecialchars($surname):""; ?>">

            <label>Email :</label><br>
                <input type = 'text' name = 'Email' placeholder = 'example@example.com' value = "<?php echo (isset($email))?htmlspecialchars($email):""; ?>">

            <label>Phone Number :</label><br>
                <input type = 'text' name = 'PhoneNo' placeholder = '086-0000000' value = "<?php echo (isset($phone))?htmlspecialchars($phone):""; ?>">

            <input type = 'hidden' name = 'id' value = "<?php echo (isset($id))?htmlspecialchars($id):""; ?>">
            <input type="hidden" id="showModalFlag" value="<?php echo $showModal ? '1' : '0'; ?>">


        <div class = 'ButtonContainer'>
            <button 
                type="submit" 
                name = 'AddStudentBtn' 
                id = 'AddStudentBtn'>
                Add Student
            </button>

            <button 
                type="submit" 
                name = 'UpdateStudentBtn' 
                id = 'UpdateStudentBtn'>
                Update Student
            </button>

            <button 
                type="submit" 
                name = 'PermanentRemoval' 
                id = 'PermanentRemoval'>
                Remove Student
            </button>

            <button 
                type="submit" 
                name = 'CloseForm' 
                id = 'CloseForm'>
                Close
            </button>
        </div>
    </form>

</div>