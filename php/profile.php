<?php
session_start();
error_reporting(0);
include('connection.php');

if (!isset($_SESSION['storeuid'])==0) {
    header("location: logout.php");
    exit; // Exit to prevent further execution
}

if (isset($_POST['submit'])) {
    // Handle form submission here (e.g., update user data)
    // ...
}

$uid = $_SESSION['storeuid'];
$photo = mysqli_query($conn, "SELECT url FROM user_img WHERE user_id = '$uid'");
$img = mysqli_fetch_array($photo);
$photo_url = $img['url'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <?php include("header.php"); ?>
    <div id="photodiv">
        <img id="profileImg" src="./upload/<?php echo $photo_url; ?>" alt="">
    </div>
    <form action="update/update.php" method="post" enctype="multipart/form-data">
        <div id="filediv">
            <input id="fileInput" type="file" class="" name="fileToUpload" id="fileToUpload">
        </div>
        <div id="buttondiv">
            <button id="update" type="submit">Update</button>
        </form>
        <form action="update/remove.php" method="post" enctype="multipart/form-data">
            <button id="remove">Remove</button>
        </form>
    </div>
    <!-- Other HTML content -->
    <script>
        function chooseFile() {
            document.getElementById("fileInput").click();
        }
    </script>
</body>
</html>
