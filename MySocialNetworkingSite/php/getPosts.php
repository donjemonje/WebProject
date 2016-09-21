<?php
	session_start();

	include_once 'db/connect.php';
	include 'sharedPostLogic.php';

	$comment_output = array();
		$output = array();
		$usersArray = array();
		$error = false;
	if($_POST["query"]["type"] == "friends")
	{
		$friendsQuery = "SELECT * FROM friend WHERE id_1 LIKE '%".$_SESSION['session_id']."%'";  
		$friendsResult = mysqli_query($db, $friendsQuery);
		while($friendsRow = mysqli_fetch_array($friendsResult))  
		{
			$usersArray[] = $friendsRow["id_2"];
		}
		
	}
	elseif($_POST["query"]["type"] == "me")
	{
		$userId =  $_SESSION['session_id'];
		if(isset($_POST["query"]["userId"])){
			$userId = $_POST["query"]["userId"];
		}
		$userQuery = "SELECT * FROM user WHERE id LIKE '%".$userId."%'";
		$userResult = mysqli_query($db, $userQuery);
		while($userRow = mysqli_fetch_array($userResult))  
		{
			$usersArray[] = $userRow["id"];
		}
		
	}
	else 
		$error = true;
	
	
	if($error == false)
	{
		foreach ($usersArray as $user)
		{  
			unset($postsQuery);
			$postsQuery = "SELECT * FROM post WHERE author_id LIKE '".$user."'";
			if($_POST["query"]["type"] == "friends"){
				$postsQuery .= "AND isPrivate LIKE 0";
				//echo $postsQuery;
			}
			$result = mysqli_query($db, $postsQuery);
		
			if(mysqli_num_rows($result) > 0)
			{  
		
				while($postRow = mysqli_fetch_array($result))  
				{
					
					$comment_output = getCommentsForPostId($postRow["id"], $db);
					
					$userQuery = "SELECT * FROM user WHERE id LIKE  '%".$postRow["author_id"]."%'";  
					$userResult = mysqli_query($db, $userQuery);
					
					while($userRow = mysqli_fetch_array($userResult))
					{
						$user_data = getUserDataForUserRow($userRow);
					}

					$post_data = getPostDataFor($postRow, $user_data, $comment_output);

					$output[] = $post_data;
					
					unset($comment_data);
					$comment_output = array();
					$post_data = array();
					
				}  
			}
		}
		echo json_encode($output);		 
	}


 ?> 