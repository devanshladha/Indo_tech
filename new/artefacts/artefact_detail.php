<?php
include("../defination.php");
include("../connection.php");
if ($_GET['art_id']) {
    $id = $_GET['art_id'];
    $query = $conn->prepare("SELECT * FROM artefacts WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();

    $title = $row['name'];
    $description = $row['description'];
    $material = $row['material'];
    $dimensions = $row['dimensions'];
    $left = $row['quantity'] - $row['sold'];
    $date_created = $row['date_created'];
    $price = $row['price'];
    $name_artisan = $row['artist'];
}else{
    echo"
        <script>
            location.replace('artefacts.php');
            window.location.assign('artefacts.php')
        </script>
    ";
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
    <title><?php echo("hi"); ?></title>
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
                    <img src="../src/artefacts_1.jpg" alt="loading..">
                </div>
                <div id="detail_div">
                    <div><h2><?php ?></h2></div>
                    <hr>
                    <div class="description small"><b>Description :</b><?php $description; ?></div>
                    <hr>
                    <div class="description small"><b>Material :</b><?php $material; ?></div>
                    <hr>
                    <div class="description small"><b>Dimensions :</b><?php $dimensions; ?></div>
                    <hr>
                    <div class="description small"><b>Left :</b><?php $left; ?></div>
                    <hr>
                    <div class="description small"><b>Date of Creation :</b><?php $date_created ?></div>
                    <hr>
                    <div class="description small"><b>Name of Artisan :</b><?php $name_artisan ?></div>
                    <hr>
                    <div class="price"><b>Price :</b><?php $price; ?><span> (All Taxes are included)</span></div>
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