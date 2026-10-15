<?php 
  require_once(__DIR__ . "/../start-up.php"); 
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
  <body data-page = "subjects">
    <?php require_once(ROOT . "/basic-page-layout/layout.php"); ?>
    
    <main>
        <?php
            require_once(__DIR__ . "/subjects-table.php");

        ?>
    </main>

  </body>
</html>