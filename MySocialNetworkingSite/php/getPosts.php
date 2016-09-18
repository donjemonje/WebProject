<?php
	session_start();

	include_once 'db/connect.php';
	
	$comment_output = array();
		$output = array();
		$usersArray = array();
		$error = false;
	if($_POST["query"] == "friends")  
	{
		$friendsQuery = "SELECT * FROM friend WHERE id_1 LIKE '%".$_SESSION['session_id']."%'";  
		$friendsResult = mysqli_query($db, $friendsQuery);
		while($friendsRow = mysqli_fetch_array($friendsResult))  
		{
			$usersArray[] = $friendsRow["id_2"];
		}
		
	}
	elseif($_POST["query"] == "me")  
	{	
		$userQuery = "SELECT * FROM user WHERE id LIKE '%".$_SESSION['session_id']."%'";  
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
						$user_data = array(
						'userName' => $userRow["username"],
						'userImage' => $userRow["image"],
						);
					
					}
							
					$post_data = array(
						'postid' => $postRow["id"],
						'postImgPath' => $postRow["image"],
						'postDate' => $postRow["date"],
						'text' => $postRow["text"],
						'userName' => $user_data["userName"],
						'userImagePath' => $user_data["userImage"],	
						'likeCount' => $postRow["likes"],
						'comments' => $comment_output,   
					);

					
					$output[] = $post_data;
					
					unset($comment_data);
					$comment_output = array();
					$post_data = array();
					
				}  
			}
		}
		echo json_encode($output);		 
	}
	
	function getCommentsForPostId($postId, $db)
    {
		$commentsQuery = "SELECT * FROM comment WHERE post_id LIKE  '%".$postId."%'";  
		$commentsResult = mysqli_query($db, $commentsQuery);
		$comment_output = array();

		if(mysqli_num_rows($commentsResult) > 0)
		{  

			while($commentRow = mysqli_fetch_array($commentsResult))  
			{
				$userQuery = "SELECT * FROM user WHERE id LIKE  '%".$commentRow["author"]."%'";  
				$userResult = mysqli_query($db, $userQuery);
				
				while($userRow = mysqli_fetch_array($userResult))  
				{
					$user_data = array(
					'userName' => $userRow["username"],
					'userImage' => $userRow["image"],
					);
				}
				
				$comment_data = array(
					'id' => $commentRow["id"],
					'postid' => $commentRow["post_id"],
					'postDate' => $commentRow["time"],
					'text' => $commentRow["text"],
					'author' => $user_data["userName"],
					'commentImgPath' => $user_data["userImage"],					   
				);
				
				$comment_output[] = $comment_data;
			}
		}
		return $comment_output;
	}
 ?> 