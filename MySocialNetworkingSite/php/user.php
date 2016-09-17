<?php
/**
 * Created by PhpStorm.
 * User: danieleast
 * Date: 17/09/2016
 * Time: 3:49 PM
 */

    session_start();

    include_once 'db/connect.php';
    $userid = $_SESSION['session_id'];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userQuery = "SELECT * FROM user WHERE id LIKE  '%".$userid."%'";

    $user = array();

    $result = mysqli_query($db, $userQuery);
    if(mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_array($result);
        $user = array(
            'email' => $row["email"],
            'image' => $row["image"]
        );
    }

    echo json_encode($user);

} else if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $query = $_POST['query'];
    $image = $query['image'];
    $mail = $query['mail'];

    $apos= '\'';
    $sql = "UPDATE user SET image=".$apos.$image.$apos;
    if($mail != null){
       $sql .= ", email=".$apos.$mail.$apos;
    }
    $sql .= " WHERE id=".$userid;
    
    $stmt= $db->prepare($sql);

    // execute
    $stmt->execute();


    $stmt->close();
    $db->close();


    $user = array();

    echo json_encode($image);
}


 ?>


