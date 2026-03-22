<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Schedule</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <?php require_once("DatabaseActions.php"); ?>
    
  </head>
  <body>
    <?php require_once 'Include/SideBar.php'; ?>
    <main>
        <?php require_once 'Include/GenerateSchedule.php'; ?>
    </main>
  </body>
  <script src="project.js"></script>
</html>
