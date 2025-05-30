<?php

require_once('user.php');

$user = new User();

//test creat users
$result = $user->create_user("TestUser", "Password12345");
echo $result . "<br>";

//test login
$login = $user->login("TestUser", "Password12345");
if ($login) {
    echo "Login successful.";
} else {
    echo "Invalid login.";
}

//display all users
echo "<pre>";
print_r($user->get_all_users());

?>
