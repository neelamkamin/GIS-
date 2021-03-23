<?php 
 function show_name() 

 {
			$servername = "localhost:3306";
			$username = "root";
			$password = "";
			$dbname = "rms_db";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
 // $this->session->userdata('user_id');
	$qry ="SELECT * FROM users WHERE id = '$user_id'";
                    $res =mysqli_query($conn,$qry);
                    $row = mysqli_fetch_array($res);
                    $role = $row['id'];
		//print_r($role);               

		echo "Welcome-  ". $row['id'] . ",<br>"; //$row VARIABLE IS TAKEN FROM ABOVE AT LINE NO. 9//
		//echo $row['designation'];
}

echo show_name();

?>