<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Calendar And Bookings</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles.css">
    <?php 
      include_once("FormHandling.php"); 
      include_once("DisplayForm.php");  
      include_once("DatabaseActions.php");
    ?>
  </head>
  <body>
    
    <?php 
      include_once("Header.php");
      require_once 'Include/SideBar.php'; 
    ?>
    <main>
      <div class="stats-row">
        <div class="stat-card">
          <div class="stat-label">This Years Revenue</div>
          <div class="stat-value"><?php echo (GetYearlyRevenue()>0)?GetYearlyRevenue():"0"; ?></div>
          <div class="stat-sub"><?php echo (GetYearlyRevenueDifference() > 0)?
                                      "Up " . GetYearlyRevenueDifference() . " on last year":
                                      "Down "  . GetYearlyRevenueDifference() . " on last year"; ?>
          </div>
        </div>
        <div class="stat-card">
          <div class="stat-label">Bookings This Year</div>
          <div class="stat-value"><?php echo GetThisYearsBookings(); ?></div>
          <div class="stat-sub">Bookings made so far in <?php echo date("Y"); ?></div>
        </div>
        <div class="stat-card">
          <div class="stat-label">Active Tutors</div>
          <div class="stat-value"><?php echo GetActive("Tutors"); ?></div>
          <div class="stat-sub">All available for bookings</div>
        </div>
        <div class="stat-card">
          <div class="stat-label">Active Students</div>
          <div class="stat-value"><?php echo GetActive("Students"); ?></div>
          <div class="stat-sub">All actively participating in classes</div>
        </div>
      </div>

    </main>
  </body>
  <script src="project.js"></script>
</html>


