<?php
session_start();
include("../defination.php");

// Determine the question set based on session
$question_set_id = $_SESSION['qestion_set_id'] ?? 1;
$questions = json_decode(file_get_contents("questions_{$question_set_id}.json"), true);
$currentQuestionIndex = $_SESSION["current_question_index_{$question_set_id}"] ?? 0;

// Get the current question
$currentQuestion = $questions[$currentQuestionIndex];

// Initialize quiz session if not started
if (!isset($_SESSION['quiz_started'])) {
    $_SESSION['quiz_started'] = true;
    $_SESSION['answered_questions'] = [];
    $_SESSION['quiz_start_time'] = time();
}

// Handle the selected answer or time up event
if (isset($_POST['message'])) {
    $selectedAnswer = $_POST['message'];
    $response = [
        'status' => $selectedAnswer === $currentQuestion['correct_answer'] ? 'true' : 'false',
        'correct_option' => $currentQuestion['correct_answer'],
        'desc' => $currentQuestion['description']
    ];

    $_SESSION['answered_questions'][] = $currentQuestionIndex;

    // Move to the next question or end the quiz
    if ($currentQuestionIndex + 1 < count($questions)) {
        $_SESSION["current_question_index_{$question_set_id}"]++;
    } else {
        $response['status'] = 'quiz_end';
        $response['desc'] = 'You have completed the quiz!';
        $_SESSION["current_question_index_{$question_set_id}"] = 0;
        $_SESSION['answered_questions'] = [];
    }

    echo json_encode($response);
}
?>
