<?php
    include_once("include-for-functions/DatabaseActions.php");
    global $details;

?>
<header class="topbar">
    <div class="topbar-title" id="topbarTitle"><?php echo $details['page-heading']; ?></div>
    <div class="topbar-right">
      <span class="topbar-badge" id="topbarBadge"><?php echo $details['page-badge']; ?></span>

      <button class="btn-primary" id="top-bar-btn"><?php echo $details['top-bar-button']; ?></button>

    </div>
</header>

