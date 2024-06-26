<?php
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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

        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            border: 1px solid #ccc;
            border-radius: 4px;
            display: inline-block;
            padding: 2px 12px;
            cursor: pointer;
            background-color: #f9f9f9;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .custom-file-upload:hover {
            background-color: #e9e9e9;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Create Account</h2>
            <form action="register.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="id" placeholder="Student ID" required>
                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="text" name="phone" placeholder="Phone" required>
                <input type="text" name="current_work" placeholder="Current Work" required>
                <input type="date" name="dob" placeholder="Date of Birth" required>
                
                <select name="country" required>
                    <option value="" disabled selected>Select Country</option>
                    <?php 
                        require_once('dbconfig.php');
                        $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");
                        
                        $query = "SELECT id, name FROM country";
                        $result = mysqli_query($connect, $query);

                        while($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            echo "<option value=\"$id\">$name</option>";
                        }
                    ?>
                </select>





                </select>

                <select name="city" required>
                    <option value="" disabled selected>Select City</option>
                    <?php 
                        require_once('dbconfig.php');
                        $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");
                        
                        $query = "SELECT id, name FROM city";
                        $result = mysqli_query($connect, $query);

                        while($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            echo "<option value=\"$id\">$name</option>";
                        }
                    ?>

                </select>

                <!-- <input type="text" name="batch" placeholder="Batch" required> -->
                <select name="batch" required>
                    <option value="" disabled selected>Select Batch</option>
                    <?php 
                        require_once('dbconfig.php');
                        $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");
                        
                        $query = "SELECT id FROM batch";
                        $result = mysqli_query($connect, $query);

                        while($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            echo "<option value=\"$id\">$id</option>";
                        }
                    ?>

                </select>
                <input type="password" name="password" placeholder="Password" required>

                <label for="fileToUpload" class="custom-file-upload">Upload Profile Picture</label>
                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" required>

                
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
