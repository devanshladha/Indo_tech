<?php

include("../connection.php");
session_start();

if (isset($_SESSION['username'])) {
    if(isset($_POST['register_user'])){

        $dob = mysqli_real_escape_string($conn,$_POST['dob']);
        $gender = mysqli_real_escape_string($conn,$_POST['gender']);
        $pin_code = mysqli_real_escape_string($conn,$_POST['pin_code']);
        $state = mysqli_real_escape_string($conn,$_POST['state']);

        $i = 0;
        $username = $_SESSION['username'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $community = $user['community'];

        if ($community == 1) {
            echo"<script>alert('You have already registered.');
                        location.replace('../index.php?user=".$username."');
                        window.location.assign('../index.php?user=".$username."');
                </script>";
            $i= 1;
        }

        if($dob =="" or $gender =="" or $pin_code ==""or $state ==""){
            echo"<script>alert('please enter vaild details!');</script>";
            $i = 1;
        }

        if(strlen($pin_code) != 6){
            echo"<script>alert('please enter a vaild PIN code!')</script>";
            $i = 1;
        }

        if($i == 1){
            echo "
                <script>
                    location.replace('register.php');
                    window.location.assign('register.php')
                </script>
            ";
            $i=0;
        }else{
            $insert = "UPDATE `users` SET `birthdate`='$dob',`gender`='$gender',`pin_code`='$pin_code',`state`='$state',`profile_image`='http://localhost/projects/createX%2024/new/profile/profile_img.png',`community`='1' WHERE username = '$username'";
            if ($conn->query($insert )==true){
                if ($_SESSION['next'] == "register_artisan.php") {
                    echo "
                        <script>
                            alert('Congratulations! 🎉 Now you are registered as our community member. Fill the form for register as artisan.');
                            location.replace('register_artisan.php');
                            window.location.assign('register_artisan.php')
                        </script>
                    ";
                } else {
                    echo "
                        <script>
                            alert('Congratulations! 🎉 You are registered as our community member.');
                            location.replace('../index.php?user=".$username."');
                            window.location.assign('../index.php?user=".$username."')
                        </script>
                    ";
                }
            }else {
                echo"Something went wrong, please try again!!..";
            }
        }
    }else{
        echo "
                <script>
                    location.replace('Login3d.php');
                    window.location.assign('Login3d.php')
                </script>
            ";
    }

}else{
    echo "
            <script>
                location.replace('Login3d.php');
                window.location.assign('Login3d.php')
            </script>
        ";
}
?>