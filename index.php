<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login</title>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="CSS/grindbookingsys.css">
    <script src="JavaScript/grindbookingsys.js"></script>
    <?php 
      session_start();
      require_once("Login/handle-login.php"); 
      ?>
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
        <input type="email" id="email" name = "email" placeholder="admin@grindsschool.ie">
      </div>

      <div class="field">
        <div class="field-row">
          <label for="password">Password</label>
          <a href="#" class="forgot">Forgot password?</a>
        </div>
        <input type="password" id="password" name = "password"  placeholder="••••••••">
      </div>

      <button type = "submit" id = "login-btn" name = "login-btn">Sign in</button>

      <p id = "note">Need access? <a href="#">Contact your administrator</a></p>
    </form>
  </main>
<?php if(isset($_SESSION['msg']) && isset($_SESSION['msgtitle'])):?>
<div  id="toast" class="toast show">
    <strong id="toastTitle"><?php echo $_SESSION['msgtitle']; ?></strong>
    <span id="toastBody" class = "toast-msg"><?php echo $_SESSION['msg']; ?></span>
</div>
<?php 
    endif; 
?>
</body>
  
</html>