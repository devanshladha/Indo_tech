<?php
session_start();
include("../defination.php");
include("../connection.php");

// Check if the user is logged in to prevent unauthorized access
if (!isset($_SESSION['username'])) {
    header('Location: ../auth/Login3d.php');  // Redirect to login if not logged in
    exit();
}

$username = $_SESSION['username'];

// Check if the user has already answered the quiz
$query1 = "SELECT quiz_answered FROM users WHERE username = '$username'";
$result1 = mysqli_query($conn, $query1);
$row1 = $result1->fetch_assoc();

if ($row1['quiz_answered'] == 1) {
    echo "
        <script>
            alert('You have already attempted the quiz!');
            location.replace('reward.php');
        </script>
    ";
    exit();
}

// Get the current quiz question
$query = "SELECT * FROM quiz WHERE status = 0 LIMIT 1";
$result = mysqli_query($conn, $query);
$row = $result->fetch_assoc();

if ($row == null) {
    echo "
        <script>
            alert('No active quiz question found.');
            location.replace('reward.php');
        </script>
    ";
    exit();
}

$id = $row['id'];
$question = $row['question_text'];
$option_a = $row['option_a'];
$option_b = $row['option_b'];
$option_c = $row['option_c'];
$option_d = $row['option_d'];

// Mark the question as answered for the user
$update_status_stmt = $conn->prepare("UPDATE `users` SET quiz_answered = 1 WHERE username = ?");
$update_status_stmt->bind_param("s", $username);
$update_status_stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_game.css">
    <link rel="stylesheet" href="../utility.css">
    <?php echo $quiz_font ?>
    <title>Daily Quiz</title>
</head>
<body>
    <div>
        <?php include("../nav.php"); ?>
    </div>

    <div id="main">
        <center>
        <div id="quiz_area" class="center w-100">
            <form method="post" action="daily_quiz_check.php">
                <div id="time_left"></div>
                <div id="question">
                    <p class="no-copy center"><?php $_SESSION['quiz_start_time'] = time(); echo $question; ?></p>
                </div>
                <div id="option_div">
                    <input type="radio" name="option" id="option1" value="A" hidden>
                    <label id="A" for="option1" class="option" onclick="color('A')">
                        <div id="order_of_A" class="order_of_option">A</div>
                        <div id="option_A" class="option_desc"><?php echo $option_a; ?></div>
                    </label>
                    <br>
                    <input type="radio" name="option" id="option2" value="B" hidden>
                    <label id="B" for="option2" class="option" onclick="color('B')">
                        <div id="order_of_B" class="order_of_option">B</div>
                        <div id="option_B" class="option_desc"><?php echo $option_b; ?></div>
                    </label>
                    <br>
                    <input type="radio" name="option" id="option3" value="C" hidden>
                    <label id="C" for="option3" class="option" onclick="color('C')">
                        <div id="order_of_C" class="order_of_option">C</div>
                        <div id="option_C" class="option_desc"><?php echo $option_c; ?></div>
                    </label>
                    <br>
                    <input type="radio" name="option" id="option4" value="D" hidden>
                    <label id="D" for="option4" class="option" onclick="color('D')">
                        <div id="order_of_D" class="order_of_option">D</div>
                        <div id="option_D" class="option_desc"><?php echo $option_d; ?></div>
                    </label>
                    <br>
                    <button type="submit" id="submit">Next</button>
                </div>
            </form>
        </div>
        </center>
    </div>
    <script type="text/javascript">
        // Timer function to count down from 30 seconds 
        document.addEventListener("DOMContentLoaded", function() { 
            const timeLeft = document.getElementById("time_left"); 
            let time = 30; // 30 seconds timer 
            const timerInterval = setInterval(function() { 
                if (time <= 0) { 
                    clearInterval(timerInterval); 
                    document.getElementById("submit").disabled = false; // Enable submit button 
                } else{ 
                    time--; 
                    timeLeft.textContent = time; 
                } 
            }, 1000); 
        });
        function color(id) {
            const options = document.getElementsByClassName("option");
            for (let i = 0; i < options.length; i++) {
                options[i].style.borderColor = "gainsboro";
            }
            document.getElementById(id).style.borderColor = "pink";
        }
    </script>
</body>
</html>
