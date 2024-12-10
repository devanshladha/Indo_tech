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
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $artist = mysqli_real_escape_string($conn, $_POST['artist']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $material = mysqli_real_escape_string($conn, $_POST['material']);
    $dimensions = mysqli_real_escape_string($conn, $_POST['dimensions']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $date_created = mysqli_real_escape_string($conn, $_POST['date_created']);
    $quantity = mysqli_real_escape_string($conn, $_POST['status']);

    // Insert the item without the image URL to get the ID
    $stmt = $conn->prepare("INSERT INTO artefacts (name, description, artist, artisan_id, date_created, material, dimensions, price, category, quantity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"); 
    $stmt->bind_param("sssiissdsi", $name, $description, $artist, $artisan_id, $date_created, $material, $dimensions, $price, $category, $quantity);

    if ($stmt->execute()) {
        $item_id = $stmt->insert_id;

        // Handle file upload
        if (isset($_FILES['image_url']) && $_FILES['image_url']['error'] == 0) {
            $image = $_FILES['image_url'];
            $image_name = $image['name'];
            $image_tmp_name = $image['tmp_name'];
            $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($image_ext, $allowed)) {
                if ($image['size'] <= 2097152) { // 2MB
                    $new_image_name = $item_id . '.' . $image_ext;
                    $image_destination = 'artefacts_img/' . $new_image_name;

                    if (move_uploaded_file($image_tmp_name, $image_destination)) {
                        $image_url = "http://localhost/projects/createX%2024/new/artefacts/artefacts_img/" . $new_image_name;

                        // Update the item record with the image URL
                        $update_stmt = $conn->prepare("UPDATE artefacts SET image_url = ? WHERE id = ?");
                        $update_stmt->bind_param("si", $image_url, $item_id);

                        if ($update_stmt->execute()) {
                            echo "<script>alert('Item uploaded successfully!');</script>";
                            echo "
                                <script>
                                    location.replace('artisans_dash.php');
                                    window.location.assign('artisans_dash.php')
                                </script>
                            ";
                        } else {
                            echo "<script>alert('Failed to update item with image URL.');</script>";
                        }
                    } else {
                        echo "<script>alert('Failed to upload item image.');</script>";
                    }
                } else {
                    echo "<script>alert('Item image size must be 2MB or less.');</script>";
                }
            } else {
                echo "<script>alert('Invalid item image format. Only JPG, JPEG, and PNG are allowed.');</script>";
            }
        } else {
            echo "<script>alert('Item image is required.');</script>";
        }
    } else {
        echo "<script>alert('Something went wrong, please try again.');</script>";
    }
}

$conn->close();
?>
