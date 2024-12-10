<?php

include("../connection.php");

if(isset($_POST['sign_in'])){

    $salt = "<{adda123}>";

    $password = mysqli_real_escape_string($conn,$_POST['password']);

    // Combine the password with the salt
    $salted_password = $salt . $password;

    // Hash the salted password using SHA-256
    $hashed_password = hash('sha256', $salted_password);

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $first_name = mysqli_real_escape_string($conn, $_POST['firstname']);
    $last_name = mysqli_real_escape_string($conn, $_POST['lastname']);
    $community = isset($_POST['community-button']) ? 2 : 0;

    $i = 0;

    if ($username == "" || $email == "" || $phone == "" || $first_name == "" || $last_name == "") {
        echo "<script>alert('Please enter valid details!');</script>";
        $i = 1;
    }
    if (strlen($password) < 8) {
        echo "<script>alert('Password should contain a minimum of 8 characters.');</script>";
        $i = 1;
    }
    if (true) {
        $check_email = "SELECT * FROM users WHERE email = '$email'";
        
        $run_email = mysqli_query($conn, $check_email);
        
        $check1 = mysqli_num_rows($run_email);

        $check_username = "SELECT * FROM users WHERE username = '$username'";
        
        $run_username = mysqli_query($conn, $check_username);
        
        $check2 = mysqli_num_rows($run_username);
        
        if ($check1 > 0) {
            echo "<script>alert('This email already exists!');</script>";
            $i = 1;
        }
        if ($check2 > 0) {
            echo "<script>alert('This username already exists!');</script>";
            $i = 1;
        }
    }
    if (preg_match('/\s/', $username)) {
        echo "<script>alert('Spaces are not allowed in USERNAME!');</script>";
        $i = 1;
    }
    if (!preg_match('/^[a-zA-Z0-9_.-]+$/', $username)) { 
        echo "<script>alert('Invalid username: Only letters, numbers, underscores, periods, and hyphens are allowed.');</script>"; 
        $i = 1;
    }
    if ($i == 1) {
        echo "
            <script>
                location.replace('signup.php');
                window.location.assign('signup.php')
            </script>
        ";
        $i = 0;
    } else {
        $insert = "INSERT INTO users (username, email, phone, password, first_name, last_name, community, profile_image, status) VALUES ('$username', '$email', '$phone', '$hashed_password', '$first_name', '$last_name', '$community', 'http://localhost/projects/createX%2024/new/profile/profile_img.png', 'inactive')";
        if ($conn->query($insert) == true) {
            echo "Successfully inserted";
            echo $community;
            if ($community == 2) {
                session_start();
                $_SESSION['username'] = $username;
                echo "
                    <script>
                        location.replace('register.php');
                        window.location.assign('register.php')
                    </script>
                ";
                header("Location: register.php");
            } else {
                echo "
                    <script>
                        alert('Congratulations! 🎉 Your account is created successfully, please log in with your username and password.');
                        location.replace('Login3d.php');
                        window.location.assign('Login3d.php')
                    </script>
                ";
            }
        } else {
            echo "Something went wrong, please try again.";
        }
    }
} else {
    echo "
            <script>
                location.replace('signup.php');
                window.location.assign('signup.php')
            </script>
        ";
}

$conn->close();
?>
