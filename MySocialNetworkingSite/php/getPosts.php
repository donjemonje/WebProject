<?php
	session_start();

	include_once 'db/connect.php';
	$error = false;
	 if($_POST["query"] == "me")  
	{
		$postsQuery = "SELECT * FROM post WHERE author_id LIKE  '%".$_SESSION['session_id']."%'";  
	}
	elseif($_POST["query"] == "friends")  
	{
		$postsQuery = "SELECT * FROM post WHERE author_id LIKE  '%".$_SESSION['session_id']."%'";  
	}
	else 
		$error = true;
	
	if($error == false)
	{
		$comment_output = array();
		$output = array();
		
		
			
		$result = mysqli_query($db, $postsQuery);
		
		if(mysqli_num_rows($result) > 0)
		{  
		
			while($postRow = mysqli_fetch_array($result))  
			{
				//$rowPost;
				//$rowComment;
				//$rowUser;
				$commentsQuery = "SELECT * FROM comment WHERE post_id LIKE  '%".$postRow["id"]."%'";  
				$commentsResult = mysqli_query($db, $commentsQuery);
				
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
							//'userImage' => $userRow["userimage"],
							);
						}
						$comment_data = array(
							'id' => $commentRow["id"],
							'postid' => $commentRow["post_id"],
							'postDate' => $commentRow["time"],
							'text' => $commentRow["text"],
							'author' => $user_data["userName"],
							//'commentImgPath' => $user_data["userImage"],					   
						);
						
						$comment_output[] = $comment_data;
					}
				}
						
				$userQuery = "SELECT * FROM user WHERE id LIKE  '%".$postRow["author_id"]."%'";  
				$userResult = mysqli_query($db, $userQuery);
				
				while($userRow = mysqli_fetch_array($userResult))  
				{
					$user_data = array(
					'userName' => $userRow["username"],
					//'userImage' => $userRow["userimage"],
					);
				
				}
						
				$post_data = array(
					'postid' => $postRow["id"],
					'postImgPath' => $postRow["image"],
					'postDate' => $postRow["date"],
					'text' => $postRow["text"],
					'userName' => $user_data["userName"],
					//'userImagePath' => $user_data["userImage"],	
					'likeCount' => $postRow["likes"],
					'comments' => $comment_output,   
				);

				
				$output[] = $post_data;
				unset($comment_data);
				$comment_output = array();
				//unset($comment_output);
				
			}  
			
			echo json_encode($output);
		}  


		
	
	 /*
		$json= $_POST['query'];
	
		$userid = $_SESSION['session_id']; 
		$text = $json['postText'];
		$pic = $json['postImg'];
		
		//echo json_encode($pic);
		
		$stmt= $db->prepare("INSERT INTO post(text, image, author_id) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $text, $pic, $userid);

		// execute
		$stmt->execute();

		//header("location: html/main.php");
		
		$stmt->close();
		$db->close();
		
		//echo "workinggggg" + $json;
		*/
	
	}
 ?> 