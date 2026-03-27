<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Students</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <?php 
      include_once("include-for-functions/FormHandling.php");  
      include_once("include-for-functions/DatabaseActions.php");
    ?>
  </head>
  <body>
    
    <?php 
      include_once("include-for-display/Header.php");
      require_once("include-for-display/SideBar.php"); 
    ?>
    <main>
        <?php include_once("include-for-display/GenerateTable.php"); ?>
    </main>
  </body>
  <script src="project.js"></script>
</html>
