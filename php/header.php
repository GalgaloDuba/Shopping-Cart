<?php
// session_start();
// error_reporting(0);
include('./connection.php');
$uid = $_SESSION['storeuid'];
//this is for user name
//   $sql = mysqli_query($conn, "SELECT name FROM users WHERE id = '$uid'");
//   $result = mysqli_fetch_array($sql);
//   $name = $result['name'];
//this is for photo
$photo = mysqli_query($conn, "SELECT url FROM user_img WHERE user_id = '$uid'");
$img = mysqli_fetch_array($photo);
$photo_url = $img['url'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/header.css">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="../index.php" class="navbar-brand">Store</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['email'])) : ?>
                        <li class="inline"><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                        <li class="inline bsg">
                            <img id="user_image" src="./upload/<?php echo $photo_url ?>" alt="">
                        </li>
                        <li class="dropdown">
                            <button class="dropbtn" style="font-weight:bold;">
                                <?php echo 'HELLO' ?>
                                <i class="fa fa-caret-down"></i>
                            </button>
                            <div class="dropdown-content">
                                <a href="#"></a>
                                <a href="../php/profile.php">Update profile</a>
                                <a href="../php/settings.php">Settings</a>
                                <a href="../php/logout.php">Logout</a>
                            </div>
                        </li>
                    <?php else : ?>
                        <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <script src="../bootstrap/js/jquery-3.2.1.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>