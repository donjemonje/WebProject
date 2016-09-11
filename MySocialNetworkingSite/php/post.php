<?php
	session_start();

	include_once 'db/connect.php';
	 if(isset($_POST["query"]))  
	 { 
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
		
	}
 ?> 