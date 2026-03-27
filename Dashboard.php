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
      
      <form id = 'check-boxes-rooms' method = 'POST' action = ''>
          <label>Room 1
          <input type = 'radio' name = 'rooms' value = '1' <?php echo (isset($_POST['rooms']) && $_POST['rooms'] === '1')?"checked":""; ?>>
          </label>

          <label>Room 2
          <input type = 'radio' name = 'rooms' value = '2' <?php echo (isset($_POST['rooms']) && $_POST['rooms'] === '2')?"checked":""; ?>>
          </label>
          
          <label>Room 3
          <input type = 'radio' name = 'rooms' value = '3' <?php echo (isset($_POST['rooms']) && $_POST['rooms'] === '3')?"checked":""; ?>>
          </label>
          
          <br>
          <button type = 'submit'>Show Classes</button>
      </form>
      <?php
        require_once("include-for-display/GenerateSchedule.php");
      ?>

    </main>
  </body>
  <script src="project.js"></script>
</html>


