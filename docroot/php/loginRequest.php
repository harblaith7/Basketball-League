<?php 
include "connect.php";
include "functions.php";
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0 ){
	$email = mysqli_real_escape_string($connect, $data->email);
	$password = mysqli_real_escape_string($connect, $data->password);
	echo loginRequest($email, $password);
}
//	echo password_hash("", PASSWORD_DEFAULT);