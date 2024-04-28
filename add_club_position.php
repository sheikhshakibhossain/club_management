<?php

    include("session.php");
    if (empty($_SESSION['admin_id'])) {
        header("Location: index.php");
        exit();
    }
    
    require_once('dbconfig.php');
    $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Could not connect to the database");

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['club_position'])) {

        $club_position = $_POST['club_position'];

        $club_check_query = mysqli_query($connect, "SELECT COUNT(*) FROM club_position WHERE name = '$club_position'") 
            or die("Could not execute query");
        $club_check_status = mysqli_fetch_array($club_check_query)[0]; 

        // echo "$club_check_status";
        if ($club_check_status > 0) {
            echo "Club Position already exists !!!";
        } else {
    
            $query = "INSERT INTO club_position (name) VALUES ('$club_position')";
            $result = mysqli_query($connect, $query);
            if ($result) {
                echo "Club Position added successfully!";
            } else {
                echo "Error: " . mysqli_error($connect);
            }
        }
    }

?>