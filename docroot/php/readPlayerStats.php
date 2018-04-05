<?php
include 'connect.php';
include 'functions.php';
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
	$team_id = mysqli_real_escape_string($connect, $data->team_id);
	error_log(print_r(fetchPlayerStats($team_id), true));
	echo json_encode(fetchPlayerStats($team_id));
}
?>