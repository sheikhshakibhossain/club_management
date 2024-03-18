<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $current_work = $_POST["current_work"];
        $dob = $_POST["dob"];
        $city = $_POST["city"];
        $country = $_POST["country"];
        $batch = $_POST["batch"];
        $password = $_POST["password"];


        require_once('dbconfig.php');
        $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");

        $query = "INSERT INTO `person` (id, name, email, phone, current_work, dob, city, country, batch, passwd) VALUES ('$id', '$name', '$email', '$phone', '$current_work', '$dob', '$city', '$country', '$batch', '$password')";


        $result = mysqli_query($connect, $query);

        if ($result) {
            echo "Registration successful!";
        } else {
            echo "Registration failed!";

        }
    }
?>
