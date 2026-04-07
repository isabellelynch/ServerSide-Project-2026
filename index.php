<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Calendar And Bookings</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS\grindbookingsys.css">
    <script src = "JavaScript/grindbookingsys.js" defer></script>
    <?php
        session_start();
        if (!isset($_SESSION['room'])) {
            $_SESSION['room'] = 1;
        }

        if (!isset($_SESSION['semester'])) {
            $_SESSION['semester'] = 1;
        }
        require_once("forms/form-filtering.php");
    ?>
  </head>
  <body data-page = "index">
    <?php 
      require_once("basic-page-layout/header.php"); 
      require_once("basic-page-layout/side-bar-nav.php");
      require_once("forms/generate-form.php");
    ?>
    <main>
        <?php
          require_once("stat-cards.php");
          require_once("Schedule/generate-schedule.php"); 
        ?>
    </main>

  </body>
  
</html>


