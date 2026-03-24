<div id="overlay">
</div>

<div id="StudentFormContainer">

    <h3 id = 'FormHeader'></h3>
    <form method = 'POST' action = "" id = "AddStudentForm">
        <div id='InputContainer'>
            <label>First Name :</label><br>
                <input type = 'text' name = 'FirstName' value = "<?php echo (isset($firstName))?htmlspecialchars($firstName):""; ?>">
                <br>

            <label>Surname :</label><br>
                <input type = 'text' name = 'Surname' value = "<?php echo (isset($surname))?htmlspecialchars($surname):""; ?>">
                <br>

            <label>Email :</label><br>
                <input type = 'text' name = 'Email' placeholder = 'example@example.com' value = "<?php echo (isset($email))?htmlspecialchars($email):""; ?>">
                <br>

            <label>Phone Number :</label><br>
                <input type = 'text' name = 'PhoneNo' placeholder = '086-0000000' value = "<?php echo (isset($phone))?htmlspecialchars($phone):""; ?>">
                <br>
                <br>
            <input type = 'hidden' name = 'id' value = "<?php echo (isset($id))?htmlspecialchars($id):""; ?>">
        </div>
        <p><?php echo isset($msg[0])?htmlspecialchars($msg[0]):""; ?></p>
        <div class = 'ButtonContainer'>

            <button type="submit" name = 'StudentOperationButton' id = 'StudentOperationButton'>Student</button>

            <button type="submit" name = 'PermanentRemoval' id = 'PermanentRemoval'>Remove Student</button>

            <button type="submit" name = 'CloseForm' id = 'CloseForm'>Close</button>
        </div>
    </form>

</div>