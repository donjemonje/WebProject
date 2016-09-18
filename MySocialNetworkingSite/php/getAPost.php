<?php
/**
 * Created by PhpStorm.
 * User: danieleast
 * Date: 17/09/2016
 * Time: 2:22 PM
 */

    session_start();

    include_once 'db/connect.php';
    $json= $_POST['query'];
    $postId= $json['postId'];

    $postsQuery = "SELECT * FROM post WHERE id LIKE  '%".$postId."%'";


    $post_data = array();

    $result = mysqli_query($db, $postsQuery);
    if(mysqli_num_rows($result) > 0)
    {
        while($postRow = mysqli_fetch_array($result))
        {
            $comment_output = getCommentsForPostId($postId, $db);

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
        }
    }

    echo json_encode($post_data);






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


