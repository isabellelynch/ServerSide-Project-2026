<?php
    include_once("include-for-functions/DatabaseActions.php");
    function GetHeader(){
        return match(getCurrentPage()){
            "Dashboard" => "Dashboard",
            "Students" => "Manage Students",
            "Tutors" => "Manage Tutors"
        };
    }
?>
<header class="topbar">
    <div class="topbar-title" id="topbarTitle"><?php echo GetHeader(); ?></div>
    <div class="topbar-right">
      <span class="topbar-badge" id="topbarBadge"><?php echo date("F Y"); ?></span>
      <button class="btn-primary" id="topbarBtn">+ New Booking</button>
    </div>
</header>

