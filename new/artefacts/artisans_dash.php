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

// Fetch artisan details
$stmt = $conn->prepare("SELECT * FROM artisans WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$artisan = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artisan Dashboard</title>
    <link rel="stylesheet" href="../utility.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .dashboard-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h3 {
            margin-bottom: 10px;
            color: #555;
        }
        .section input, .section textarea, .section select, .section button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .section button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }
        .section button:hover {
            border: 3px solid #764b36;
            color: #764b36;
            background-color: #F5F5DC;
        }
        .item-list {
            list-style-type: none;
            padding: 0;
        }
        .item-list li {
            display: flex;
            justify-content: space-between;
            background-color: #f9f9f9;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $artisan['first_name'] . ' ' . $artisan['last_name']; ?></h2>
        
        <div class="section">
            <h3>Upload Item</h3>
            <form action="upload_item.php" method="post" enctype="multipart/form-data">
                <input type="text" name="name" placeholder="Item Name" required>
                <textarea name="description" placeholder="Item Description" required></textarea>
                <input type="text" name="artist" placeholder="Artist" required>
                <input type="number" name="price" placeholder="Item Price" required>
                <input type="text" name="material" placeholder="Material" required>
                <input type="text" name="dimensions" placeholder="Dimensions" required>
                <input type="text" name="category" placeholder="Category" required>
                <input type="date" name="date_created" placeholder="Date Created" required>
                <input type="number" name="status" placeholder="Number of Items Available" required>
                <input type="file" name="image_url" accept="image/*" required>
                <button type="submit">Upload Item</button>
            </form>
        </div>

        <div class="section">
            <h3>Manage Profile</h3>
            <form action="update_profile.php" method="post">
                <input type="text" name="first_name" value="<?php echo $artisan['first_name']; ?>" required>
                <input type="text" name="last_name" value="<?php echo $artisan['last_name']; ?>" required>
                <textarea name="biography" required><?php echo $artisan['biography']; ?></textarea>
                <input type="text" name="website" value="<?php echo $artisan['website']; ?>" required>
                <button type="submit">Update Profile</button>
            </form>
        </div>

        <div class="section">
            <h3>View Sales</h3>
            <ul class="item-list">
                <!-- Fetch and display sales items -->
                <?php
                $stmt = $conn->prepare("SELECT * FROM artefacts WHERE artisan_id = ?");
                $stmt->bind_param("i", $artisan['id']);
                $stmt->execute();
                $sales_result = $stmt->get_result();

                echo "<li>
                        <span><b> NAME </b></span>
                        <span><b> QTY  </b></span>
                        <span><b> SOLD </b></span>
                        <span><b> RETURN </b></span>
                      </li>";

                while ($sale = $sales_result->fetch_assoc()) {
                    echo "<li>
                            <span>" . $sale['name'] . "</span>
                            <span>" . $sale['quantity'] . " sold</span>
                            <span>" . $sale['sold'] . "</span>
                            <span>$" . ($sale['sold'])*$sale['price'] . "</span>
                          </li>";
                }
                ?>
            </ul>
        </div>
    </div>
</body>
</html>
