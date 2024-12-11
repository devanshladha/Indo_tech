<?php
session_start();
include("../connection.php");
include("../defination.php");

if (!isset($_GET['artist_id'])) {
    echo "
        <script>
            location.replace('artisan_list.php'); // Redirect to the artisan list page if artist_id is not set
            window.location.assign('artisan_list.php')
        </script>
    ";
    exit();
}

$artist_id = intval($_GET['artist_id']);

// Fetch artist details
$query = $conn->prepare("SELECT * FROM artisans WHERE id = ?");
$query->bind_param("i", $artist_id);
$query->execute();
$result = $query->get_result();
$artist = $result->fetch_assoc();

if (!$artist) {
    echo "
        <script>
            location.replace('artefacts.php');
            window.location.assign('artefacts.php')
        </script>
    ";
    exit();
}

// Fetch artist's items (optional)
$items_query = $conn->prepare("SELECT * FROM artefacts WHERE artisan_id = ?");
$items_query->bind_param("i", $artist_id);
$items_query->execute();
$items_result = $items_query->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $quiz_font ?>
    <link rel="stylesheet" type="text/css" href="../utility.css">
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2{
            padding-left: 20px;
        }

        .profile-container {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .profile-container img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            margin-right: 20px;
        }

        .profile-details p {
            margin: 5px 0;
            font-size: 1em;
            color: #555;
        }

        .items-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .item {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 300px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .item img {
            width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .item h3 {
            font-size: 1.5em;
            color: #333;
        }

        .item p {
            font-size: 1em;
            color: #555;
        }

    </style>
    <title><?php echo htmlspecialchars($artist['first_name'] . ' ' . $artist['last_name']); ?>'s Profile</title>
</head>
<body>
    <div>
        <?php include("../nav.php") ?>
    </div>
    <div id="main">
        <h1><?php echo htmlspecialchars($artist['first_name'] . ' ' . $artist['last_name']); ?></h1>
        <div class="profile-container">
            <img src="<?php echo htmlspecialchars($artist['profile_image']); ?>" alt="Profile Picture">
            <div class="profile-details">
                <p><b>Email:</b> <?php echo htmlspecialchars($artist['email']); ?></p>
                <p><b>Phone:</b> <?php echo htmlspecialchars($artist['phone']); ?></p>
                <p><b>Address:</b> <?php echo htmlspecialchars($artist['address'] . ', ' . $artist['city'] . ', ' . $artist['state'] . ', ' . $artist['pin_code']); ?></p>
                <p><b>Specialization:</b> <?php echo htmlspecialchars($artist['specialization']); ?></p>
                <p><b>Biography:</b> <?php echo htmlspecialchars($artist['biography']); ?></p>
                <p><b>Website:</b> <a href="<?php echo htmlspecialchars($artist['website']); ?>" target="_blank"><?php echo htmlspecialchars($artist['website']); ?></a></p>
            </div>
        </div>

        <h2>Artworks by <?php echo htmlspecialchars($artist['first_name']); ?></h2>
        <div class="items-container">
            <?php while ($item = $items_result->fetch_assoc()) { ?>
                <div class="item">
                    <img src="<?php echo htmlspecialchars($item['image_url']); ?>" alt="Item Image">
                    <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                    <p><?php echo htmlspecialchars($item['description']); ?></p>
                    <p><b>Price:</b> <?php echo htmlspecialchars($item['price']); ?></p>
                    <p><b>Material:</b> <?php echo htmlspecialchars($item['material']); ?></p>
                    <p><b>Dimensions:</b> <?php echo htmlspecialchars($item['dimensions']); ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
