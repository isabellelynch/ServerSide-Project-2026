<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Calendar And Bookings</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">

  </head>
  <body>
    
    <?php 
      require_once("include-for-display/Header.php");
      require_once ("include-for-display/SideBar.php"); 
    ?>
    <main>
      <?php 
        require_once("include-for-display/GenerateStatsCards.php"); 
      ?>
      <form id = 'checkBoxContainer' method = 'POST' action = ''>
          <label>Room 1</label>
          <input type = 'radio' name = 'rooms' value = '1' <?php echo (isset($_POST['rooms']) && $_POST['rooms'] === '1')?"checked":""; ?>>

          <label>Room 2</label>
          <input type = 'radio' name = 'rooms' value = '2' <?php echo (isset($_POST['rooms']) && $_POST['rooms'] === '2')?"checked":""; ?>>

          <label>Room 3</label>
          <input type = 'radio' name = 'rooms' value = '3' <?php echo (isset($_POST['rooms']) && $_POST['rooms'] === '3')?"checked":""; ?>>

          <button type = 'submit'>Show Classes</button>
      </form>
      <?php
        require_once("include-for-display/GenerateSchedule.php");
      ?>

    </main>
  </body>
  <script src="project.js"></script>
</html>


