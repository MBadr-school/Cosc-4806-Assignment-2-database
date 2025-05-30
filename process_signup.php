<?php
session_start();
require_once('user.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    if ($password != $confirm) {
        $_SESSION['signup_error'] = "Passwords do not match.";
        header("Location: /signup.php");
        exit();
    }

    $user = new User();
    $result = $user->create_user($username, $password);

    if ($result === "Account created successfully.") {
        header("Location: /login.php");
        exit();
    } else {
        $_SESSION['signup_error'] = $result;
        header("Location: /signup.php");
        exit();
    }
}
?>
