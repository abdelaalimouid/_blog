<?php
session_start();
include_once("../models/db.php");
if (isset($_POST["addQuestion"])) {
    $questionText = $_POST["questionText"];
    $userId = getUserIdByEmail($_SESSION["user"]);
    addQuestion($userId, $questionText);
}
$user = $_SESSION["id"];
$questions = getQuestions();

if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: home.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <h1><?php echo "$user" ?></h1>
            <div class="col-md-8">
                <?php
                if (isset($_SESSION["user"])) { ?>
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="nav-link" href="?logout=true">Logout</a>
                    </nav>
                <?php } else { ?>
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <a class="nav-link" href="login.php">Login</a>
                    </nav>
                <?php } ?>
                <br>
                <h2 class="mb-4">Questions</h2>
                <?php if (isset($_SESSION["user"])) { ?>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="questionText" class="form-label">Ask a new question:</label>
                            <input type="text" class="form-control" name="questionText" id="questionText" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="addQuestion">Submit Question</button>
                    </form>
                <?php
                }
                ?>

                <ul id="questionsList" class="list-group mt-4"></ul>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../public/questions.js"></script>
    <script src="../public/responses.js"></script>
</body>

</html>