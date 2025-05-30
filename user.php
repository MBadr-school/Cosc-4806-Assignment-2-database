<?php

require_once('database.php');

class User {

    public function get_all_users() {
        $db = db_connect();
        $statement = $db->prepare("SELECT * FROM users;");
        $statement->execute();
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    public function user_exists($username) {
        $db = db_connect();
        $statement = $db->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $statement->execute([$username]);
        $count = $statement->fetchColumn();
        return $count > 0;
    }

    public function create_user($username, $password) {
        if (strlen($password) < 10) {
            return "Password must be at least 10 characters long.";
        }

        if ($this->user_exists($username)) {
            return "Username already exists.";
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $db = db_connect();
        $statement = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $statement->execute([$username, $hashed_password]);

        return "Account created successfully.";
    }

    public function login($username, $password) {
        $db = db_connect();
        $statement = $db->prepare("SELECT password FROM users WHERE username = ?");
        $statement->execute([$username]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return false;
        }

        $hashed_password = $row['password'];
        return password_verify($password, $hashed_password);
    }
}
?>
