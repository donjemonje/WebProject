<?php
	session_start();

	include_once 'db/connect.php';

	$error = false;

 if(isset($_POST["id"]))  
 {
     
      echo $_POST["id"];


 }  
 ?> 