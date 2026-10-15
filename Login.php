<?php 
  require_once(__DIR__ . "/start-up.php");
  require_once(ROOT . "/Login/handle-login.php"); 
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
    
    <link rel="icon" href="grindsbookingsys-favicon.ico">
    <link rel="stylesheet" href="CSS/grindbookingsys.css">
    <script src = "JavaScript/grindbookingsys.js"></script>

  </head>
<body id = 'login-body'>
  <aside id = "left">
    <div id = "branding">
      <h1>Grinds School</h1>
      <p>Admin Portal</p>
    </div>
  </aside>

  <main id = "right">

    <form id = "login-form" action = "" method = "POST">
      <h2>Welcome back</h2>
      <p>Sign in to your admin account</p>

      <div class="field">
        <label for="email">Email address</label>
        <input type="email" id="email" name = "email" placeholder="admin@grindsschool.ie" required autocomplete="username">
      </div>

      <div class="field">
        <div class="field-row">
          <label for="password">Password</label>
          <a href="#" class="forgot">Forgot password?</a>
        </div>
        <input type="password" id="password" name = "password"  placeholder="••••••••" required autocomplete="current-password">
      </div>

      <button type = "submit" id = "login-btn" name = "login-btn">Sign in</button>

      <p id = "note">Need access? <a href="#">Contact your administrator</a></p>
    </form>

  </main>

<?php if(isset($_SESSION['msg']) && isset($_SESSION['msgtitle'])):?>
<div  id="toast" class="toast show">
    <strong id="toastTitle"><?php echo htmlspecialchars($_SESSION['msgtitle']); ?></strong>
    <span id="toastBody" class = "toast-msg"><?php echo htmlspecialchars($_SESSION['msg']); ?></span>
</div>
<?php 
  endif; 
  // show each message once only
  unset($_SESSION['msg'], $_SESSION['msgtitle']);
?>

</body>
</html>