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
      <form id = 'checkBoxContainer' method = 'POST' action = ''>
          <label>Room 1</label>
          <input type = 'radio' name = 'rooms' value = '1'>

          <label>Room 2</label>
          <input type = 'radio' name = 'rooms' value = '2'>

          <label>Room 3</label>
          <input type = 'radio' name = 'rooms' value = '3'>

          <button type = 'submit'>Show Classes</button>
      </form>
        <?php require_once 'Include/GenerateSchedule.php'; ?> 
    </main>
  </body>
  <script src="project.js"></script>
</html>
