<?php

session_start();
include("../connection.php");
if (!isset($_SESSION['username'])) {
    echo "
        <script>
            location.replace('Login3d.php');
            window.location.assign('Login3d.php')
        </script>
    ";
    header("Location: Login3d.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Register Artisans</title>
  
  <!-- HTML -->
  

  <!-- Custom Styles -->
   <style>
    .inline{
        display: inline-flex;
        flex-direction: row;
    }
    .pt-10{
        padding-top: 0px;
    }
    .w-100{
        width: 100%;
    }
    .w-90{
        width: 90%;
    }
    #community-button{
        width: 10%;
    }
    #state{
        color: #757575;
        width:300px;
        border-radius: 25px;
        padding: 0px 25px;
        font-size: 20px;
        height: 60px;
        background-color: #F5F5DC;
        border: none;
        box-shadow: inset 8px 8px 8px #cbced1,
                    inset -8px -8px 8px #ffffff;
    }
    #gender{
        color: #757575;
        width:300px;
        border-radius: 25px;
        padding: 0px 25px;
        font-size: 20px;
        height: 60px;  
        background-color: #F5F5DC;
        border: none;
        box-shadow: inset 8px 8px 8px #cbced1,
                    inset -8px -8px 8px #ffffff;
    }
    label{
        display: inline-block;
        align-content: center;
        justify-items: left;
        color: #757575;
        width:90%;
        border-radius: 25px;
        padding: 0px 25px;
        font-size: 20px;
        font-family: 'Lato' sans-serif;
        font-weight: 300;
        height: 60px;  
        background-color: #F5F5DC;
        border: none;
        box-shadow: inset 8px 8px 8px #cbced1,
                    inset -8px -8px 8px #ffffff;
    }

   </style>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" ref="" title="" type="" />
</head>
<body>
<center>
    <form autocomplete="on" action="register_artisan_auth.php" method="post" enctype="multipart/form-data">
    <div class="login-div">
        <div class="title pt-10">Register As Artisans</div>
        <div class="subtitle">Please fill the form.</div>
        <div class="fields">
        <div class="username">
            <input type="text" placeholder="Address" id="address" name ="address" class="user-input" autofocus required/>
        </div>
        <div class="username">
            <input type="text" placeholder="City" id="city" name ="city" class="user-input" autofocus required/>
        </div>
        <input type="file" placeholder="Profile Picture" id="profile" name ="profile" class="user-input"  autofocus required hidden/>
        <label for="profile" class="username">Choose a profile picture</label>
        <div class="username">
            <input type="text" placeholder="Specialization" id="specialization" name ="specialization" class="user-input" autofocus required/>
        </div>
        <div class="username">
            <input type="text" placeholder="About yourself" id="biography" name ="biography" class="user-input" autofocus required/>
        </div>
        <div class="username">
            <input type="text" placeholder="Website" id="website" name ="website" class="user-input" autofocus required/>
        </div>
        <button class="signin-button" id="register_artisan" name="register_artisan" type="submit">Register as artisan</button>
        </div>
  </center>
  </form>


  <script type="text/javascript"></script>
</body>
</html>
