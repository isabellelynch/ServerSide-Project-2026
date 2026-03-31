<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Students</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <?php 
      include_once("include-for-functions/DatabaseActions.php");
      include_once("FormHandling.php"); 
      $details = getDetails();
    ?>
    <script src="project.js"></script>
  </head>
  <body>
    <?php 
      require_once("include-for-display/Header.php");
      require_once ("include-for-display/SideBar.php"); 
      require_once("Forms/GenerateForm.php");
    ?>

    <main>
      <div class = "content-header">
        <h2>Students</h2>
        <p>All enrolled students</p>
      </div>
      <?php include_once("include-for-display/GenerateTable.php"); ?>
        
    </main>
  </body>
  
</html>
