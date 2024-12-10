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
    exit;
}

$username = $_SESSION['username'];

// Fetch artisan ID
$stmt = $conn->prepare("SELECT id FROM artisans WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$artisan = $result->fetch_assoc();
$artisan_id = $artisan['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $biography = mysqli_real_escape_string($conn, $_POST['biography']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);

    // Update artisan profile
    $stmt = $conn->prepare("UPDATE artisans SET first_name = ?, last_name = ?, biography = ?, website = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $first_name, $last_name, $biography, $website, $artisan_id);

    if ($stmt->execute()) {
        echo "<script>alert('Profile updated successfully!');</script>";
        echo "
            <script>
                location.replace('artisans_dash.php');
                window.location.assign('artisans_dash.php')
            </script>
        ";
    } else {
        echo "<script>alert('Something went wrong, please try again.');</script>";
    }
}

$conn->close();
?>
