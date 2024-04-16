<?php

include("session.php");

require_once('dbconfig.php');
$connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $results = mysqli_query($connect, "SELECT * FROM person WHERE id = '$id'")
        or die("Can not execute query");
    
    while ($rows = mysqli_fetch_array($results)) {
        extract($rows);
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


} else {
    echo "ID parameter is missing!";
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UIU Social Platform</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

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
                <img class="rounded-circle mt-5" width="150px" src="assets/logo.jpg">
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
                        <h4 class="text-right">Club Info</h4>
                    </span>
                </div><br>
                <?php if (!empty($club_position) && !empty($session_name)): ?>
                    <div class="col-md-12"><label class="labels">Position: </label><?php echo $club_position; ?></div>
                    <div class="col-md-12"><label class="labels">Active Session: </label><?php echo $session_name; ?></div> <br>
                    <div class="col-md-12"><label class="labels">Mentor: </label><?php echo $mentor_name; ?></div>
                    <?php else: ?>
                        <div class="col-md-12"><label class="labels">You are not a member. </label> <a href="join_club.php?id=<?php echo $id; ?>"> Join a Club!</a></div>
                    <?php endif; ?>

            </div>
            <span>
                <a href="friends.php?id=<?php echo $id; ?>" class="border px-3 p-1 add-experience">
                    <i class="fa fa-plus"></i>&nbsp;Friends
                </a>
            </span>
        </div>
    </div>
</div>


</body>
</html>
