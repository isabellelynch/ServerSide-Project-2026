<?php 
    require_once(ROOT . "/forms/form-handlers/student-tutor.php"); 
    $new = $_SESSION['header-form']??false;
?>
<div id = "new-or-update-form" class = "<?php echo ($new === true)?'showthisform':'dontshow'; ?>">
    <label>First Name</label>
        <input type="text" name = "firstname" placeholder = "eg. Isabelle">

    <label>Surname</label>
        <input type="text" name = "surname" placeholder = "eg. Lynch">

    <label>Email</label>
        <input type="text" name = "email" placeholder = "eg. isabelle@gmail.com">

    <label>Phone Number</label>
        <input type="text" name = "phone" placeholder = "eg. 086-1231233">

    <?php 
        require_once(ROOT . "/database-interactions/general.php");
        $page = getCurrentPage();
        if($page === "Tutors"):?>
        <label>Rate</label>
        <select id = "rate" name = "rate">
            <option disabled selected hidden>Select rate...</option>
            <?php 
            require_once("../database-interactions/tutors.php");
            $rates = GetTutorRates();
            foreach($rates as $r): 
            ?>
                <option value = "<?php echo $r['HourlyRate']; ?>">
                    <?php echo $r['RateCode'] . " - €" . $r['HourlyRate']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    <?php 
        endif; 
    ?>
    <input type="hidden" name = "update-id" value = "">
</div>