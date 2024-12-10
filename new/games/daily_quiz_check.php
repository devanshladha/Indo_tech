<?php
session_start();
include("../defination.php");
include("../connection.php");

// Check if the user is logged in to prevent unauthorized access
if (!isset($_SESSION['username'])) {
    header('Location: ../auth/Login3d.php');  // Redirect to login if not logged in
    exit();
}

// Check if 30 seconds have passed since the start of the quiz
if (time() - $_SESSION['quiz_start_time'] >= 30) {
    echo "
        <script>
            alert('Your time is up!');
            location.replace('daily_quiz.php');
        </script>
    ";
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
            location.replace('reward.php');
        </script>
    ";
    exit();
}

// Get the user's selected option
$selected_option = $_POST['option'];

// Validate the selected option
if (!in_array($selected_option, ['A', 'B', 'C', 'D'])) {
    echo "
        <script>
            alert('Invalid selection!');
            location.replace('games.php');
        </script>
    ";
    exit();
}

// Fetch the current quiz question
$query = "SELECT * FROM quiz WHERE status = 0 LIMIT 1";
$result = mysqli_query($conn, $query);
$row = $result->fetch_assoc();

$correct_option = $row['correct_option'];
$is_correct = ($selected_option == $correct_option) ? 1 : 0;

// Mark the question as answered for the user
$update_status_stmt = $conn->prepare("UPDATE `users` SET quiz_answered = 1 WHERE username = ?");
$update_status_stmt->bind_param("s", $username);
$update_status_stmt->execute();

// Update points if the answer is correct
if ($is_correct) {
	// Prepare the query 
	$points_query = $conn->prepare("UPDATE `users` SET reward_points = reward_points + 5 WHERE username = ?"); 
	$points_query->bind_param("s", $username); // Execute the query 
	
}

echo "
    <script>
        alert('Quiz submitted successfully!');
        location.replace('reward.php');
    </script>
";
?>
