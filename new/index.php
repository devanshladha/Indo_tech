<?php 
include("defination.php");
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php echo $quiz_font ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="utility.css">
    <title>
        <?php echo($index_title); ?>
    </title>
</head>

<body>

    <?php echo($preloader) ?>

    <div id="page">
        <div><?php include("nav.php") ?></div>

        <div id="main">
            <div id="section_1" class="section">
                <div id="main_title_box">            
                    <div id="main_title">Know India Better</div>
                    <div id="main_desc">Explore India's rich heritage of art, culture, and history.</div>
                    <div id="button">
                        <button id="explore_button" onclick="window.location.href='explore/explore.php'">Explore</button>
                        <button id="play_game_button" onclick="window.location.href='games/games.php'">Play Games</button>
                    </div>
                    <div id="whats_new_title">What's New —</div>
                    <div id="whats_new">                        
                        <div id="whats_new_items" onclick="window.location.href='games/daily_quiz.php'">
                            <div id="artefact_section_example_img"><img src="src/daily_quiz.png" class="img"></div>
                            <div id="artefact_section_example_name">Daily Quiz</div>
                        </div>
                        <div id="whats_new_items" onclick="window.location.href='digim/index.php'">
                            <div id="artefact_section_example_img"><img src="src/file.png" class="img"></div>
                            <div id="artefact_section_example_name">Digital Museum</div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="section_2" class="section">
                <div id="community_section">
                    <div id="community_section_title">
                        Join Our Vibrant Community
                    </div>
                    <div id="community_section_desc">
                        Join our vibrant community dedicated to celebrating and preserving India's rich art and cultural heritage. Whether you're passionate about classical dance, traditional crafts, historical monuments, or regional festivals, you'll find a platform to share, learn, and grow. Engage in discussions, attend events, and contribute to the dialogue on India's cultural legacy.<br>
                        Be part of a community that cherishes the past and inspires the future—<br>
                        <?php 

                        if ($community == 1) {
                            echo "<div id='community_section_button_section'><button id='community_section_join_button' onclick='change_1()'><b>View</b></button><div id='us_today' class='bold'> community</div></div>";
                        }else{
                            echo "<div id='community_section_button_section'><button id='community_section_join_button' onclick='change_2()'><b>Join</b></button><div id='us_today' class='bold'> Us Today!</div></div>";
                        }

                        ?>
                    </div>
                </div>
            </div>

            <?php 
            // Fetch artifacts ordered by clicks and sales
            $query = "SELECT * FROM artefacts ORDER BY click DESC, sold DESC LIMIT 3";
            $result = mysqli_query($conn, $query);
            ?>

            <div id="section_3" class="section">
                <div id="artefact_section">
                    <div id="artefact_section_title">
                        The Majestic Artefacts of India's Cultural Heritage
                    </div>
                    <div id="artefact_section_desc">
                        Explore India's rich cultural heritage through its majestic artefacts. This collection features intricate sculptures, opulent jewelry, and exquisite textiles, each telling a story of tradition and craftsmanship. Discover the timeless treasures that reflect India's diverse and vibrant history.
                        <br>
                        <br>
                        <h4>Some Artefacts—</h4>
                    </div>
                    <div id="artefact_section_example">
                        <?php 

                        while ($row = $result->fetch_assoc()) {
                            echo"
                                <div id='artefact_section_items'>
                                <div id='artefact_section_example_img'><img src='".$row['image_url']."' class='img'></div>
                                <div id='artefact_section_example_name'>".$row['name']."</div>
                                <div id='artefact_section_example_desc'>".$row['description']."</div>
                            </div>
                            ";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <div id="section_4" class="section">
                <div id="main_title_box">            
                    <div id="main_title">Digital Museum</div>
                    <div id="main_desc">Take a real life experience of our digital museum.</div>
                    <div id="artefact_section_example" onclick="window.location.href='digim/index.php'">
                        <div id="artefact_section_items">
                            <div id="artefact_section_example_img">
                                <img class="img" src="src/digim.png">
                            </div>
                            <div id="artefact_section_example_name">DIGITAL MUSEUM</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="footer">

        </div>
    </div>



    <script type="text/javascript">
        function change_1() {
            window.location.assign('community/index.php');
        };
        function change_2() {
            window.location.assign('auth/register.php');
        };

        <?php echo($preloader_script); ?>
    </script>

</body>

</html>