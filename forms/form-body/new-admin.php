<?php
    global $firstname, $surname, $email;
?>
<div id = "new-admin-form" class = "">
    <label>First Name</label>
        <input type="text" name = "firstname" placeholder="eg. Isabelle" value = "<?php echo htmlspecialchars($firstname); ?>">
        
    <label>Surname</label>
        <input type="text" name = "surname" placeholder="eg. Lynch" value = "<?php echo htmlspecialchars($surname); ?>">

    <label>Email</label>
        <input type="email" name = "email" placeholder="eg. isabelle@gmail.com" value = "<?php echo htmlspecialchars($email); ?>">

    <label>Password</label>
        <input type="password" name = "admin-password" placeholder="••••••••">
    <label>Confirm Password</label>
        <input type="password" name = "admin-password-confirm" placeholder="••••••••">
</div>