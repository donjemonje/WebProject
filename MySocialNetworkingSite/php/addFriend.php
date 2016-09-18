<?php
	session_start();

	include_once 'db/connect.php';

	if(isset($_POST["query"]))  
	{
		$query = "SELECT * FROM user WHERE username LIKE '".$_POST["query"]."'";  
		$result = mysqli_query($db, $query);
		$num = mysqli_num_rows($result);
		if(mysqli_num_rows($result) > 0)
		{  
			$row = mysqli_fetch_array($result);
			$friendId = $row["id"];
			$myId = $_SESSION['session_id'];
		
			$query = "SELECT * FROM friend WHERE id_1 LIKE '%".$myId."%' AND id_2 LIKE '%".$friendId."%'";  
			$result = mysqli_query($db, $query);
			
			if(mysqli_num_rows($result) > 0)
			{  
				
				echo "Friendship Exist";
				
			}
			else {	
				
				$query = "INSERT INTO friend(id_1, id_2) VALUES ('".$myId."', '".$friendId."')";
				//SELECT * FROM friend WHERE id_1 LIKE '%".$_SESSION['session_id']."%' AND id_2 LIKE '%".$row["id"]."%'";  
				$result = mysqli_query($db, $query);
			
				$query = "INSERT INTO friend(id_1, id_2) VALUES ('".$friendId."', '".$myId."')";
				$result = mysqli_query($db, $query);
				
				echo "You and " .$row["username"]. " are now friends";
				//echo $num; //liel ->> liel arie
				//echo $query;
			}
		}
		else {
			echo "No Such User!";  // never showing
		}
	}  
 ?> 