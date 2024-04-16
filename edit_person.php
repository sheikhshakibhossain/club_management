<?php
require_once('dbconfig.php');
$connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary fields are set
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        // Update person's information in the database
        $update_query = "UPDATE person SET name = '$name', email = '$email', phone = '$phone' WHERE id = '$id'";
        $result = mysqli_query($connect, $update_query);

        if ($result) {
            echo "Person information updated successfully.";
        } else {
            echo "Error updating person information: " . mysqli_error($connect);
        }
    } else {
        echo "Missing required fields.";
    }

    // Update club position if provided
    if (isset($_POST['club_position'])) {
        $club_position = $_POST['club_position'];
        $id = $_POST['id'];

        $update_position_query = "UPDATE members_info SET club_position = '$club_position' WHERE person_id = '$id'";
        $result_position = mysqli_query($connect, $update_position_query);

        if ($result_position) {
            echo "Club position updated successfully.";
        } else {
            echo "Error updating club position: " . mysqli_error($connect);
        }
    }

    // Update session if provided
    if (isset($_POST['session'])) {
        $session = $_POST['session'];
        $id = $_POST['id'];

        $update_session_query = "UPDATE members_info SET session = '$session' WHERE person_id = '$id'";
        $result_session = mysqli_query($connect, $update_session_query);

        if ($result_session) {
            echo "Session updated successfully.";
        } else {
            echo "Error updating session: " . mysqli_error($connect);
        }
    }
    
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Handle GET request to display form for editing
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Retrieve person's information
        $result = mysqli_query($connect, "SELECT * FROM person WHERE id = '$id'")
            or die("Can not execute query");

        // Retrieve session
        $session_query = mysqli_query($connect, "SELECT session.id, session.name FROM members_info LEFT JOIN session ON members_info.session = session.id WHERE members_info.person_id = '$id'")
            or die("Can not execute session query");

        $session = "";
        if ($row = mysqli_fetch_assoc($session_query)) {
            $session = $row['id'];
        }

        // Display form for editing person's information
        if ($row = mysqli_fetch_assoc($result)) {
            echo "<h2>Edit Person Information</h2>";
            echo "<form method='post' action='edit_person.php'>";
            echo "<input type='hidden' name='id' value='{$row['id']}'>";
            echo "<label for='name'>Name:</label>";
            echo "<input type='text' name='name' value='{$row['name']}'> <br>";
            echo "<label for='email'>Email:</label>";
            echo "<input type='email' name='email' value='{$row['email']}'> <br>";
            echo "<label for='phone'>Phone:</label>";
            echo "<input type='text' name='phone' value='{$row['phone']}'> <br>";

            // Retrieve club positions
            $club_positions_query = mysqli_query($connect, "SELECT * FROM club_position");
            echo "<label for='club_position'>Club Position:</label>";
            echo "<select name='club_position'>";
            while ($position_row = mysqli_fetch_assoc($club_positions_query)) {
                $selected = ($row['club_position'] == $position_row['id']) ? 'selected' : '';
                echo "<option value='{$position_row['id']}' $selected>{$position_row['name']}</option>";
            }
            echo "</select> <br>";

            // Retrieve sessions
            $sessions_query = mysqli_query($connect, "SELECT * FROM session");
            echo "<label for='session'>Session:</label>";
            echo "<select name='session'>";
            while ($session_row = mysqli_fetch_assoc($sessions_query)) {
                $selected = ($session == $session_row['id']) ? 'selected' : '';
                echo "<option value='{$session_row['id']}' $selected>{$session_row['name']}</option>";
            }
            echo "</select> <br>";

            echo "<input type='submit' value='Update'>";
            echo "</form>";
        } else {
            echo "Person not found.";
        }
    } else {
        echo "ID parameter is missing!";
    }
} else {
    echo "Invalid request method.";
}
?>
