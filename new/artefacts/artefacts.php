<?php
include("../defination.php");
include("../connection.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php echo $quiz_font ?>
    <link rel="stylesheet" href="style_artefacts.css">
    <link rel="stylesheet" href="../utility.css">
    <title>Artifacts</title>
</head>
<body>

    <?php echo($preloader); ?>

    <div id="page">
        <div>
            <?php include("../nav.php"); ?>
        </div>
        <div id="search-icon-div">
            <input type="search" id="search-box" placeholder="Search here..."></input>
            <span id="search-icon" onclick="show_search_box()"><img src="../src/search_icon_white.png"></span>
        </div>
        <div id="cart-icon-div">
            <span id="cart-icon"><img src="../src/shopping_cart_white.png"></span>
        </div>
        <div id="setting-icon-div">
            <span id="setting-icon" onclick="toggleMenu()">
                <img src="../src/settings_icon_white.png" alt="Settings Icon">
            </span>
            <div id="settings-menu" class="settings-menu">
                <!-- Add your menu items here -->
                <?php 
                if ($_SESSION['artisan']==1) {
                    echo "<a href='artisans_dash.php'>Business dashboard</a>";
                } else {
                    echo "<a href='../auth/register_artisan.php'>Register as artisan</a>";
                }
                ?>
                <a href="../auth/profile.php">Delivery address</a>
            </div>
        </div>
        <div id="main" style="width: auto; margin: 90px 0px 0px 10px;">
            <div class="banner-container"> 
                <div class="banner"> 
                    <img src="../src/loader_sq_comp.gif" alt="Banner Image 1" class="banner-image active"> 
                    <img src="../src/loader_sq_comp.gif" alt="Banner Image 2" class="banner-image"> 
                    <img src="../src/loader_sq_comp.gif" alt="Banner Image 3" class="banner-image"> 
                </div> 
            </div>
            <div class="artifact-container">
                <?php 
                // Fetch artifacts ordered by clicks and sales
                $query = "SELECT * FROM artefacts ORDER BY click DESC, sold DESC";
                $result = mysqli_query($conn, $query);
                while ($row = $result->fetch_assoc()) {

                    echo("
                    <div class='artifact'> 
                        <a href='artefact_detail.php?art_id=". $row['id'] ."'>
                        <div>
                            <img src=".$row['image_url']." alt=".$row['name']."> 
                            <h2>".$row['name']."</h2> 
                            <p class='price'>".$row['price']."</p> 
                            <p class='description'>".$row['description']."</p> 
                        </div> 
                        </a>
                    </div> 
                    ");
                }
                ?>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        <?php echo($preloader_script); ?>

        // Show search box
        function show_search_box(){
            var x = document.getElementById('search-box').style.display;
            if (x === "none" || x === "") {
                document.getElementById('search-box').style.display = "flex";
                document.getElementById('search-icon-div').style.width = "240px";
            } else {
                document.getElementById('search-box').style.display = "none";
                document.getElementById('search-icon-div').style.width = "35px";
            }
        }

        // Banner
        document.addEventListener('DOMContentLoaded', function() { 
            const banner = document.querySelector('.banner'); 
            const bannerImages = document.querySelectorAll('.banner-image'); 
            let currentIndex = 0; 
            function switchBanner() { 
                currentIndex = (currentIndex + 1) % bannerImages.length; 
                banner.style.transform = `translateX(-${currentIndex * 100}%)`; 
            } setInterval(switchBanner, 3000); // Change image every 3 seconds 
        });

        // Setting icon menu
        function toggleMenu() {
            var menu = document.getElementById('settings-menu');
            var icon = document.getElementById('setting-icon');
            var setting_icon = document.getElementById('setting-icon-div');
            if (menu.style.display === "none" || menu.style.display === "") {
                menu.style.display = "block";
                icon.style.transform = "rotate(90deg)";
                setting_icon.style.borderBottomLeftRadius = "0px";
                setting_icon.style.borderBottomRightRadius = "0px";
                setting_icon.style.height = "40px";

            } else {
                menu.style.display = "none";
                icon.style.transform = "rotate(0deg)";
                setting_icon.style.borderBottomLeftRadius = "17.5px";
                setting_icon.style.borderBottomRightRadius = "17.5px";
                setting_icon.style.height = "35px";
            }
        }

    </script>

</body>
</html>
