<?php

    include("session.php");
    if (empty($_SESSION['user_id'])) {
        header("Location: index.php");
        exit();
    }
    require_once('dbconfig.php');

    $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");
    
    $id = $_SESSION['user_id'];

    // people of same club
    // SELECT person_id FROM members_info WHERE members_info.club = (SELECT club FROM members_info WHERE person_id = '011221031')
    $results = mysqli_query($connect, "SELECT person_id FROM members_info WHERE members_info.club = (SELECT club FROM members_info WHERE person_id = '$id')")
        or die("Can not execute query");
    
    $friends = [];
    while ($rows = mysqli_fetch_array($results)) {
        extract($rows);
        $friends[] = $person_id;
    }


    $following_query = mysqli_query($connect, "SELECT friend_id from friend WHERE person_id = '$id'")
        or die("Can not execute query");
    
    $following = [];
    while ($rows = mysqli_fetch_array($following_query)) {
        extract($rows);
        $following[] = $friend_id;
    }

    $followers_query = mysqli_query($connect, "SELECT person_id from friend WHERE friend_id = '$id'")
    or die("Can not execute query");

    $followers = [];
    while ($rows = mysqli_fetch_array($followers_query)) {
        extract($rows);
        $followers[] = $person_id;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Friends in the Club</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,500" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        body {
            background-color: lightblue; 
        }
    </style>
</head>

<body>


<div id="container">
    <h2>Followings</h2>
    <?php
    // Loop through each friend ID and fetch their details
    foreach ($following as $friend_id) {
        // Execute SQL query to fetch name, phone, email, and current work of the friend
        $friend_query = mysqli_query($connect, "SELECT name, phone, email, current_work FROM person WHERE id = '$friend_id'");
        $friend_data = mysqli_fetch_assoc($friend_query);

        // SELECT club_position.name FROM club_position WHERE club_position.id = (SELECT members_info.club_position FROM members_info WHERE members_info.person_id = '011221031')
        $club_position_query = mysqli_query($connect, "SELECT club_position.name FROM club_position WHERE club_position.id = (SELECT members_info.club_position FROM members_info WHERE members_info.person_id = '$friend_id')");
        $club_position_data = mysqli_fetch_assoc($club_position_query);
    ?>
    <a href="user.php?id=<?php echo $friend_id; ?>" class="user">
        <?php 
            $profile_picture = 'uploads/' . $friend_id . '.jpg';
            if (!file_exists($profile_picture)) {
                $num = $friend_id % 6;
                $profile_picture = 'assets/avatar/' . $num . '.png';
            }
        ?>
        <img class="rounded-circle mt-3" width="150px" src="<?php echo $profile_picture; ?>">
        <p class="name"><?php echo $friend_data['name']; ?></p>
        <p class="address"><?php echo $friend_data['current_work']; ?></p>
        <p class="location"><?php echo $club_position_data['name']; ?></p>
    </a>
    <?php
    }
    ?>
</div>


<div id="container">
    <h2>Followers</h2>
    <?php
    // Loop through each friend ID and fetch their details
    foreach ($followers as $friend_id) {
        // Execute SQL query to fetch name, phone, email, and current work of the friend
        $friend_query = mysqli_query($connect, "SELECT name, phone, email, current_work FROM person WHERE id = '$friend_id'");
        $friend_data = mysqli_fetch_assoc($friend_query);

        // SELECT club_position.name FROM club_position WHERE club_position.id = (SELECT members_info.club_position FROM members_info WHERE members_info.person_id = '011221031')
        $club_position_query = mysqli_query($connect, "SELECT club_position.name FROM club_position WHERE club_position.id = (SELECT members_info.club_position FROM members_info WHERE members_info.person_id = '$friend_id')");
        $club_position_data = mysqli_fetch_assoc($club_position_query);
    ?>
    <a href="user.php?id=<?php echo $friend_id; ?>" class="user">
        <?php 
            $profile_picture = 'uploads/' . $friend_id . '.jpg';
            if (!file_exists($profile_picture)) {
                $num = $friend_id % 6;
                $profile_picture = 'assets/avatar/' . $num . '.png';
            }
        ?>
        <img class="rounded-circle mt-3" width="150px" src="<?php echo $profile_picture; ?>">
        <p class="name"><?php echo $friend_data['name']; ?></p>
        <p class="address"><?php echo $friend_data['current_work']; ?></p>
        <p class="location"><?php echo $club_position_data['name']; ?></p>
    </a>
    <?php
    }
    ?>
</div>



<div id="container">
    <h2>Club Friends</h2>
    <?php
    // Loop through each friend ID and fetch their details
    foreach ($friends as $friend_id) {
        if ($friend_id == $id) {
            continue;
        }
        // Execute SQL query to fetch name, phone, email, and current work of the friend
        $friend_query = mysqli_query($connect, "SELECT name, phone, email, current_work FROM person WHERE id = '$friend_id'");
        $friend_data = mysqli_fetch_assoc($friend_query);

        // SELECT club_position.name FROM club_position WHERE club_position.id = (SELECT members_info.club_position FROM members_info WHERE members_info.person_id = '011221031')
        $club_position_query = mysqli_query($connect, "SELECT club_position.name FROM club_position WHERE club_position.id = (SELECT members_info.club_position FROM members_info WHERE members_info.person_id = '$friend_id')");
        $club_position_data = mysqli_fetch_assoc($club_position_query);
    ?>
    <a href="user.php?id=<?php echo $friend_id; ?>" class="user">
        <?php 
            $profile_picture = 'uploads/' . $friend_id . '.jpg';
            if (!file_exists($profile_picture)) {
                $num = $friend_id % 6;
                $profile_picture = 'assets/avatar/' . $num . '.png';
            }
        ?>
        <img class="rounded-circle mt-3" width="150px" src="<?php echo $profile_picture; ?>">
        <p class="name"><?php echo $friend_data['name']; ?></p>
        <p class="address"><?php echo $friend_data['current_work']; ?></p>
        <p class="location"><?php echo $club_position_data['name']; ?></p>
    </a>
    <?php
    }
    ?>
</div>


</body>
</html>
