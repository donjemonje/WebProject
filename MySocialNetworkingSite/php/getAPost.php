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
        while($row = mysqli_fetch_array($result))
        {
            $comment_output = getCommentsForPostId($postId, $db);

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

        return $comment_output;
    }


 ?>


