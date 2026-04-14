<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Calendar And Bookings</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../CSS/grindbookingsys.css">
    <script src = "../JavaScript/grindbookingsys.js"></script>
  </head>
  <body data-page = "index">
    <?php 
      require_once("../start-up.php");
      include_once(ROOT . "/database-interactions/statistics.php");
      include_once(ROOT . "/database-interactions/general.php");
    ?>
    <main>
      <div class="stats-row">
        <?php
        
          global $rev, $result;

          $stats = [
              [
                  'heading' => "This Years Revenue",
                  'value' => $rev,
                  'sub' => $result
              ],
              [
                  'heading' => "Bookings This Year",
                  'value' => GetThisYearsBookings(),
                  'sub' => "Bookings made so far in " . date("Y")
              ],
              [
                  'heading' => "Active Tutors",
                  'value' => GetActive("Tutors"),
                  'sub' => "All available for bookings"
              ],
              [
                  'heading' => "Active Students",
                  'value' => GetActive("Students"),
                  'sub' => "All actively participating in classes"
              ]
          ];

          foreach($stats as $s):
        ?>
          <div class="stat-card">
              <div class="stat-label"><?php echo $s['heading']; ?></div>
              <div class="stat-value"><?php echo $s['value']; ?></div>
              <div class="stat-sub"><?php echo $s['sub']; ?></div>
          </div>
          <?php endforeach; ?>
      </div>
        <?php 
          require_once(ROOT . "/Schedule/generate-schedule.php");
        ?>
    </main>
  </body>
</html>


