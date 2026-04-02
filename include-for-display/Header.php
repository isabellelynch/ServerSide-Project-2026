<?php
    require_once(ROOT . "/database-interactions/general.php");
    $badge = match(getCurrentPage()){
        "index" => date("F Y"),
        "Students" => GetActive("Students") . " Students",
        "Tutors" => GetActive("Tutors") . " Tutors"
    }

?>
<header class="topbar">
    <div class="topbar-title" id="topbarTitle"></div>
    <div class="topbar-right">
      <span class="topbar-badge" id="topbarBadge"><?php echo $badge; ?></span>
      <button class="btn-primary" id="top-bar-btn"></button>
    </div>
</header>

