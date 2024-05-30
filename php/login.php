<?php
require 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="../img/lifestyleStore.png" />
    <title>Store</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- latest compiled and minified CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" type="text/css">
    <!-- jquery library -->
    <script type="text/javascript" src="../bootstrap/js/jquery-3.2.1.min.js"></script>
    <!-- Latest compiled and minified javascript -->
    <script type="text/javascript" src="../bootstrap/js/bootstrap.min.js"></script>
    <!-- External CSS -->
    <link rel="stylesheet" href="../css/style.css" type="text/css">
</head>

<body>
    <div>
        <?php
        require 'header.php';
        ?>
        <br><br><br>
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>LOGIN</h3>
                        </div>
                        <div class="panel-body">
                            <p>Login to make a purchase.</p>
                            <form method="post" id="login" action="login_submit.php">
                                <div class="form-group">
                                    <input type="email" class="form-control" value="<?php if (isset($_COOKIE["user"])) {
                                                                                        echo $_COOKIE["user"];
                                                                                    } ?>" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                                </div>
                                <div class="form-group">
                                    <input type="password" value="<?php if (isset($_COOKIE["pass"])) {
                                                                        echo $_COOKIE["pass"];
                                                                    } ?>" class="form-control" name="password" placeholder="Password(min. 6 characters)" pattern=".{6,}">
                                </div>
                                <div class="form-group" style="text-align:left;">
                                    <label><input type="checkbox" name="remember" <?php if (isset($_COOKIE["user"]) && isset($_COOKIE["pass"])) {
                                                                                        echo "checked";
                                                                                    } ?>> Remember me </label>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Login" class="btn btn-primary">
                                </div>
                                <span> <?php
                                        if (isset($_SESSION['message'])) {
                                            echo $_SESSION['message'];
                                        }
                                        unset($_SESSION['message']);
                                        ?></span>
                            </form>
                        </div>
                        <div class="panel-footer">Don't have an account yet? <a href="signup.php">Register</a></div>
                    </div>
                </div>
            </div>
        </div>
        <br><br><br><br><br>
        <footer class="footer">
            <div class="container">
                <center>
                </center>
            </div>
        </footer>
    </div>
</body>

</html>