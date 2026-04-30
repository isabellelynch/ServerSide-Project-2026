<?php 
  require_once("../start-up.php"); 
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
    <script src = "../JavaScript/grindbookingsys.js"></script>

  </head>
  <body data-page = "schedule">
    
    <main>
        <?php
            require_once(ROOT . "/Schedule/generate-schedule.php");
            require_once(ROOT . "/forms/form-filtering.php"); 
        ?>
    </main>

  </body>
  
</html>