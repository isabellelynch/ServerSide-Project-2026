<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Students</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/grindbookingsys.css">
  </head>
  <body data-page = "students">
    <?php 
      require_once("../basic-page-layout/header.php"); 
      require_once("../basic-page-layout/side-bar-nav.php");
    ?>
    <main>
      <?php  
        require_once(dirname(__DIR__) . "/student-tutor-table/generate-table.php");
      ?>
    </main>
  </body>
  <script src="../JavaScript/grindbookingsys.js"></script>
</html>
