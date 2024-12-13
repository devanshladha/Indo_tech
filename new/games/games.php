<?php
include("../defination.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <?php echo $quiz_font ?>
    <link rel="stylesheet" href="style_game.css">
    <link rel="stylesheet" href="../utility.css">
    <title><?php $games_games_title; ?></title>
</head>
<body>

    <?php echo($preloader) ?>

    <div id="page">
        <div>
            <?php include("../nav.php") ?>
        </div>
        <div id="main" style="width: auto;">
              <div class="artifact-container"> 
                <div class="artifact">
                <a href="reward.php"> 
                    <img src="../src/10.png" alt="Artifact 1"> 
                    <h2>Daily Quiz </h2> 
                    <br>
                    <a href="reward.php"><button>Reward dashward</button></a>
                </a>
                </div>
              </div>
                <hr style="width:94%;text-align:left;margin-left:40px">
            <div class = "artifact-container">
                <div class="artifact">
                <a href="<?php echo"quiz_game.php?id=1"; ?>"> 
                    <img src="../src/questionmark.jpg" alt="quiz_game"> 
                    <h2>Quiz Game</h2> 
                    <p class="description">Play the quiz game and gain the knowledge.</p>
                </a>  
                </div>
                <div class="artifact">
                <a href="<?php echo"quiz_game.php?id=2"; ?>"> 
                    <img src="../src/dance_quiz_image.webp" alt="quiz_game"> 
                    <h2>Quiz Game On Dance Art</h2> 
                    <p class="description">Play the quiz game and gain the knowledge in the field of dance.</p>
                </a>  
                </div>
                <div class="artifact">
                <a href="<?php echo"quiz_game.php?id=3"; ?>"> 
                    <img src="../src/quiz_image_photo.webp" alt="quiz_game"> 
                    <h2>Quiz Game With Image Hint</h2> 
                    <p class="description">Play the quiz game and gain the knowledge.</p>
                </a>  
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        <?php echo($preloader_script); ?>
    </script>

</body>
</html>