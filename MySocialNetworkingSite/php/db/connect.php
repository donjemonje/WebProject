<?php
$db = new mysqli('127.0.0.1', 'root', '', 'socialnetwork');
if($db->connect_errno) {
	echo $db->connect_errno;
}