<?php

    include("session.php");
    if (empty($_SESSION['admin_id'])) {
        header("Location: index.php");
        exit();
    }
    
    require_once('dbconfig.php');
    $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Could not connect to the database");

    $id = $_SESSION['admin_id'];
    $results = mysqli_query($connect, "SELECT * FROM person WHERE id = '$id'")
        or die("Could not execute query");
    while ($rows = mysqli_fetch_array($results)) {
        extract($rows);
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $club_name = mysqli_real_escape_string($connect, $_POST['club_name']);
        $club_check_query = mysqli_query($connect, "SELECT COUNT(*) FROM club WHERE name = '$club_name'") 
            or die("Could not execute query");
        $club_check_status = mysqli_fetch_array($club_check_query)[0]; 


        if ($club_check_status > 0) {
            echo "club exists";
        } else if(isset($_POST['club_name']) && isset($_POST['club_room']) && isset($_POST['description'])) {
            $club_name = mysqli_real_escape_string($connect, $_POST['club_name']);
            $club_room = mysqli_real_escape_string($connect, $_POST['club_room']);
            $description = mysqli_real_escape_string($connect, $_POST['description']);
            
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #BBE2EC; 
        }
        .light-red-btn {
            background-color: #FA7070; 
            color: #fff; 
            padding: 8px 12px; 
            border-radius: 4px; 
            text-decoration: none; 
        }
    </style>
</head>
<body>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle mt-5" width="150px" src="assets/logo.jpg">
                <?php if(isset($name) && isset($email)): ?>
                    <span class="font-weight-bold"><?php echo $name; ?></span>
                    <span class="text-black-50"><?php echo $email; ?></span>
                <?php endif; ?>

                <span>
                    <br>
                     <a style="left-mergin: 120px"href="logout.php" class="light-red-btn" style="margin-left: 120px;">
                        <i class="fa fa-plus"></i>&nbsp;Logout
                    </a>
                </span>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Add a Club</h4>
                    </div>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Club Name</label><input type="text" name="club_name" class="form-control" placeholder="" value=""></div>
                            <div class="col-md-12"><label class="labels">Club Room</label><input type="text" name="club_room" class="form-control" placeholder="" value=""></div>
                            <div class="col-md-12"><label class="labels">Description</label><input type="text" name="description" class="form-control" placeholder="" value=""></div>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Club</button></div>
                    </form>
                </div>
            </div>

            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Add a Club</h4>
                    </div>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="row mt-3">
                            <div class="col-md-12"><label class="labels">Club Name</label><input type="text" name="club_name" class="form-control" placeholder="" value=""></div>
                            <div class="col-md-12"><label class="labels">Club Room</label><input type="text" name="club_room" class="form-control" placeholder="" value=""></div>
                            <div class="col-md-12"><label class="labels">Description</label><input type="text" name="description" class="form-control" placeholder="" value=""></div>
                        </div>
                        <div class="mt-5 text-center"><button class="btn btn-primary profile-button" type="submit">Save Club</button></div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
