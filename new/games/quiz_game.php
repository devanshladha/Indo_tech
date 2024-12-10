<?php
session_start();
include("../defination.php");

// Load questions from JSON file
$questions = json_decode(file_get_contents('questions.json'), true);

// Store the current question index in session (to track progress)
if (!isset($_SESSION['current_question_index'])) {
    $_SESSION['current_question_index'] = 0;  // Start with the first question
}

// Get current question from JSON
$currentQuestion = $questions[$_SESSION['current_question_index']];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo $quiz_font ?>
    <link rel="stylesheet" href="style_game.css">
    <link rel="stylesheet" href="../utility.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?php echo($games_quiz_game_title) ?></title>
</head>
<body>
    <div>
        <?php include("../nav.php") ?>
    </div>

    <div id="main">
        <center>
        <div id="quiz_area" class="center w-100">
            <div id="time_left">
                
            </div>
            <div id="question">
                <span>
                    <p class="no-copy center"><?php echo $currentQuestion['question']; ?></p>
                </span>
            </div>
            <div id="option_div">
                <?php foreach ($currentQuestion['options'] as $key => $option): ?>
                    <div id="<?php echo $key; ?>" class="option" onclick="sendData('<?php echo $key; ?>')">
                        <div id="order_of_<?php echo $key; ?>" class="order_of_option"><?php echo $key; ?></div>
                        <div id="option_<?php echo $key; ?>" class="option_desc"><?php echo $option; ?></div>
                    </div>
                    <br>
                <?php endforeach; ?>
            </div>
            <div id="answer" class="pt-5 pb-2 hidden">The correct answer is <span id="correct_option" class="bold"></span>.</div>
            <div id="question_desc" class="hidden"><?php echo $currentQuestion['description']; ?></div>
        </div>
        </center>
    </div>

    <div id="footer" class="absolute inset-x-0 bottom-0 w-100 h-20">
    </div>

    <script>
        var timerInterval;
        var timeLeft = 30;  // Timer starts at 30 seconds
        var timerStopped = false;  // To track if the timer has already been stopped

        document.addEventListener('contextmenu', event => event.preventDefault());
        document.addEventListener('keydown', event => {
            if (event.ctrlKey && (event.key === 'c' || event.key === 'u' || event.key === 'a') || event.key === 'PrintScreen') {
                event.preventDefault();
            }
        });

        // Start the timer when the page loads
        timerInterval = setInterval(function() {
            if (timeLeft <= 0 && !timerStopped) {
                clearInterval(timerInterval);  // Stop the timer
                timerStopped = true;
                disableSubmission();  // Disable further option clicks
                sendTimeUpData();  // Send data to the backend to stop the quiz
            } else {
                document.getElementById("time_left").innerText = timeLeft;
                timeLeft--;
            }
        }, 1000);

        // Disable further option submissions
        function disableSubmission() {
            var options = document.getElementsByClassName('option');
            for (var i = 0; i < options.length; i++) {
                options[i].onclick = null;
            }
        }
// Send data when an option is selected
function sendData(id) {
    if (timerStopped) return; // Prevent submissions after timer is stopped

    var message = document.getElementById(id).innerHTML;

    // Stop the timer immediately
    clearInterval(timerInterval);
    timerStopped = true;
    disableSubmission(); // Disable further submissions

    // Send data to the backend
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "send_answer.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText); // Parse the server response

            // If the quiz is finished, display the quiz end message
            if (response.status == 'quiz_end') {
                document.getElementById("answer").innerHTML = response.desc;
                document.getElementById("answer").classList.remove("hidden");
                // Optionally, disable further interactions or hide the question area
                document.getElementById("quiz_area").innerHTML = '';
            } else {
                // Provide visual feedback for the selected answer
                var selectedOption = document.getElementById(id);
                if (response.status == "true") {
                    selectedOption.style.borderColor = "lightgreen";  // Correct answer
                } else {
                    selectedOption.style.borderColor = "rgb(190, 100, 75)";  // Incorrect answer
                }

                // Highlight the correct option
                document.getElementById(response.correct_option).style.borderColor = "lightgreen";
                document.getElementById("answer").classList.remove("hidden");
                document.getElementById("correct_option").innerText = response.correct_option;
                document.getElementById("question_desc").classList.remove("hidden");
                document.getElementById("question_desc").innerText = response.desc;

                // Load the next question after a short delay
                setTimeout(function() {
                    window.location.reload();  // Reload page for next question
                }, 3000); // Adjust time as needed
            }
        }
    };
    xhr.send("message=" + encodeURIComponent(message));
}
        // Send data when time is up
        function sendTimeUpData() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "send_answer.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    console.log("Server response when time's up:", response);

                    // Display time is up message
                    document.getElementById("answer").innerHTML = `Time is up! Option A was correct.`;
                    document.getElementById("correct_option").innerText = response.correct_option;
                    document.getElementById("question_desc").innerText = response.desc;
                }
            };

            xhr.send("message=time_up");
        }
    </script>

</body>
</html>
