<?php
include("../defination.php");
include("../connection.php");

if (isset($_GET['art_id']) and $_GET['art_id']!=null) {
    $id = intval($_GET['art_id']);
    $query = $conn->prepare("SELECT * FROM artefacts WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();

    $title = $row['name'];
    $image_url = $row['image_url'];
    $description = $row['description'];
    $material = $row['material'];
    $dimensions = $row['dimensions'];
    $left = $row['quantity'] - $row['sold'];
    $date_created = $row['date_created'];
    $price = $row['price'];
    $name_artisan = $row['artist'];
    $artisan_id = $row['artisan_id'];
} else {
    echo "
        <script>
            location.replace('artefacts.php');
            window.location.assign('artefacts.php')
        </script>
    ";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $quiz_font ?>
    <link rel="stylesheet" href="style_artefacts.css">
    <link rel="stylesheet" href="../utility.css">
    <title><?php echo htmlspecialchars($title); ?> - Artifact details</title>
</head>
<body>

    <?php echo($preloader); ?>

    <div id="page">
        <div>
            <?php include("../nav.php") ?>
        </div>
        <div id="main">
            <div id="detail">
                <div id="image_div">
                    <img src="<?php echo(htmlspecialchars($image_url))?>" alt="loading..">
                </div>
                <div id="detail_div">
                    <div><h2><?php echo htmlspecialchars($title); ?></h2></div>
                    <hr>
                    <div class="description small"><b>Description:</b> <?php echo htmlspecialchars($description); ?></div>
                    <hr>
                    <div class="description small"><b>Material:</b> <?php echo htmlspecialchars($material); ?></div>
                    <hr>
                    <div class="description small"><b>Dimensions:</b> <?php echo htmlspecialchars($dimensions); ?></div>
                    <hr>
                    <div class="description small"><b>Left:</b> <?php echo htmlspecialchars($left); ?></div>
                    <hr>
                    <div class="description small"><b>Date of Creation:</b> <?php echo htmlspecialchars($date_created); ?></div>
                    <hr>
                    <div class="description small"><b>Name of Artisan:</b> <a href="<?php echo htmlspecialchars('artisans_details.php?artist_id='.$artisan_id)?>"><u><?php echo htmlspecialchars($name_artisan); ?></u></a></div>
                    <hr>
                    <div class="price"><b>Price:</b> <?php echo htmlspecialchars($price); ?><span> (All Taxes are included)</span></div>
                    <div id="cart_button_detail_div"><button id="cart_button_detail_button">Add To Cart</button></div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        <?php echo($preloader_script); ?>
    </script>
</body>
</html>
