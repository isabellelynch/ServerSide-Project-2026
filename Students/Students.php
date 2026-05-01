<?php 
  require_once("../start-up.php"); 

  //link in table to go from active to inactive
  if (isset($_GET['action']) && $_GET['action'] === 'SetToInactive') 
  {
      $id = $_GET['id'];
      try 
      {
          UpdateStatus("Students",$id);
          header("Location: Students.php" );
          exit();
      }
      catch (PDOException $e) 
      { 
          $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine(); 
      }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $pageTitle; ?></title>

    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $pageDescription; ?>">
    <meta name="author" content="Isabelle Lynch">
    <meta name="keywords" content="<?php echo $pageKeyWords; ?>">

    <link rel="stylesheet" href="../CSS/grindbookingsys.css">
    <link rel="icon" href="../grindsbookingsys-favicon.ico">
    <script src = "../JavaScript/grindbookingsys.js"></script>

  </head>
  <body data-page = "students">
    
    <main>
      <?php  
        require_once(ROOT . "/student-tutor-table/generate-table.php");
      ?>
    </main>
  </body>
</html>
