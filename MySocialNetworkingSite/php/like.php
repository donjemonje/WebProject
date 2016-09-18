<?php
	session_start();

	include_once 'db/connect.php';

	if(isset($_POST["query"]))  
	{
		$query = "SELECT * FROM post WHERE id LIKE '%".$_POST["query"]."%'";  
		$result = mysqli_query($db, $query);
		
		if(mysqli_num_rows($result) > 0)
		{  
			$postRow = mysqli_fetch_array($result);
			
			$temp = $postRow["likes"]+1;
		
			$stmt = "UPDATE post SET likes='.$temp.' WHERE id LIKE '%".$_POST["query"]."%'";
			mysqli_query($db, $stmt);
			
		}
	}  
	echo json_encode($temp);
 ?> 