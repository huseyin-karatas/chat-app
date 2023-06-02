<?php 
include('connect.php');

session_start();

$ekle = 

$query = "UPDATE user_details SET last_activity = now() WHERE user_id = '".$_SESSION['user_id']."' ";

$statement = $baglan->prepare($query);
$statement->execute();


?>