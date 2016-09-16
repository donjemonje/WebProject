<?php
	session_start();

	include_once 'db/connect.php';
	 if($_POST["query"] == "me")  
	 {

		 $comment_output = array();
		$output = array();
		$postsQuery = "SELECT * FROM post WHERE author_id LIKE  '%".$_SESSION['session_id']."%'";  
		
		$result = mysqli_query($db, $postsQuery);
		
		if(mysqli_num_rows($result) > 0)
		{  
		
			while($row = mysqli_fetch_array($result))  
			{
				//$rowPost;
				//$rowComment;
				//$rowUser;
				$commentsQuery = "SELECT * FROM comment WHERE post_id LIKE  '%".$row["id"]."%'";  
				$commentsResult = mysqli_query($db, $commentsQuery);
				
				if(mysqli_num_rows($commentsResult) > 0)
				{  
		
					while($commentRow = mysqli_fetch_array($commentsResult))  
					{
						$comment_data = array(
							'id' => $commentRow["id"],
							'postid' => $commentRow["post_id"],
							'postDate' => $commentRow["time"],
							'text' => $commentRow["text"],
							'author' => $commentRow["author"],
						   
						);
						
						$comment_output[] = $comment_data;
					}
				}
								
				$post_data = array(
					'postid' => $row["id"],
					'Image' => $row["image"],
					'postDate' => $row["date"],
					'text' => $row["text"],
					'author' => $row["author_id"],
					'comments' => $comment_output,
				//	'postImgPath' => $rowUSer["userName"],
				//	'comments' => array(
				//	'userName' => $rowUSer["userName"],
				//	)   
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