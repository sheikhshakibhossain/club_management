<?php
// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $current_work = $_POST["current_work"];
    $dob = $_POST["dob"];
    $city = $_POST["city"];
    $country = $_POST["country"];
    $batch = $_POST["batch"];
    $password = $_POST["password"];

    // File upload handling
    $target_dir = "uploads/"; // Directory where uploaded files will be stored
    $uploadFileName = $id . ".jpg"; // Filename to be saved
    $target_file = $target_dir . $uploadFileName; // Path of the uploaded file
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // File extension

    // Check if file is selected for upload
    if ($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
        // Check if the file is an actual image
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            // Check file size
            if ($_FILES["fileToUpload"]["size"] <= 5000000) { // Adjust file size limit as needed
                // Allow only certain file formats
                if ($imageFileType == "jpg" || $imageFileType == "jpeg" || $imageFileType == "png") {
                    // Move the uploaded file to the target directory with the new filename
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        // Image upload successful, proceed with database insertion
                        require_once('dbconfig.php');
                        $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");

                        $query = "INSERT INTO person (id, name, email, phone, current_work, dob, city, country, batch, passwd) VALUES ('$id', '$name', '$email', '$phone', '$current_work', '$dob', '$city', '$country', '$batch', '$password')";

                        $result = mysqli_query($connect, $query);

                        if ($result) {
                            echo "Registration successful!";
                            header("Location: login.html");
                            exit();
                        } else {
                            echo "Registration failed! Database error: " . mysqli_error($connect);
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                } else {
                    echo "Sorry, only JPG, JPEG, and PNG files are allowed.";
                }
            } else {
                echo "Sorry, your file is too large.";
            }
        } else {
            echo "File is not an image.";
        }
    } else {
        echo "Error uploading file.";
    }
} else {
    echo "Invalid request method.";
}
?>
