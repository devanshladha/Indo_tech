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
    <title><?php  ?></title>
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
                    <p class="description">A brief description of the artifact.</p>
                    <br>
                    <a href="reward.php"><button>Reward dashward</button></a>
                </a>
                </div>
              </div>
                <hr style="width:94%;text-align:left;margin-left:40px">

              <div class="artifact-container"> 
                <div class="artifact">
                <a href="quiz_game.php"> 
                    <img src="../src/questionmark.jpg" alt="Artifact 1"> 
                    <h2>Quiz Game</h2> 
                    <p class="description">A brief description of the artifact.</p>
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