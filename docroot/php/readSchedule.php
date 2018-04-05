<?php 
include "connect.php";
include "functions.php";
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
	if(empty($data->team_id)) {
		$team_id = null;
	} else {
		$team_id = mysqli_real_escape_string($connect, $data->team_id);
	}
	echo json_encode(fetchSchedule($team_id));
}
?>