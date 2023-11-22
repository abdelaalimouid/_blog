<?php
session_start();
include_once("../models/db.php");

if (isset($_POST["register"])) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    if (emailExists($email)) {
        echo "<script>alert('Email already exists. Please choose a different email address.');</script>";
    
        // Set a timeout of 6 seconds before redirecting
        echo "<script>setTimeout(function() { window.location.href = '../views/register.php'; }, 500);</script>";
    
        exit();
    }
    

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $req = addUser($name, $email, $passwordHash);

    if ($req) {
        $_SESSION["user"] = $email;
        header("Location: ../views/home.php");
        exit();
    } else {
        echo "Registration failed. Please try again.";
    }
}


?>
