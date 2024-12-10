<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CSS 3D form</title>
  
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
    #firstname{
     width:48%
    
    }
    #lastname{
        width:48%
    }
    #mainname{
         display: inline-flex;
         justify-content: space-between;
    }
    


   </style>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" ref="" title="" type="" />
</head>

<body>
  <center>
    <form autocomplete="on" action="signin_user.php" method="post">
    <div class="login-div">
        <div class="title">Create Account</div>
        <div class="subtitle">Unlock a world,<br> where Art Meets Soul.</div>
        <div class="fields">
        <div class="username">
            <input type="text" placeholder="Username" id="username" name ="username" class="user-input" onkeyup="fetchUsernames()" autofocus required/>
        </div>
        <div id="mainname">
            <div id="firstname">
            <div class="username">
                <input type="text" placeholder="Firstname" id="firstname" name="firstname" class="user-input" autofocus required/>
            </div>
            </div>
            
            <div id="lastname">
            <div class="username">
                <input type="text" placeholder="Lastname" id="lastname" name="lastname" class="user-input" autofocus required/>
            </div>
            </div>
       </div>
        <div class="username">
            <input type="email" placeholder="E-mail" id="email" name="email" class="user-input" autofocus required/>
        </div>
        <div class="username">
            <input type="number" placeholder="Mobile Number" id="phone" name="phone" class="user-input" autofocus required/>
        </div>
        <div class="password">
            <input type="password" placeholder="Password" id="password" name="password" class="pass-input" autofocus required/>
        </div>
        
        <input type="checkbox" id="community-button" placeholder="Join community" name="community-button">
        <span class="w-90">Join community</span>
        
        <button class="signin-button" id="sign_in" name="sign_in" type="submit">Sign in</button>
        </div>
    </div>
    </form>
  </center>
  <!-- Project -->
      
  <script>
      function fetchUsernames() { 
        let query = document.getElementById('username').value; 
        if (query.length > 0 && !/\s/.test(query)) { 
            $.ajax({ 
                url: 'fetch_usernames.php', 
                method: 'POST', data: {query: query}, 
                success: function(data) { 
                    $('#usernameList').html(data); 
                    console.log(data)
                } 
            }); 
        } else { 
            $('#usernameList').html(''); 
            if (/\s/.test(query)) { 
                alert('Spaces are not allowed in usernames.'); 
            } 
        } 
    }
  </script>
</body>
</html>