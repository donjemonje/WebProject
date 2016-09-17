<?php
	session_start();

	include_once 'db/connect.php';

	if(isset($_POST["query"]))  
	{
		$query = "SELECT * FROM user WHERE username LIKE '%".$_POST["query"]."%'";  
		$result = mysqli_query($db, $query);
		
		if(mysqli_num_rows($result) > 0)
		{  
			$row = mysqli_fetch_array($result);
		
			$query = "SELECT * FROM friend WHERE id_1 LIKE '%".$_SESSION['session_id']."%' AND id_2 LIKE '%".$row["id"]."%'";  
			$result = mysqli_query($db, $query);
			
			if(mysqli_num_rows($result) > 0)
			{  
				
				echo "Friendship Exist";
				
			}
			else {	
				
				$query = "INSERT INTO friend(id_1, id_2) VALUES ('".$_SESSION['session_id']."', '".$row["id"]."')";
				//SELECT * FROM friend WHERE id_1 LIKE '%".$_SESSION['session_id']."%' AND id_2 LIKE '%".$row["id"]."%'";  
				$result = mysqli_query($db, $query);
			
				$query = "INSERT INTO friend(id_1, id_2) VALUES ('".$row["id"]."', '".$_SESSION['session_id']."')";
				$result = mysqli_query($db, $query);
				
				echo "You and " .$row["username"]. " are now friends";
				//echo $row["username"]; liel ->> liel arie
				//echo $query;
			}
		}
		else {
			echo "No Such User!";  // never showing
		}
	}  
 ?> 