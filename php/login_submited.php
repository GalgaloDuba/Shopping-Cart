<?php
require 'connection.php';
session_start();

$email = mysqli_real_escape_string($conn, $_POST['email']);
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";

if (!preg_match($regex_email, $email)) {
    echo "Incorrect email. Redirecting you back to login page...";
    echo '<meta http-equiv="refresh" content="2;url=login.php" />';
    exit();
}

$password = md5(md5(mysqli_real_escape_string($conn, $_POST['password'])));
if (strlen($password) < 6) {
    echo "Password should have at least 6 characters. Redirecting you back to login page...";
    echo '<meta http-equiv="refresh" content="2;url=login.php" />';
    exit();
}

$user_authentication_query = "SELECT id, email FROM users WHERE email='$email' AND password='$password'";
$user_authentication_result = mysqli_query($conn, $user_authentication_query) or die(mysqli_error($conn));
$rows_fetched = mysqli_num_rows($user_authentication_result);

if ($rows_fetched == 0) {
    echo '<script>window.alert("Wrong username or password");</script>';
    echo '<meta http-equiv="refresh" content="1;url=login.php" />';
    exit();
} else {
    $row = mysqli_fetch_array($user_authentication_result);
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $row['id'];

    if (isset($_POST['remember'])) {
        setcookie("user", $email, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie("pass", $_POST['password'], time() + (86400 * 30), "/"); // storing plain password is not recommended, but kept here for consistency
    } else {
        if (isset($_COOKIE["user"])) {
            setcookie("user", "", time() - 3600, "/");
        }
        if (isset($_COOKIE["pass"])) {
            setcookie("pass", "", time() - 3600, "/");
        }
    }

    header('location: products.php');
    exit();
}
