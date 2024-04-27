<?php

    include("session.php");
    if (empty($_SESSION['admin_id'])) {
        header("Location: index.php");
        exit();
    }
    
    require_once('dbconfig.php');
    $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Could not connect to the database");


    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['club_name'])) {

        $club_name = $_POST['club_name'];

        $club_check_query = mysqli_query($connect, "SELECT COUNT(*) FROM club WHERE name = '$club_name'") 
            or die("Could not execute query");
        $club_check_status = mysqli_fetch_array($club_check_query)[0]; 


        if ($club_check_status > 0) {
            echo "Club already exists !!!";
        } else if(isset($_POST['club_name']) && isset($_POST['club_room']) && isset($_POST['description'])) {
            $club_name = $_POST['club_name'];
            $club_room = $_POST['club_room'];
            $description = $_POST['description'];
            
            $query = "INSERT INTO club (name, room, description) VALUES ('$club_name', '$club_room', '$description')";
            $result = mysqli_query($connect, $query);
            if ($result) {
                echo "Club added successfully!";
            } else {
                echo "Error: " . mysqli_error($connect);
            }
            
        } else {
            echo "All fields are required!";
        }

    }

?>