<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tutors</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/grindbookingsys.css">
  </head>
  <body data-page = "tutors">
    <?php 
      require_once("../start-up.php"); 
    ?>
    <main>
         <?php include_once(ROOT . "/student-tutor-table/generate-table.php"); ?>
    </main>

  </body>
  <script src="../JavaScript/grindbookingsys.js"></script>
</html>
