<?php

    include("session.php");
    if (empty($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
    
    require_once('dbconfig.php');

    $friend_id = $_SESSION['friend_req_id'];
    $user_id = $_SESSION['user_id'];

    // echo "fd: $friend_id ";
    // echo "us: $user_id ";

    // $recently_visited_club_id = $_SESSION['recently_visited_club_id'];

    $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");
    $query = "INSERT INTO `friend`(`person_id`, `friend_id`) VALUES ('$user_id','$friend_id')";


    $result = mysqli_query($connect, $query);

    if ($result) {
        echo "Friend Added!";
        header("Location: user.php?id=$friend_id"); // redirecting page
        exit(); // no further code is executed after the redirection
    } else {
        echo "Making Friend failed!";

    }
    
?>