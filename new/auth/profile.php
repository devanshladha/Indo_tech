<?php
session_start();
include("../connection.php");

if (!isset($_SESSION['username'])) {
    header('Location: ../auth/Login3d.php');
    exit();
}

$username = $_SESSION['username'];

// Fetch user details
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$user_id = $user['id'];
$current_profile_image = $user['profile_image'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $profile_image_url = $current_profile_image; // Keep the existing profile image URL by default

    // Handle profile image upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $image = $_FILES['profile_image'];
        $image_tmp_name = $image['tmp_name'];
        $image_ext = strtolower(pathinfo($current_profile_image, PATHINFO_EXTENSION));
        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($image_ext, $allowed)) {
            if ($image['size'] <= 2097152) { // 2MB
                $image_destination = "../uploads/profile/{$user_id}." . $image_ext;

                // Delete the old profile image if it exists
                if (file_exists($image_destination)) {
                    unlink($image_destination);
                }

                if (move_uploaded_file($image_tmp_name, $image_destination)) {
                    $profile_image_url = "http://localhost/projects/createX%2024/new/uploads/profile/{$user_id}." . $image_ext;
                } else {
                    echo "<script>alert('Failed to upload profile picture.');</script>";
                    exit;
                }
            } else {
                echo "<script>alert('Profile picture size must be 2MB or less.');</script>";
                exit;
            }
        } else {
            echo "<script>alert('Invalid profile picture format. Only JPG, JPEG, and PNG are allowed.');</script>";
            exit;
        }
    }

    // Update user profile
    $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ?, profile_image = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $first_name, $last_name, $email, $phone, $profile_image_url, $user_id);

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully!');</script>";
        header('Location: profile.php');
        exit;
    } else {
        echo "<script>alert('Something went wrong, please try again.');</script>";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../auth/Login3d.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="../utility.css">
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-self: center;
            justify-content: space-between;
            align-items: center;
            margin-top: 60px;
            padding: 20px;
            padding-bottom: 0px;
            width: 600px;
        }

        h2 {
            color: #333;
            margin: 0;
        }

        .logout-button {
            background-color: #e91e63;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: red;
        }

        form {
            background-color: white;
            max-width: 600px;
            margin: 30px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 15px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="file"],
        form button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        form input[type="text"]:focus,
        form input[type="email"]:focus,
        form input[type="file"]:focus {
            border-color: #e91e63;
            outline: none;
            box-shadow: 0 0 5px rgba(233, 30, 99, 0.5);
        }

        form button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }

        form button:hover {
            border: 3px solid #764b36;
            color: #764b36;
            background-color: #F5F5DC;
        }

        form input[type="file"] {
            padding: 3px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Update Profile</h2>
        <a href="profile.php?logout=true" class="logout-button">Logout</a>
    </div>
    <form action="profile.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
        </div>
        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>
        </div>
        <div>
            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image" accept="image/*">
        </div>
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
