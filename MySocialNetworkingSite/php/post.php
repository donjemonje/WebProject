<?php
	session_start();

	include_once 'db/connect.php';

	$userid = $_SESSION['session_id']; 
	$text = "This is another post";
	$pic = "1.jpg";
	
	$stmt= $db->prepare("INSERT INTO post(text, image, author_id) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $text, $pic, $userid);

	// execute
	$stmt->execute();

	//header("location: html/main.php");
	
	$stmt->close();
	$db->close();
	
	echo "workinggggg"; 
   
 ?> 