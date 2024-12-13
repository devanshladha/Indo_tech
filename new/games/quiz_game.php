<?php 
session_start();
include("../defination.php");

// Initialize session variables if they do not exist
if (!isset($_SESSION['current_question_index_1'])) $_SESSION['current_question_index_1'] = 0;
if (!isset($_SESSION['current_question_index_2'])) $_SESSION['current_question_index_2'] = 0;
if (!isset($_SESSION['current_question_index_3'])) $_SESSION['current_question_index_3'] = 0;

// Set question set ID from the GET parameter
$question_set_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$_SESSION['qestion_set_id'] = $question_set_id;

// Load corresponding question set
$questions = json_decode(file_get_contents("questions_{$question_set_id}.json"), true);
$currentQuestion = $questions[$_SESSION["current_question_index_{$question_set_id}"]] ?? null;
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
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <title><?php echo($games_quiz_game_title) ?></title>
</head>
<body>
    <div><?php include("../nav.php") ?></div>

    <div id="main">
        <div id="google_translate_element"></div>
        <center>
            <div id="quiz_area" class="center w-100">
                <div id="time_left"></div>
                <div id="question"><p class="no-copy center"><?php echo $currentQuestion['question']; ?></p></div>
                <?php 
                 if($question_set_id == 3){
                    echo "
                        <div id='quiz_img'>
                            <img src=".$currentQuestion['image']." alt='loading...'>
                        </div>
                        ";
                }
                ?>
                <div id="option_div">
                    <?php foreach ($currentQuestion['options'] as $key => $option): ?>
                        <div id="<?php echo $key; ?>" class="option" onclick="sendData('<?php echo $key; ?>')">
                            <div id="order_of_<?php echo $key; ?>" class="order_of_option"><?php echo $key; ?></div>
                            <div id="option_<?php echo $key; ?>" class="option_desc"><?php echo $option; ?></div>
                        </div><br>
                    <?php endforeach; ?>
                </div>
                <div id="answer" class="pt-5 pb-2 hidden">The correct answer is <span id="correct_option" class="bold"></span>.</div>
                <div id="question_desc" class="hidden"><?php echo $currentQuestion['description']; ?></div>
                <button id="next_button" class="hidden" onclick="loadNextQuestion()">Next</button>
            </div>
        </center>
    </div>

    <div id="footer" class="absolute inset-x-0 bottom-0 w-100 h-20"></div>

    <script>
        var timerInterval;
        var timeLeft = 30;
        var timerStopped = false;

        document.addEventListener('contextmenu', event => event.preventDefault());
        document.addEventListener('keydown', event => {
            if (event.ctrlKey && ['c', 'u', 'a'].includes(event.key) || event.key === 'PrintScreen') event.preventDefault();
        });

        timerInterval = setInterval(function() {
            if (timeLeft <= 0 && !timerStopped) {
                clearInterval(timerInterval);
                timerStopped = true;
                disableSubmission();
                sendTimeUpData();
            } else {
                document.getElementById("time_left").innerText = timeLeft;
                timeLeft--;
            }
        }, 1000);

        function disableSubmission() {
            Array.from(document.getElementsByClassName('option')).forEach(option => option.onclick = null);
        }

        function sendData(id) {
            if (timerStopped) return;

            var message = document.getElementById(id).innerHTML;
            clearInterval(timerInterval);
            timerStopped = true;
            disableSubmission();

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "send_answer.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);

                    if (response.status === 'quiz_end') {
                        document.getElementById("answer").innerHTML = response.desc;
                        document.getElementById("answer").classList.remove("hidden");
                        document.getElementById("next_button").classList.add("hidden");
                    } else {
                        var selectedOption = document.getElementById(id);
                        selectedOption.style.borderColor = response.status === "true" ? "lightgreen" : "rgb(190, 100, 75)";
                        document.getElementById(response.correct_option).style.borderColor = "lightgreen";
                        document.getElementById("answer").classList.remove("hidden");
                        document.getElementById("correct_option").innerText = response.correct_option;
                        document.getElementById("question_desc").classList.remove("hidden");
                        document.getElementById("question_desc").innerText = response.desc;
                        document.getElementById("next_button").classList.remove("hidden");
                    }
                }
            };
            xhr.send("message=" + encodeURIComponent(message));
        }

        function sendTimeUpData() {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "send_answer.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById("time_left").innerHTML = "Time is up!";
                    document.getElementById("answer").classList.remove("hidden");
                    document.getElementById("correct_option").innerText = response.correct_option;
                    document.getElementById("answer").innerText = response.desc;
                    document.getElementById("next_button").classList.remove("hidden");
                }
            };

            xhr.send("message=time_up");
        }

        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }

        function loadNextQuestion() {
            window.location.reload();
        }
    </script>
</body>
</html>
