<?php
session_start();
include_once("../models/db.php");
if (isset($_GET["id"])) {
    $questionId = $_GET["id"];
    $question = getQuestionById($questionId);
    $user = getUserById($question->user_id);
    $responses = getResponses($questionId);

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["addResponse"])) {
        $responseText = $_POST["responseText"];
        $userId = getUserIdByEmail($_SESSION["user"]);
        addResponse($userId, $questionId, $responseText);
        $responses = getResponses($questionId);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question - <?= $question->question ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2 class="mb-4">Question: <?= $question->question ?></h2>
                <p>Date: <?= (new DateTime($question->date))->format('F j, Y, g:i a') ?></p>
                <p>User: <?= $user->nom ?></p>
                <?php if (isset($_SESSION["user"])) { ?>
                    <h4>Add a Response</h4>
                    <form method="post">
                        <input type="hidden" name="addResponse" value="1">
                        <input type="hidden" name="questionId" value="<?= $questionId ?>">
                        <div class="mb-3">
                            <label for="responseText" class="form-label">Your Response:</label>
                            <input type="text" class="form-control" name="responseText" id="responseText" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="addResponse">Submit Response</button>
                    </form><br>
                    <?php } ?>
                    <a href="home.php" class="btn btn-primary" name="addResponse">Back</a>
                    <br>
                <h3>Responses</h3>

                <ul id="responsesList" class="list-group mt-4">

                </ul>

                <?php if (isset($_SESSION["user"])) :
                ?>

                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../public/response.js"></script>
    <script>
        var questionId = <?= $questionId ?>;
    </script>
</body>

</html>