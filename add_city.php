<?php

    include("session.php");
    if (empty($_SESSION['admin_id'])) {
        header("Location: index.php");
        exit();
    }
    
    require_once('dbconfig.php');
    $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Could not connect to the database");


    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['city_name'])) {

        $city_name = $_POST['city_name'];

        $city_check_query = mysqli_query($connect, "SELECT COUNT(*) FROM city WHERE name = '$city_name'") 
            or die("Could not execute query");
        $city_check_status = mysqli_fetch_array($city_check_query)[0]; 


        if ($city_check_status > 0) {
            echo "City already exists !!!";
        } else if(isset($_POST['city_name'])) {
            
            $query = "INSERT INTO city (name) VALUES ('$city_name')";
            $result = mysqli_query($connect, $query);
            if ($result) {
                echo "City added successfully!";
            } else {
                echo "Error: " . mysqli_error($connect);
            }
            
        } else {
            echo "All fields are required!";
        }

    }

?>