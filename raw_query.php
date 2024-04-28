<?php

include("session.php");
if (empty($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

require_once('dbconfig.php');
$connect = mysqli_connect(HOST, USER, PASS, DB) or die("Could not connect to the database");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['query'])) {

    $query = $_POST['query'];

    $query_result = mysqli_query($connect, $query) or die("Could not execute query");

    if (mysqli_num_rows($query_result) > 0) {
        
        echo "<table border='1'>";
        echo "<tr>";
        $field_count = mysqli_num_fields($query_result);
        for ($i = 0; $i < $field_count; $i++) {
            $field_info = mysqli_fetch_field_direct($query_result, $i);
            echo "<th>{$field_info->name}</th>";
        }
        echo "</tr>";
        
        while ($row = mysqli_fetch_assoc($query_result)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
}

?>
