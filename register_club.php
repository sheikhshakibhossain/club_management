<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $person_id = $_POST["person_id"];
        $club = $_POST["club"];
        $club_position = $_POST["club_position"];
        $sessions = $_POST["sessions"];
    

        require_once('dbconfig.php');
        $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");

        $query = "INSERT INTO members_info (person_id, sessions, club, club_position) VALUES ('$person_id', '$sessions', '$club', '$club_position')";


        $result = mysqli_query($connect, $query);

        if ($result) {
            echo "Welcome to the club!";
            header("Location: profile.php"); // redirecting page
            exit(); // no further code is executed after the redirection
        } else {
            echo "Club join failed!";

        }
    }
?>
