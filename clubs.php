<?php

    include("session.php");
    if (empty($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }

    require_once('dbconfig.php');
    $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");
   
    $results = mysqli_query($connect, "SELECT id, name, room, description FROM `club`")
        or die("Can not execute query");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore the Clubs</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,500" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #E9EAEA;
        }
        #container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
        }
        #container h2 {
            width: 100%;
            text-align: center;
            color: #8B4513;
            font-weight: 500;
            font-size: 28px;
            margin-bottom: 30px;
        }
        .user {
            width: calc(33% - 20px);
            height: 330px;
            background-color: #FFF;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            padding: 20px;
            box-sizing: border-box;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .user:hover {
            transform: translateY(-5px);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }
        .user p {
            margin: 0;
            padding: 0;
        }
        .user .name {
            font-size: 24px;
            font-weight: 500;
            color: #1E90FF;
            margin-bottom: 10px;
        }
        .user .location {
            font-size: 20px;
            font-weight: 300;
            color: #FF8C00;
            margin-bottom: 5px;
        }
        .user .email {
            font-size: 18px;
            font-weight: 300;
            color: #808080;
            margin-bottom: 5px;
        }
        .user .current-work {
            font-size: 16px;
            font-weight: 300;
            color: #696969;
        }
        @media (max-width: 768px) {
            .user {
                width: calc(50% - 20px);
            }
        }
        @media (max-width: 480px) {
            .user {
                width: 100%;
            }
        }
        .user a {
            text-decoration: none;
            color: inherit; /* Optional: inherit the color from parent */
        }

    </style>

    <style>
        body {
            background-color: #9AD0C2; 
        }
    </style>
</head>
<body>

<div id="container">
    <h2>Explore the Clubs</h2>
    <?php
    // Loop through each friend ID and fetch their details
    while ($rows = mysqli_fetch_array($results)) {
        extract($rows);
    
    ?>
        <div class="user">
            <a href="club_page.php?id=<?php echo $rows['id']; ?>">
            <p class="name"><?php echo $rows['name']; ?></p>
            <p class="email"><?php echo $rows['room']; ?></p>
            <p class="location"><?php echo $rows['description']; ?></p>
        </div>

    <?php
    }
    ?>
</div>


</body>
</html>
