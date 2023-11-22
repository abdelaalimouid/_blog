<?php
$host = 'localhost';
$dbname = 'forum';
$user = 'root';
$password = '';
function connect()
{
    global $host, $dbname, $user, $password;
    try {
        $db = new PDO("mysql:host=$host", $user, $password);

        $checkdb = $db->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$dbname'");

        if ($checkdb->rowCount() == 0) {
            $db->exec("CREATE DATABASE $dbname");
        }

        $db->exec("USE $dbname");

        $tableName = 'Users';
        $checkUsers = $db->query("SHOW TABLES LIKE '$tableName'");
        if ($checkUsers->rowCount() == 0) {
            $query = "
                    CREATE TABLE $tableName (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        nom VARCHAR(255) NOT NULL,
                        email VARCHAR(255) NOT NULL,
                        password VARCHAR(255) NOT NULL
                    );
                ";
            $db->exec($query);
        }

        $tableName = 'Questions';
        $checkProducts = $db->query("SHOW TABLES LIKE '$tableName'");
        if ($checkProducts->rowCount() == 0) {
            $query = "
                    CREATE TABLE $tableName (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT,
                    question TEXT NOT NULL,
                    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (user_id) REFERENCES Users(id)
                );
                ";

            $db->exec($query);
        }

        $tableName = 'Questions';
        $checkProducts = $db->query("SHOW TABLES LIKE '$tableName'");
        if ($checkProducts->rowCount() == 0) {
            $query = "
                    CREATE TABLE $tableName (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT,
                    question_id INT,
                    response TEXT NOT NULL,
                    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (user_id) REFERENCES Users(id),
                    FOREIGN KEY (question_id) REFERENCES Questions(id)
                );
                ";

            $db->exec($query);
        }

        return $db;
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }
}

$db = connect();


function addUser($name, $email, $password)
{
    global $db;
    $query = $db->prepare("INSERT INTO Users (nom, email, password) VALUES (:n, :e, :p)");
    $success = $query->execute(["n" => $name, "e" => $email, "p" => $password]);

    if ($success) {
        return true;
    } else {
        return $query->errorInfo();
    }
}

function getUser($email)
{
    global $db;
    $query = $db->prepare("SELECT * FROM Users WHERE email=:email");
    $query->execute(["email" => $email]);
    $user = $query->fetch(PDO::FETCH_OBJ);
    return $user;
}

function emailExists($email)
{
    global $db;
    $query = $db->prepare("SELECT COUNT(*) FROM Users WHERE email=:email");
    $query->execute(["email" => $email]);
    $count = $query->fetchColumn();
    return $count > 0;
}

function getQuestions()
{
    global $db;
    $query = $db->query("SELECT * FROM Questions ORDER BY date DESC");
    $questions = $query->fetchAll(PDO::FETCH_OBJ);
    return $questions;
}

function getReponses($question_id)
{
    global $db;
    $query = $db->prepare("SELECT * FROM Reponses WHERE question_id = :question_id ORDER BY date DESC");
    $query->execute(["question_id" => $question_id]);
    $reponses = $query->fetchAll(PDO::FETCH_OBJ);
    return $reponses;
}


function addQuestion($user_id, $questionText)
{
    global $db;
    $query = $db->prepare("INSERT INTO Questions (user_id, question) VALUES (:user_id, :questionText)");
    $success = $query->execute(["user_id" => $user_id, "questionText" => $questionText]);

    if ($success) {
        return true;
    } else {
        return $query->errorInfo();
    }
}


function addResponse($user_id, $question_id, $responseText)
{
    global $db;
    $query = $db->prepare("INSERT INTO Reponses (user_id, question_id, response) VALUES (:user_id, :question_id, :responseText)");
    $success = $query->execute(["user_id" => $user_id, "question_id" => $question_id, "responseText" => $responseText]);

    if ($success) {
        return true;
    } else {
        return $query->errorInfo();
    }
}

function getUserIdByEmail($email)
{
    global $db;
    $query = $db->prepare("SELECT id FROM Users WHERE email = :email");
    $query->execute(["email" => $email]);
    $result = $query->fetch(PDO::FETCH_OBJ);

    if ($result) {
        return $result->id;
    } else {
        return null;
    }
}

function getUserById($userId)
{
    global $db;
    $query = $db->prepare("SELECT * FROM Users WHERE id = :userId");
    $query->execute(["userId" => $userId]);
    $user = $query->fetch(PDO::FETCH_OBJ);

    return $user;
}


function getResponses($question_id)
{
    global $db;
    $query = $db->prepare("SELECT * FROM Reponses WHERE question_id = :question_id ORDER BY date DESC");
    $query->execute(["question_id" => $question_id]);
    $responses = $query->fetchAll(PDO::FETCH_OBJ);
    return $responses;
}

function getQuestionById($question_id)
{
    global $db;
    $query = $db->prepare("SELECT * FROM Questions WHERE id = :question_id");
    $query->execute(["question_id" => $question_id]);
    $question = $query->fetch(PDO::FETCH_OBJ);

    return $question;
}
