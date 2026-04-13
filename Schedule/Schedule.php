<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Calendar And Bookings</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/grindbookingsys.css">
  </head>
  <body data-page = "schedule">
    <?php 
      require_once("../start-up.php"); 
    ?>
    <main>
        <?php
            require_once(ROOT . "/Schedule/generate-schedule.php");
            require_once(ROOT . "/forms/form-filtering.php"); 
        ?>
    </main>

  </body>
  <script src = "../JavaScript/grindbookingsys.js"></script>
</html>