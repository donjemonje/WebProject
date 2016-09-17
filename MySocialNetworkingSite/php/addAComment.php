<?php
/**
 * Created by PhpStorm.
 * User: danieleast
 * Date: 17/09/2016
 * Time: 1:59 PM
 */
	session_start();

	include_once 'db/connect.php';
	 if(isset($_POST["query"]))
     {
         $json= $_POST['query'];

         $userid = $_SESSION['session_id'];
         $commentText = $json['commentText'];
         $postId = $json['postId'];


         $stmt= $db->prepare("INSERT INTO comment(author, text, post_id) VALUES (?, ?, ?)");
         $stmt->bind_param("sss", $userid, $commentText, $postId);

         // execute
         $stmt->execute();


         $stmt->close();
         $db->close();

         echo "success";

     }
 ?>