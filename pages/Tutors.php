<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Tutors</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/grindbookingsys.css">
    <?php 
      include_once("../include-for-functions/DatabaseActions.php");
      $details = getDetails();

      $_SESSION['current_page'] = $_SERVER['PHP_SELF'];
    ?>
  </head>
  <body>
    <?php 
      include_once("../include-for-display/Header.php");
      include_once("../include-for-display/SideBar.php"); 
    ?>

    <div>

    </div>
    <main>
         <?php include_once("../DataTable/GenerateTable.php"); ?>
    </main>
  </body>
  <script src="../JavaScript/grindbookingsys.js"></script>
</html>
