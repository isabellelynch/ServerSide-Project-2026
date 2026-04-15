<?php 
    require_once(ROOT . "/forms/form-handlers/add-new-staff-member.php"); 
    $admin = $_SESSION['header-form']??false;
?>
<div id = "new-admin-form" class = "<?php echo ($admin === true)?'showthisform':'dontshow'; ?>">
    <label>First Name</label>
        <input type="text" name = "firstname" placeholder="eg. Isabelle" value = "<?php echo $_SESSION['new-firstname']??''; ?>">
        
    <label>Surname</label>
        <input type="text" name = "surname" placeholder="eg. Lynch" value = "<?php echo $_SESSION['new-surname']??''; ?>">

    <label>Email</label>
        <input type="email" name = "email" placeholder="eg. isabelle@gmail.com" value = "<?php echo $_SESSION['new-email']??''; ?>">

    <label>Password</label>
        <input type="password" name = "admin-password" placeholder="••••••••">
    <label>Confirm Password</label>
        <input type="password" name = "admin-password-confirm" placeholder="••••••••">
</div>