<?php

function count_all_title() 
   {
			$servername = "localhost:3306";
			$username = "root";
			$port     = "3306";
			$password = "";
			$dbname = "rms_db";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 

			//$sql = "SELECT SUM(cost) AS value_sum FROM articles";
			$sql = "SELECT COUNT(title) AS value_sum FROM articles";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // output data of each row
			   while($row = $result->fetch_assoc()) {
			    echo "<b>TOTAL REPORT SUBMITTED BY ALL PROJECT IN-CHARGE IS :- " . $row["value_sum"]. "  Reports </b>";
			    }
			} else {
			    echo "0 results";
			}
			$conn->close();

    }

 ?>