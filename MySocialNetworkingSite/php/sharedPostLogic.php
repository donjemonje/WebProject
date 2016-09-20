<?php
/**
 * Created by PhpStorm.
 * User: danieleast
 * Date: 20/09/2016
 * Time: 10:36 PM
 */

include "helpers.php";

function getUserDataForUserRow($userRow)
{
    $user_data = array(
        'userName' => $userRow["username"],
        'userImage' => $userRow["image"],
    );
    return $user_data;

}

function getPostDataFor($postRow, $user_data , $comment_output)
{
    $post_data = array(
        'postid' => $postRow["id"],
        'isPrivate' => fromIntToBool($postRow["isPrivate"]),
        'postImgPath' => $postRow["image"],
        'postDate' => $postRow["date"],
        'text' => $postRow["text"],
        'userName' => $user_data["userName"],
        'userImagePath' => $user_data["userImage"],
        'likeCount' => $postRow["likes"],
        'authorId' => $postRow["author_id"],
        'comments' => $comment_output,
    );
    return $post_data;

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