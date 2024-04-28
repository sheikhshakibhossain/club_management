<?php

    include("session.php");
    if (empty($_SESSION['admin_id'])) {
        header("Location: index.php");
        exit();
    }
    
    require_once('dbconfig.php');
    $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Could not connect to the database");

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['club_session'])) {

        $club_session = $_POST['club_session'];

        $club_check_query = mysqli_query($connect, "SELECT COUNT(*) FROM session WHERE name = '$club_session'") 
            or die("Could not execute query");
        $club_check_status = mysqli_fetch_array($club_check_query)[0]; 

        // echo "$club_check_status";
        if ($club_check_status == 0) {
            echo "The Club Session does not exists !!!";
        } else {

            // get club_session id
            $query = "SELECT id FROM session where name = '$club_session'";
            $result = mysqli_query($connect, $query);
            $club_session_id = mysqli_fetch_array($result)[0]; 

            // remove all member with the position
            $query = "DELETE FROM members_info where sessions = '$club_session_id'";
            $result = mysqli_query($connect, $query);

            if ($result) {
                echo "ALL Membership with the Session removed successfully!";
            } else {
                echo "Error: " . mysqli_error($result);
            }
            echo "<br>";

            // // // remove the position
            $query = "DELETE FROM session where name = '$club_session'";
            $result = mysqli_query($connect, $query);

            if ($result) {
                echo "Club Session removed successfully!";
            } else {
                echo "Error: " . mysqli_error($result);
            }
        }
    }

?>