<?php

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $id = $_GET["id"];
        require_once('dbconfig.php');
        $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");

    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join a Club</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            /* background-color: #f2f2f2; */
            background-image: url('assets/bg_1.jpg'); 
            background-size: cover;
            background-position: center;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            width: 350px;
        }

        .form-container h2 {
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"],
        .form-container input[type="date"],
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-container select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px top 50%;
            background-size: 20px;
            padding-right: 40px;
        }

        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Club Registration Form</h2>
            <form action="register_club.php" method="POST">
                <input type="text" name="person_id" value="<?php echo $id; ?>" readonly style="display: none;">

                <select name="club" required>
                    <option value="" disabled selected>Club</option>
                    <option value="1">Robotics Club</option>
                    <option value="2">Computer Club</option>
                    <option value="3">App Forum</option>
                    <option value="4">Sports Club</option>
                    <option value="5">Cultural Club</option>
                    <option value="6">UIU ELECTRICAL & ELECTRONICS CLUB</option>
                    
                </select>

                <select name="club_position" required>
                    <option value="" disabled selected>Position</option>
                    <option value="1">President</option>
                    <option value="2">Vice President</option>
                    <option value="3">General Secretary</option>
                    <option value="4">Treasurer</option>
                    <option value="5">Secretary, Research and Development</option>
                    <option value="6">Secretary, Event Management</option>
                    <option value="7">Secretary, Branding and promotion</option>
                    <option value="8">Secretary, Public Relations</option>
                    <option value="9">Secretary, Graphic Designs</option>
                    <option value="10">Joint Secretary, Research and Development</option>
                    <option value="11">Joint Secretary, Event Management</option>
                    <option value="12">Joint Secretary, Branding and Promotions</option>
                    <option value="13">Webmaster</option>
                    <option value="14">Consultant, Technical</option>
                    <option value="15">Executive, Research and Development</option>
                    <option value="16">Mentor</option>
                    <option value="17">General Member</option>
                    
                </select>

                </select>

                <select name="sessions" required>
                    <option value="" disabled selected>Session</option>
                    <option value="1">sept. 2019 - sept. 2020</option>
                    <option value="2">sept. 2020 - sept. 2021</option>
                    <option value="3">sept. 2021 - sept. 2022</option>
                    <option value="4">sept. 2022 - sept. 2023</option>
                    <option value="5">sept. 2023 - sept. 2024</option>
                    <!-- Add more options as needed -->
                </select>

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>


