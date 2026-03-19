<div id="overlay" style = "display:<?php echo $style; ?>"></div>
    <div id="studentForm" style = "display:<?php echo $style; ?>">
            <h3>Add New Student</h3>
            <form method = 'POST' action = "" id = "AddStudentForm">
                <label>First Name :</label>
                <input type = 'text' name = 'FirstName' value = "<?php echo htmlspecialchars($firstName); ?>"><br>
                <label>Surname :</label>
                <input type = 'text' name = 'Surname' value = "<?php echo htmlspecialchars($surname); ?>"><br>
                <label>Email :</label>
                <input type = 'text' name = 'Email' placeholder = 'example@example.com' value = "<?php echo htmlspecialchars($email); ?>"><br>
                <label>Phone Number :</label>
                <input type = 'text' name = 'PhoneNo' placeholder = '086-0000000' value = "<?php echo htmlspecialchars($phone); ?>"><br><br>
                <p><?php echo $errors[0] ?? $success; ?></p>
                <button type="submit" name = 'SubmitAddStudent' id = 'SubmitAddStudent'><?php echo htmlspecialchars($operation); ?> Student</button>
                <button type="submit" name = 'CloseForm' id = 'CloseForm'>Close</button>
            </form>
</div>