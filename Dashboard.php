<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Calendar And Bookings</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <?php 
      require_once("include-for-display/Header.php");
      require_once ("include-for-display/SideBar.php"); 
      require_once("GenerateForm.php");
    ?>
    <main>
      <?php require_once("include-for-display/GenerateStatsCards.php"); ?>
    
      <?php require_once("include-for-display/GenerateSchedule.php"); ?>

    </main>
  </body>
  <script src="project.js"></script>
</html>


