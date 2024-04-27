
<?php

    include("session.php");
    if (empty($_SESSION['admin_id'])) {
        header("Location: index.php");
        exit();
    }
    
    require_once('dbconfig.php');
    $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Could not connect to the database");

    
    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['person_id'])) {

        $person_id = $_POST['person_id'];
        // echo "$person_id";

        $person_check_query = mysqli_query($connect, "SELECT COUNT(*) FROM person WHERE id = '$person_id'") 
            or die("Could not execute query");
        $person_check_status = mysqli_fetch_array($person_check_query)[0];
        
        $member_check_query = mysqli_query($connect, "SELECT COUNT(*) FROM members_info WHERE person_id = '$person_id'") 
            or die("Could not execute query");
        $member_check_status = mysqli_fetch_array($member_check_query)[0];



        if ($member_check_status == 0) {
            echo "Member does not exists";
        } else {
            
            $query = "DELETE FROM members_info WHERE person_id = '$person_id'";
            $result = mysqli_query($connect, $query);
            if ($result) {
                echo "Member Removed successfully!";
            } else {
                echo "Error: " . mysqli_error($connect);
            }
            
        }
        echo "<br>";

        if ($person_check_status == 0) {
            echo "Person does not exists";
        } else {
            
            $query = "DELETE FROM person WHERE id = '$person_id'";
            $result = mysqli_query($connect, $query);
            if ($result) {
                echo "Person Removed successfully!";
            } else {
                echo "Error: " . mysqli_error($connect);
            }
            
        }

    }
?>