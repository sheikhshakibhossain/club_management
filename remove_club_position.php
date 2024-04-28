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
        if ($club_check_status == 0) {
            echo "Club Position does not exists !!!";
        } else {

            // get club_position id
            $query = "SELECT id FROM club_position where name = '$club_position'";
            $result = mysqli_query($connect, $query);
            $club_position_id = mysqli_fetch_array($result)[0]; 

            // remove all member with the position
            $query = "DELETE FROM members_info where club_position = '$club_position_id'";
            $result = mysqli_query($connect, $query);

            if ($result) {
                echo "ALL Membership with the Position removed successfully!";
            } else {
                echo "Error: " . mysqli_error($result);
            }
            echo "<br>";

            // // remove the position
            $query = "DELETE FROM club_position where name = '$club_position'";
            $result = mysqli_query($connect, $query);

            if ($result) {
                echo "Club Position removed successfully!";
            } else {
                echo "Error: " . mysqli_error($result);
            }
        }
    }

?>