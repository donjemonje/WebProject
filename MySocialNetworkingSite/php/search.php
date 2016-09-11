<?php
	session_start();

	include_once 'db/connect.php';

	$error = false;

 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM user WHERE username LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($db, $query);  
      if(mysqli_num_rows($result) > 0)
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= $row["username"];
           }  
      }  
      else  
      {  
           $output .= 'Name Not Found';
      }  
      echo $output;
 }  
 ?> 