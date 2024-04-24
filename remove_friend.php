<?php

    include("session.php");
    if (empty($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
    require_once('dbconfig.php');

    $friend_id = $_SESSION['friend_req_id'];
    $user_id = $_SESSION['user_id'];

    $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");
    $query = "DELETE FROM `friend` WHERE person_id = $user_id AND friend_id = $friend_id";


    $result = mysqli_query($connect, $query);

    if ($result) {
        echo "Friend Removed!";
        header("Location: user.php?id=$friend_id"); // redirecting page
        exit(); // no further code is executed after the redirection
    } else {
        echo "Removing Friend failed!";

    }
    
?>