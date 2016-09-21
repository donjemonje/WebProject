<?php
	session_start();

	include_once 'db/connect.php';

	$error = false;
 


		$output = array();
		$query = "SELECT * FROM user WHERE id LIKE '".$_SESSION['session_id']."%'";  
		$result = mysqli_query($db, $query);
		if(mysqli_num_rows($result) != 0)
		{  
			$row = mysqli_fetch_array($result);
			
					$image = $row['image'];
			
			 echo json_encode($image);
		}  
		else
			echo json_encode(null);
	
  
 ?> 