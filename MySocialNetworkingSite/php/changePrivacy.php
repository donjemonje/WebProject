<?php
/**
 * Created by PhpStorm.
 * User: danieleast
 * Date: 18/09/2016
 * Time: 7:55 PM
 */

	session_start();

	include_once 'db/connect.php';

	if(isset($_POST["query"]))
    {

        $query = $_POST['query'];

        $isPrivate = $query['isPrivate'];
        $postId = $query["postId"];

        $apos= '\'';
        $sql = "UPDATE post SET isPrivate=".$apos.$isPrivate.$apos." WHERE id=".$postId;


        $stmt= $db->prepare($sql);

        // execute
        $stmt->execute();


        $stmt->close();
        $db->close();

    }

	echo "success";
 ?>