<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        require_once('dbconfig.php');
        $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");

        $query = "SELECT COUNT(*) FROM club_admin WHERE person_id = '$username' AND password = '$password'";
        $result = mysqli_query($connect, $query);

        $count = mysqli_fetch_array($result)[0];

        if ($count >= 1) {
            include("session.php");
            $_SESSION['admin_id'] = $username;
            echo "Login Success!";
            header("Location: admin.php"); // redirecting page
            exit(); // no further code is executed after the redirection
        } else {
            echo "Login failed!";
            echo "<p><a href='index.php'>Return home</a></p>";
        }
    }
?>
