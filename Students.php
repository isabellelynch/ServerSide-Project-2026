<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Students</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    

  </head>
  <body>
  
    
  
    <?php require_once 'Include/SideBar.php'; ?>
    

    <main>
        

        
        <?php include_once("FormHandling.php"); ?>
        <div>
            <button id = "ShowForm">Add Student</button>
        </div>

        <?php include_once 'Include/GenerateTable.php'; ?>
        
    </main>
  </body>
  
  <script src="project.js"></script>
  
</html>
