<?php
	require_once('dbconfig.php');
	$connect = mysqli_connect( HOST, USER, PASS, DB )
		or die("Can not connect");


	$results = mysqli_query( $connect, "SELECT * FROM person" )
		or die("Can not execute query");

	echo "<table border> \n";
	echo "<th>ID</th> <th>Name</th> <th>Remark</th> \n";
	// <th>End date</th> <th>Status</th> <th>Remarks</th> <th>Approval</th> 

	while( $rows = mysqli_fetch_array( $results ) ) {
		extract( $rows );
		echo "<tr>";
		echo "<td> $id  </td>";
		echo "<td> $name  </td>";
		// echo "<td> </td>"

        
		if($city!=5){
            echo "<td>Hablu</td>";
        }
		else {
			echo "<td>Maklu</td>";
		}
        // if($_status!="ACCEPTED"){
        //     echo "<td> <a href = 'accept.php?id=$id'> Approve </a> </td>";
        // }
		
		echo "</tr> \n";
	}

	echo "</table> \n";

	echo "<p><a href=index.php>Return home</a>";
?>