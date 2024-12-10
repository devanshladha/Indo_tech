<?php 
    include("../defination.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Indo Tech 3D mesuem</title>
    <link rel="stylesheet" type="text/css" href="../utility.css">
    <?php echo $quiz_font ?>
</head>
<body>
    <?php echo($preloader) ?>

    <div id="page">
        <br><br>
        <center><h1>This is the museum created by team Indo Tech </h1></center><br>
        <!-- Embed the Sketchfab model -->
        <iframe width="100%" height="600px" src="https://sketchfab.com/models/d0383b7831ff41709dfbb612efbf76b2/embed" frameborder="0" allowfullscreen></iframe>
    </div>

    <script type="text/javascript">
        <?php echo($preloader_script); ?>
    </script>

</body>
</html>
