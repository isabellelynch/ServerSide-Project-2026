<?php
    require_once(dirname(__DIR__) . "/database-interactions/general.php");
    require_once(dirname(__DIR__) . "/database-interactions/subjects.php");
    $badge = match(getCurrentPage()){
        "Students" => GetActive("Students") . " Students",
        "Tutors" => GetActive("Tutors") . " Tutors",
        "Subjects" => GetSubjectCount() . " Subjects",
        default => date("F Y")
    }

?>
<header class="topbar">
    <div class="topbar-title" id="topbarTitle"></div>
    <div class="topbar-right">
      <span class="topbar-badge" id="topbarBadge"><?php echo $badge; ?></span>
      <button class="btn-primary" id="top-bar-btn"></button>
    </div>
</header>

