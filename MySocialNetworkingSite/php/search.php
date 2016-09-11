<?php
	session_start();

	include_once 'db/connect.php';

	$error = false;

 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = "SELECT * FROM user WHERE username LIKE '%".$_POST["query"]."%'";  
      $result = mysqli_query($db, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li>'.$row["username"].'</li>';  
           }  
      }  
      else  
      {  
           $output .= '<li>Name Not Found</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  
 ?> 