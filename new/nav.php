<?php
error_reporting(0);
session_start();
include("connection.php");

$loggedIn = false;
$joinedCommunity = false;
$community = "0";
if (isset($_SESSION['username'])) {
    $loggedIn = true;
    $username = $_SESSION['username'];
    
    // Fetch user data from the database
    $stmt = $conn->prepare("SELECT profile_image, community FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $profileImage = $row['profile_image'];
        $community = $row['community'];
    }
}
?>
    <div id="nav">
        <div id="left_nav" class="">
            <a href="http://localhost/projects/createX%2024/new/index.php"><h2>CulturaConnect</h2></a>
        </div>
        <div id="right_nav" class="">
            <span><a href="http://localhost/projects/createX%2024/new/games/games.php">Games</a></span>
            <span><a href="http://localhost/projects/createX%2024/new/explore/explore.php">Explore</a></span>
            <span><a href="http://localhost/projects/createX%2024/new/artefacts/artefacts.php">Artefacts</a></span>
            <span><a href="https://cultura-connect.blogspot.com">Blog</a></span>
            <?php if ($community == 0): ?>
                <span><a href="http://localhost/projects/createX%2024/new/auth/register.php">Join</a></span>
            <?php endif; ?>
            <?php if ($loggedIn): 
                echo "<span><a href='http://localhost/projects/createX%2024/new/auth/profile.php'>
                        <div id='profile_div'>
                            <img src=". $profileImage . " class='profile-pic'>
                        </div>
                      </a></span>";
            ?>
            <?php else: ?>
                <span><a href="http://localhost/projects/createX%2024/new/auth/Login3d.php">login</a></span>
            <?php endif; ?>
        </div>
    </div>
