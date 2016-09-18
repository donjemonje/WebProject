<?php
	session_start();

	include_once 'db/connect.php';
	 if(isset($_POST["query"]))  
	 { 
		$json= $_POST['query'];
	
		$userid = $_SESSION['session_id']; 
		$text = $json['postText'];
		$pic = $json['postImg'];
		$isPrivate = $json['isPrivate'];
		

		$stmt= $db->prepare("INSERT INTO post(text, image, author_id, isPrivate) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("ssss", $text, $pic, $userid, $isPrivate);

		// execute
		$stmt->execute();


		$stmt->close();
		$db->close();
		
		echo "success";
		
	}
 ?> 