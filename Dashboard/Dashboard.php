<?php require_once("../start-up.php");?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $pageTitle; ?></title>

    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <meta name="author" content="Isabelle Lynch">
    <meta name="keywords" content="<?php echo $pageKeyWords; ?>">

    <link rel="icon" href="../grindsbookingsys-favicon.ico">
    <link rel="stylesheet" href="../CSS/grindbookingsys.css">
    <script src = "../JavaScript/grindbookingsys.js"></script>

  </head>
  <body data-page = "index">
    <?php 
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


