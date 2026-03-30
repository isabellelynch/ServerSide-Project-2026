<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Calendar And Bookings</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <?php
        require_once("include-for-functions/DatabaseActions.php");
        require_once("StudentHandling.php");
        $details = getDetails();
    ?>
  </head>
  <body>
    <?php 
      require_once("include-for-display/Header.php");
      require_once ("include-for-display/SideBar.php"); 
      require("Forms/GenerateForm.php");
    ?>
    <main>
        <?php 
            require_once("include-for-display/GenerateStatsCards.php");
            require_once("Schedule/GenerateSchedule.php"); 
        ?>
    </main>
  </body>
  <script src="project.js"></script>
</html>


