<?php
session_start();
include_once("../models/db.php");

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $user = getUser($email);

    if ($user && password_verify($password, $user->password)) {
        $_SESSION["user"] = $user->email;
        header("Location: ../views/home.php");
        exit(); 
    } else {
        echo "<script>alert('Login failed. Please check your email and password.');</script>";
    
        // Set a timeout of 6 seconds before redirecting
        echo "<script>setTimeout(function() { window.location.href = '../views/login.php'; }, 500);</script>";
    
    }
} else {
    echo "<script>alert('Invalid request. Please provide email and password.');</script>";
    
        // Set a timeout of 6 seconds before redirecting
        echo "<script>setTimeout(function() { window.location.href = '../views/login.php'; }, 500);</script>";
    
}
?>