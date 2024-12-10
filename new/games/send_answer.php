<?php
session_start();

include("../defination.php");

// Load questions from JSON file
$questions = json_decode(file_get_contents('questions.json'), true);

// Check if the quiz has started and initialize session variables
if (!isset($_SESSION['quiz_started'])) {
    $_SESSION['quiz_started'] = true;
    $_SESSION['current_question_index'] = 0;  // Start with the first question
    $_SESSION['answered_questions'] = [];  // Array to track answered questions
    $_SESSION['quiz_start_time'] = time(); // Set the start time for the quiz
}

// Get the current question index
$currentQuestionIndex = $_SESSION['current_question_index'];
$currentQuestion = $questions[$currentQuestionIndex];

// Handle the selected answer
if (isset($_POST['message'])) {
    $selectedAnswer = $_POST['message'];
    $response = [
        'status' => 'false',
        'correct_option' => $currentQuestion['correct_answer'],
        'desc' => $currentQuestion['description']
    ];

    // Check if the answer is correct
    if ($selectedAnswer == $currentQuestion['correct_answer']) {
        $response['status'] = 'true';  // Correct answer
    }

    // Mark the current question as answered by adding it to the answered array
    $_SESSION['answered_questions'][] = $currentQuestionIndex;

    // Check if there are more questions to answer
    if ($_SESSION['current_question_index'] + 1 < count($questions)) {
        // If there are more questions, move to the next question
        $_SESSION['current_question_index']++;
    } else {
        // No more questions, end the quiz
        $response['status'] = 'quiz_end';
        $response['desc'] = 'You have completed the quiz!';
        $_SESSION['current_question_index'] = 0; // Reset to the first question for a new quiz session
        $_SESSION['answered_questions'] = []; // Reset answered questions
    }

    echo json_encode($response);
}

// Function to handle the selected answer and time
function handleAnswer($selectedAnswer) {
    $quizTimeLimit = 30; // Total quiz time in seconds (e.g., 30 seconds)
    $elapsedTime = time() - $_SESSION['quiz_start_time']; // Calculate time elapsed

    // Check if time is up
    if ($elapsedTime >= $quizTimeLimit) {
        return stopQuizTime(); // Time is up, stop the quiz
    }

    $correctAnswer = "A";  // Assuming the correct answer is A (can be dynamic)
    $response = [
        'status' => 'false',
        'correct_option' => $correctAnswer,
        'desc' => 'Option A is correct'
    ];

    if ($selectedAnswer == $correctAnswer) {
        $response['status'] = 'true';
    }

    return $response;
}

// Function to stop the quiz when time is up
function stopQuizTime() {
    $correctAnswer = "A";  // Assuming the correct answer is A

    // Calculate the elapsed time since the quiz started
    $elapsedTime = time() - $_SESSION['quiz_start_time'];
    $timeRemaining = max(0, 30 - $elapsedTime);  // Ensure no negative time remaining

    // Return response when time is up
    return [
        'status' => 'time_up',
        'correct_option' => $correctAnswer,
        'desc' => 'Time is up! Option A was correct.',
        'time_remaining' => $timeRemaining  // Include time remaining
    ];
}
?>
