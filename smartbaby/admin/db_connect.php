<?php 	

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "vaccination";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
date_default_timezone_set('Africa/Harare');
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>