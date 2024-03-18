<?php

    require_once('dbconfig.php');
    $connect = mysqli_connect(HOST, USER, PASS, DB) or die("Can not connect");

    if(isset($_GET['id'])) {

        $id = $_GET['id'];

        $results = mysqli_query($connect, "SELECT * FROM person WHERE id = '$id'")
            or die("Can not execute query");

        echo "<table border> \n";
        echo "<th>ID</th> <th>Name</th> <th>Email</th> <th>Phone</th> \n";

        while ($rows = mysqli_fetch_array($results)) {
            extract($rows);
            echo "<tr>";
            echo "<td> $id  </td>";
            echo "<td> $name  </td>";
            echo "<td> $email  </td>";
            echo "<td> $phone </td>";

            // if ($city != 5) {
            //     echo "<td>Hablu</td>";
            // } else {
            //     echo "<td>Maklu</td>";
            // }
            echo "</tr> \n";
        }
        echo "</table> \n";

    } else {
        echo "ID parameter is missing!";
    }

    echo "<p><a href=index.html>Return home</a>";

?>
