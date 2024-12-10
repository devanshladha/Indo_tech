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
if (isset($_GET['next'])) {
    $_SESSION['next']=$_GET['next'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Register</title>
  
  <!-- HTML -->
  

  <!-- Custom Styles -->
   <style>
    .inline{
        display: inline-flex;
        flex-direction: row;
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
   </style>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" ref="" title="" type="" />
</head>
<body>
<center>
    <form autocomplete="on" action="register_user.php" method="post">
    <div class="login-div">
        <div class="title">Register</div>
        <div class="subtitle">To join our vibrant community,<br> please fill the form.</div>
        <div class="fields">
        <div class="username">
            <input type="text" placeholder="Date Of Birth" id="dob" name ="dob" class="user-input" onfocus="(this.type='date')" required/>
        </div>
        
        <div class="password">
            <select id="gender" onclick="color_change('gender')" name="gender" > 
               <option value="" disabled selected>Select Gender</option>
                <option value="male">Male</option> 
                <option value="female">Female</option> 
                <option value="other">Other</option>
            </select> 
        </div>
        <div class="username">
            <input type="number" placeholder="Pin Code" id="pin_code" name ="pin_code" class="user-input" minlength="6" maxlength="6" autofocus required/>
        </div>
        <div class="username">
            <select id="state" onclick="color_change('state')" name="state" class="user-input" required>
                <option value="" disabled selected>Select a state</option>
                <option value="Andhra Pradesh">Andhra Pradesh</option>
                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                <option value="Assam">Assam</option>
                <option value="Bihar">Bihar</option>
                <option value="Chhattisgarh">Chhattisgarh</option>
                <option value="Goa">Goa</option>
                <option value="Gujarat">Gujarat</option>
                <option value="Haryana">Haryana</option>
                <option value="Himachal Pradesh">Himachal Pradesh</option>
                <option value="Jharkhand">Jharkhand</option>
                <option value="Karnataka">Karnataka</option>
                <option value="Kerala">Kerala</option>
                <option value="Madhya Pradesh">Madhya Pradesh</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Manipur">Manipur</option>
                <option value="Meghalaya">Meghalaya</option>
                <option value="Mizoram">Mizoram</option>
                <option value="Nagaland">Nagaland</option>
                <option value="Odisha">Odisha</option>
                <option value="Punjab">Punjab</option>
                <option value="Rajasthan">Rajasthan</option>
                <option value="Sikkim">Sikkim</option>
                <option value="Tamil Nadu">Tamil Nadu</option>
                <option value="Telangana">Telangana</option>
                <option value="Tripura">Tripura</option>
                <option value="Uttar Pradesh">Uttar Pradesh</option>
                <option value="Uttarakhand">Uttarakhand</option>
                <option value="West Bengal">West Bengal</option>
                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                <option value="Chandigarh">Chandigarh</option>
                <option value="Dadra and Nagar Haveli and Daman and Diu">Dadra and Nagar Haveli and Daman and Diu</option>
                <option value="Lakshadweep">Lakshadweep</option>
                <option value="Delhi">Delhi</option>
                <option value="Puducherry">Puducherry</option>
                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                <option value="Ladakh">Ladakh</option>
            </select>
        </div>
        <button class="signin-button" id="register_user" name="register_user" type="submit">Join</button>
    </div>
  </center>
  </form>


  <script type="text/javascript">
      function color_change(id) {
        document.getElementById(id).style.color = "black";
      }
  </script>
</body>
</html>
