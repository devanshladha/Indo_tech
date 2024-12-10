<?php

include("../connection.php");
session_start();

if (isset($_SESSION['username'])) {
    if(isset($_POST['register_artisan'])){
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_artisan'])) {
            $username = $_SESSION['username'];


            // Check if the user is already registered as an artisan
            $check_artisan = $conn->prepare("SELECT * FROM artisans WHERE username = ?");
            $check_artisan->bind_param("s", $username);
            $check_artisan->execute();
            $result_artisan = $check_artisan->get_result();

            if ($result_artisan->num_rows > 0) {
                echo "<script>alert('You are already registered as an artisan.');
                                    location.replace('artisan_dash.php');
                                    window.location.assign('artisan_dash.php')
                    </script>";
                exit;
            }

            // Fetch user details from the users table
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                $user_id = $user['id'];
                $username = $user['username'];
                $email = $user['email'];
                $phone = $user['phone'];
                $first_name = $user['first_name'];
                $last_name = $user['last_name'];
                if ($user['community']==1) {
                    $birthdate = $user['birthdate'];
                    $gender = $user['gender'];
                    $pin_code = $user['pin_code'];
                    $state = $user['state'];
                }else{

                    header("Location: register.php?next=register_artisan.php");
                }
            } else {
                echo "<script>alert('User not found.');</script>";
                exit;
            }

            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $city = mysqli_real_escape_string($conn, $_POST['city']);
            $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
            $biography = mysqli_real_escape_string($conn, $_POST['biography']);
            $website = mysqli_real_escape_string($conn, $_POST['website']);

            // Validate data
            if (empty($address) || empty($city) || empty($specialization) || empty($biography)) {
                echo "<script>alert('Please fill in all the required fields.');</script>";
                exit;
            }

            // Handle file upload
            if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
                $profile = $_FILES['profile'];
                $profile_name = $profile['name'];
                $profile_tmp_name = $profile['tmp_name'];
                $profile_size = $profile['size'];
                $profile_error = $profile['error'];
                $profile_type = $profile['type'];

                $profile_ext = strtolower(pathinfo($profile_name, PATHINFO_EXTENSION));
                $allowed = array('jpg', 'jpeg', 'png');

                if (in_array($profile_ext, $allowed)) {
                    if ($profile_size <= (2097152/2)) { // 2MB
                        $profile_new_name =  $user_id . '.' . $profile_ext;
                        $profile_destination = '../profile/artisans/' . $profile_new_name;

                        if (move_uploaded_file($profile_tmp_name, $profile_destination)) {
                            $profile_url = "http://localhost/projects/createX%2024/new/profile/" . $profile_new_name;
                        } else {
                            echo "<script>alert('Failed to upload profile picture.');</script>";
                            exit;
                        }
                    } else {
                        echo "<script>alert('Profile picture size must be 1MB or less.');</script>";
                        exit;
                    }
                } else {
                    echo "<script>alert('Invalid profile picture format. Only JPG, JPEG and PNG are allowed.');</script>";
                    exit;
                }
            } else {
                echo "<script>alert('Profile picture is required.');</script>";
                exit;
            }

            // Insert artisan data into the database
            $stmt = $conn->prepare("INSERT INTO artisans (username, first_name, last_name, birthdate, gender, state, pin_code, address, city, email, phone, profile_image, specialization, biography, website, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'active')");
            $stmt->bind_param("sssssssssssssss", $username, $first_name, $last_name, $birthdate, $gender, $state, $pin_code, $address, $city, $email, $phone, $profile_url, $specialization, $biography, $website);

            if ($stmt->execute()) {
                echo "<script>alert('Congratulations! 🎉 Now you're registered as an artition.');</script>";
                echo "
                    <script>
                        location.replace('../artefacts/artisans_dash.php');
                        window.location.assign('../artefacts/artisans_dash.php')
                    </script>
                ";
            } else {
                echo "<script>alert('Something went wrong, please try again.');location.replace('register_artisan.php');
                        window.location.assign('register_artisan.php')</script>";
            }
        } else {
            echo "
                <script>
                    location.replace('register_artisan.php');
                    window.location.assign('register_artisan.php')
                </script>
            ";
        }
    }else{
        echo "
                <script>
                    location.replace('register_artisan.php');
                    window.location.assign('register_artisan.php')
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