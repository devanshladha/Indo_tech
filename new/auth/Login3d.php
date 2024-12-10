<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CSS 3D form</title>
  
  <!-- HTML -->
  

  <!-- Custom Styles -->
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" ref="" title="" type="" />
</head>

<body>
  <center>
    <form autocomplete="on" action="login_user.php" method="post">
      <div class="login-div">
        <div class="logo">
          <img src="login.png" class="logo" alt="user login form" />
        </div>
        <div class="title">Login</div>
        
        <div class="fields">
        <div class="username">
          <input type="text" placeholder="Username" id="" name ="username" class="user-input" autofocus required/>
        </div>
        <div class="password">
          <input type="password" placeholder="password" id="" name="pass" class="pass-input" autofocus required/>
        </div>
        </div>
        <button class="signin-button" type="submit" id="login_user" name="login_user">Login</button>
        <div class="link">
         <div id="create">
          <a href="signup.php">Create Account</a>

         </div>
          <a href="#">Forgot Password</a>
        </div>
      </div>
    </form>
  </center>
  <!-- Project -->
  <script src="main.js"></script>
</body>
</html>