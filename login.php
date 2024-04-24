<?php

    include ("session.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        require_once('dbconfig.php');
        $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");

        $query = "SELECT COUNT(*) FROM person WHERE id = '$username' AND passwd = '$password'";
        $result = mysqli_query($connect, $query);

        $count = mysqli_fetch_array($result)[0];

        if ($count >= 1) {
            $_SESSION['user_id'] = $username;
            echo "Login Success!";
            header("Location: profile.php"); // redirecting page
            exit(); // no further code is executed after the redirection
        } else {
            echo "Login failed!";
            echo "<p><a href='index.html'>Return home</a></p>";
        }
    }
?>
