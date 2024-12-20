<?php

session_start();
include("../connection.php");
include("../defination.php");
if (!isset($_SESSION['username'])) {
    echo "
        <script>
            location.replace('../auth/Login3d.php');
            window.location.assign('../auth/Login3d.php')
        </script>
    ";
    header("Location: ../auth/Login3d.php");
}

$username = $_SESSION['username'];


// Fetch the current quiz question
$query = "SELECT reward_points FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$row = $result->fetch_assoc();

$reward_points = $row['reward_points'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Quiz Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
</head>
<body>
    <main>
        <section id="play-now">
            <h2>Play Now</h2>
            <a href="daily_quiz.php"><button>Start Quiz</button></a>
        </section>
        <section id="redeem-points">
            <h2>Reward Points</h2>
            <div id="point">
                <span class="material-symbols-outlined">currency_rupee_circle</span>
                <span id="points-count">&nbsp;&nbsp;&nbsp;<?php echo($reward_points); ?></span>
            </div>
            <p>Collect points by playing daily quizzes and redeem them for exciting rewards!</p>
            <button onclick="redeemPoints()">Redeem Points</button>
        </section>
        <section id="rules">
            <h2>Rules</h2>
            <ul>
                <li>Once you click on the start now button the quiz starts.</li>
                <li>You have <b>30 seconds</b> to answer the question.</li>
                <li>On each correct answer you are awarded <b>5 points.</b></li>
                <li>Onclick back & refresh in your browser the quiz is submitted automatically so don't do this.</li>
                <li>On while found using unfair mean of practices you are banned for 3 month.</li>
            </ul>
        </section>
        <section id="history">
            <h2>Rewards History</h2>
        </section>
    </main>
</body>
</html>
