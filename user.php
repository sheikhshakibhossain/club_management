<?php

include("session.php");
if (empty($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
require_once('dbconfig.php');
$connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    
    $profile_picture = 'uploads/' . $id . '.jpg';
    if (!file_exists($profile_picture)) {
        $num = $id % 6;
        $profile_picture = 'assets/avatar/' . $num . '.png';
    }


    $results = mysqli_query($connect, "SELECT * FROM person WHERE id = '$id'")
        or die("Can not execute query");
    
    while ($rows = mysqli_fetch_array($results)) {
        extract($rows);
        $user_name = $rows['name'];
    }
    
    $city_result = mysqli_query($connect, "SELECT name FROM `city` WHERE id = '$city'")
    or die("Can not execute query");
    
    $city_name = "";
    if ($row = mysqli_fetch_assoc($city_result)) {
        $city_name = $row['name'];
    }
    
    $country_result = mysqli_query($connect, "SELECT name FROM `country` WHERE id = '$country'")
    or die("Can not execute query");
    
    $country_name = "";
    if ($row = mysqli_fetch_assoc($country_result)) {
        $country_name = $row['name'];
    }
    
    $club_position_query = mysqli_query($connect, "SELECT club_position.name FROM members_info LEFT JOIN club_position ON members_info.club_position = club_position.id WHERE members_info.person_id = '$id'")
    or die("Can not execute club position query");
        
    $club_position = "";
    if ($row = mysqli_fetch_assoc($club_position_query)) {
        $club_position = $row['name'];
    }

    $club_name_query = mysqli_query($connect, "SELECT name FROM club WHERE club.id = (SELECT members_info.club FROM members_info WHERE person_id = '$id')")
    or die("Can not execute club position query");
        
    $club_name = "";
    if ($row = mysqli_fetch_assoc($club_name_query)) {
        $club_name = $row['name'];
    }


    
    $session_query = mysqli_query($connect, "SELECT session.name FROM members_info left JOIN session on members_info.sessions = session.id WHERE members_info.person_id = '$id'")
    or die("Can not execute club position query");
    
    $session_name = "";
    if ($row = mysqli_fetch_assoc($session_query)) {
        $session_name = $row['name'];
    }

    $mentor_query = mysqli_query($connect, "SELECT person.name FROM `person` WHERE person.id = (SELECT club_mentor.person_id FROM `club_mentor` WHERE club_mentor.id = (SELECT members_info.club_mentor FROM `members_info` WHERE members_info.person_id = '$id'))")
    or die("Can not execute club position query");
    
    $mentor_name = "";
    if ($row = mysqli_fetch_assoc($mentor_query)) {
        $mentor_name = $row['name'];
    }


    $friend_id = $id;
    $person_id = $_SESSION['user_id'];

    $friend_query = mysqli_query($connect, "SELECT count(*) FROM friend WHERE person_id = '$person_id' AND friend_id = '$friend_id'");
    $friend_count = mysqli_fetch_array($friend_query)[0];


    $logged_user_id = $_SESSION['user_id'];
    $logged_user_name_query = mysqli_query($connect, "SELECT name FROM person WHERE id = '$logged_user_id'");
    $logged_user_name = mysqli_fetch_array($logged_user_name_query)[0];


} else {
    echo "ID parameter is missing!";
    header("Location: index.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #0D9276; 
        }
        .light-red-btn {
            background-color: #FA7070; 
            color: #fff; 
            padding: 8px 30px; 
            border-radius: 4px; 
            text-decoration: none;
            margin-left: 20px;
        }

        .light-red2-btn {
            background-color: #FA7070; 
            color: #fff; 
            padding: 8px 30px; 
            border-radius: 4px; 
            text-decoration: none;
            margin-left: 270px;
        }
    </style>

</head>
<body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-3 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <!-- <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg"> -->
                <!-- <img class="rounded-circle mt-5" width="150px" src="assets/logo.png"> -->
                <img class="rounded-circle mt-5" width="150px" src="<?php echo $profile_picture; ?>">
                <span class="font-weight-bold"><?php echo $name; ?></span>
                <span class="text-black-50"><?php echo $email; ?></span>
            </div>
        </div>
        <div class="col-md-5 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Student ID: </label><?php echo $id; ?></div>
                    <div class="col-md-12"><label class="labels">Batch: </label><?php echo $batch; ?></div>
                    <div class="col-md-12"><label class="labels">Current Work: </label><?php echo $current_work; ?></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">Mobile Number: </label><?php echo $phone; ?></div>
                    <div class="col-md-12"><label class="labels">Address: </label><?php echo $address; ?></div>
                    <div class="col-md-12"><label class="labels">Date of Birth: </label><?php echo $dob; ?></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12"><label class="labels">City: </label><?php echo $city_name; ?></div>
                    <div class="col-md-12"><label class="labels">Country: </label><?php echo $country_name; ?></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center experience">
                    <span>
                        <h4 class="text-right"><?php echo "Member of $club_name";?></h4>
                    </span>
                </div>

            </div>

            <?php if ($friend_count < 1): ?>
            <span>
                <a href="add_friend.php"  class="light-red-btn">
                    <?php 
                        include("session.php");
                        $_SESSION['friend_req_id'] = $id;
                    ?>
                    <i class="fa fa-plus"></i>&nbsp;Follow
                </a>
            </span>
            <?php endif; ?>

            <?php if ($friend_count > 0): ?>
            <span>
                <a href="remove_friend.php"  class="light-red2-btn">
                    <?php 
                        include("session.php");
                        $_SESSION['friend_req_id'] = $id;
                    ?>
                    <i class="fa fa-plus"></i>&nbsp;Unfollow
                </a>
            </span>
            <?php endif; ?>


            <div class="p-3 py-5">
                <span>
                    <form id="emailForm">
                        <textarea id="emailBody" rows="5" cols="40" placeholder="Message ..."></textarea>
                        <button type="button" onclick="
                            var email = '<?php echo $email; ?>';  
                            var body = document.getElementById('emailBody').value;  
                            var subject = '<?php echo $logged_user_name; ?> sent a message from Club and Alumni Social Platform'; 
                            var mailtoLink = 'mailto:' + email + '?subject=' + encodeURIComponent(subject) + '&body=' + encodeURIComponent(body);  // Construct the mailto link
                            window.location.href = mailtoLink; 
                        ">Send Email</button>
                    </form>
                </span>
            </div>

        </div>
    </div>
</div>


</body>
</html>
