<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Students</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/grindbookingsys.css">
    <?php require_once("../set-up.php"); ?>
  </head>
  <body data-page = "students">
    <main>
      <?php 
        require_once(ROOT . "/Students/student-handling.php"); 
        require_once(ROOT . "/student-tutor-table/generate-table.php");
      ?>
    </main>
  </body>
  <script src="../JavaScript/grindbookingsys.js"></script>
</html>
