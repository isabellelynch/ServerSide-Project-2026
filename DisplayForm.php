<div id="overlay">
</div>

<div id="StudentFormContainer">

    <h3>Add New Student</h3>
    <form method = 'POST' action = "" id = "AddStudentForm">

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

        <p><?php echo $success; ?></p>
        <div id = 'ButtonContainer'>
            <button type="submit" name = 'StudentOperationButton' id = 'StudentOperationButton'><?php echo (isset($operation))?htmlspecialchars($operation):""; ?> Student</button>

            <button type="submit" name = 'PermanentRemoval' id = 'PermanentRemoval'>Remove Student</button>

            <button type="submit" name = 'CloseForm' id = 'CloseForm'>Close</button>
        </div>
    </form>
</div>