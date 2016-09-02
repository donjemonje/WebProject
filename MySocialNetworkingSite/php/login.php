<?php
error_reporting(0);
require 'db/connect.php';

$result = $db->query("SELECT * FROM user");
print_r($result);
