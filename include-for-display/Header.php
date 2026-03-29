<?php
    include_once("include-for-functions/DatabaseActions.php");

    function GetHeadingAndBtns(){
        return match(getCurrentPage()){
            "Dashboard" => ['heading' => "Dashboard", 'button' => "+ New Booking"],
            "Students" => ['heading' => "Manage Students", 'button' => "+ New Student"],
            "Tutors" => ['heading' => "Manage Tutors", 'button' => "+ New Tutor"],
        };
    }

    $details = GetHeadingAndBtns();
?>
<header class="topbar">
    <div class="topbar-title" id="topbarTitle"><?php echo $details['heading']; ?></div>
    <div class="topbar-right">
      <span class="topbar-badge" id="topbarBadge"><?php echo date("F Y"); ?></span>
      <button class="btn-primary" id="top-bar-btn"><?php echo $details['button']; ?></button>
    </div>
</header>

