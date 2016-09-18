<?php
/**
 * Created by PhpStorm.
 * User: danieleast
 * Date: 17/09/2016
 * Time: 2:22 PM
 */

	include 'getPosts.php';

    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }


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
				$user_data = getUserDataForUserRow($userRow);
			}

			$post_data = getPostDataFor($postRow, $user_data, $comment_output);
			
        }
    }

    echo json_encode($post_data);


 ?>


