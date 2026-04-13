<div id = "new-or-update-form">
    <label>First Name</label>
        <input type="text" name = "firstname">

    <label>Surname</label>
        <input type="text" name = "surname">

    <label>Email</label>
        <input type="text" name = "email">

    <label>Phone Number</label>
        <input type="text" name = "phone">

    <?php 
        require_once(ROOT . "/database-interactions/general.php");
        $page = getCurrentPage();
        if($page === "Tutors"):
    ?>
        <label>Rate</label>
            <input type="text" name = "rate">
    <?php 
        endif; 
    ?>
    <input type="hidden" name = "update-id" value = "">
</div>