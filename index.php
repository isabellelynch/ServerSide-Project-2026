<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Calendar And Bookings</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS\grindbookingsys.css">
    <?php
        session_start();
        require_once("set-up.php");
        require_once(ROOT . "/Students/student-handling.php"); 
    ?>
  </head>
  <body data-page = "index">
    <main>
        <?php 
          
          require_once(ROOT . "/include-for-display/stat-cards.php");
          require_once(ROOT . "/Schedule/generate-schedule.php"); 
          
        ?>
    </main>

  </body>
  <script src = "JavaScript/grindbookingsys.js"></script>
</html>


