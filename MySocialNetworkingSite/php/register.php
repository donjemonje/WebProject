<?php
error_reporting(0);
require 'db/connect.php';

// check correct password
$password = strip_tags($_POST['password']);
$confirmpassword = strip_tags($_POST['confirm-password']);
if($password == $confirmpassword) {

	// set parameters
	$username = strip_tags($_POST['username']);
	$email = strip_tags($_POST['email']);

	// prepare and bind
	$stmt= $db->prepare("INSERT INTO user(username, password, email) VALUES (?, ?, ?)");
	$stmt->bind_param("sss", $username, $password, $email);

	// execute
	$stmt->execute();

	echo "New records created successfully";
	
	$stmt->close();
	$db->close();
	
	session_register("myusername");
    $_SESSION['login_user'] = $myusername;
	header("location: ../html/main.html");
}
else {
		
		echo "passwords dont match";
		header("location: ../index.html");
	}
?>