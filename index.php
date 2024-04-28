<?php
    include("session.php");
    // session_destroy();
    if (!empty($_SESSION['user_id'])) {
        header("Location: profile.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Club Members and Alumni</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('assets/bg_4.jpg'); 
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

        .content {
            text-align: center;
            margin-top: 100px;
            color: #fff; /* Set text color to white for better visibility */
        }

        .button-container {
            margin-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            margin: 0 10px;
            transition: background-color 0.3s ease;
        }

        .button-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Club Members and Alumni</h1> 
            <br><br><br><br>
            <h3>Not signed up yet ?</h3>
            <div class="button-container">
                <button onclick="redirectTo('register_page.php')">Create Account</button>
            </div>
            <br><br><br>
            <h3>Already signed up ?</h3>
            <div class="button-container">
                <button onclick="redirectTo('login.html')">User</button>
            
                <button onclick="redirectTo('admin.html')">Admin</button>
            </div>
        </div>
    </div>

    <script>
        function redirectTo(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
