<?php
session_start();
require_once('user.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $user = new User();
    if ($user->login($username, $password)) {
        $_SESSION['username'] = $username;
        header("Location: /dashboard.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Invalid username or password.";
        header("Location: /login.php");
        exit();
    }
}
?>
