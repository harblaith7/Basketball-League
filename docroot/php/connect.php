<?php 
$connect = mysqli_connect("localhost", "root", "", "anklebreaker");
date_default_timezone_set('US/Eastern');
$date = date("Y-m-d", strtotime("now"));
$time = date("H:i:s", strtotime("now"));
$timestamp = $date . 'T' . $time . '-04:00';
include "Mail.php";
$from = "Anklebreaker <contact@anklebreaker.ca>";
$host = "ssl://anklebreaker.ca";
$port = "465";
$username = "contact@anklebreaker.ca";
$password = "kBeD3s;Z&gVU";
$creds = [
	'host' => $host,
	'port' => $port,
	'auth' => true,
	'username' => $username,
	'password' => $password
];
$smtp = Mail::factory('smtp', $creds);
?>