<?php
$base = "";
include_once("models/db.php");

$request_uri_parts = explode('?', $_SERVER["REQUEST_URI"], 2);
$path = $request_uri_parts[0];

header("Content-type: application/json");

switch ($path) {
    case $base . "/index.php":
    case $base . "/":
        header("Location:" . $base . "/views/home.php");
        break;
    case $base . "/questions":
        $questions = getQuestions();
        $questionsWithUsers = array_map(function ($question) {
            $user = getUserById($question->user_id);
            $question->user = $user;
            return $question;
        }, $questions);
        $response = json_encode(['questions' => $questionsWithUsers]);
        echo $response;
        break;
    case $base . "/responses":
        $questionId = isset($_GET['question_id']) ? $_GET['question_id'] : null;
        if ($questionId !== null) {
            $responses = getResponses($questionId);
            $responsesWithUsers = array_map(function ($response) {
                $user = getUserById($response->user_id);
                $response->user = $user;
                return $response;
            }, $responses);
            echo json_encode(['responses' => $responsesWithUsers]);
        } else {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Missing question ID']);
        }
        break;    
    default:
        echo json_encode(['error' => 'Not found']);
}
?>
