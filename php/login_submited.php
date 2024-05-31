<?php
require 'connection.php';
session_start();
$email = mysqli_real_escape_string($conn, $_POST['email']);
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[_a-z0-9-]+)*(\.[a-z]{2,3})$/";
if (!preg_match($regex_email, $email)) {
    echo "Incorrect email. Redirecting you back to login page...";
?>
    <meta http-equiv="refresh" content="2;url=login.php" />
<?php
}
$password = md5(md5(mysqli_real_escape_string($conn, $_POST['password'])));
if (strlen($password) < 6) {
    echo "Password should have atleast 6 characters. Redirecting you back to login page...";
?>
    <meta http-equiv="refresh" content="2;url=login.php" />
<?php
}
$user_authentication_query = "select id,email from users where email='$email' and password='$password'";
$user_authentication_result = mysqli_query($conn, $user_authentication_query) or die(mysqli_error($conn));
$rows_fetched = mysqli_num_rows($user_authentication_result);
if ($rows_fetched == 0) {
    //no user
    //redirecting to same login page
?>
    <script>
        window.alert("Wrong username or password");
    </script>
    <meta http-equiv="refresh" content="1;url=login.php" />
<?php
    //header('location: login');
    //echo "Wrong email or password.";
} else {
    $row = mysqli_fetch_array($user_authentication_result);
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $row['id'];  //user id
    header('location: products.php');
}
// // Cookies
// if (isset($_POST['login'])) {

//     session_start();
//     include('connection.php');

//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     $query = mysqli_query($conn, "select * from users where user_name='$username' && user_password='$password'");

//     if (mysqli_num_rows($query) == 0) {
//         $_SESSION['message'] = "Login Failed. User not Found!";
//         header('location:login.php');
//     } else {
//         $row = mysqli_fetch_array($query);
//         if (isset($_POST['remember'])) {
//             //set up cookie
//             setcookie("user", $row['user_name'], time() + (86400 * 30));
//             setcookie("pass", $row['user_password'], time() + (86400 * 30));
//         }

//         $_SESSION['id'] = $row['user_id'];
//         header('location:success.php');
//     }
// } else {
//     header('location:login.php');
//     $_SESSION['message'] = "Please Login!";
// }
// 
?>