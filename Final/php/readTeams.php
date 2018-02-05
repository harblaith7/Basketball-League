<?php 
include "connect.php";
include "functions.php";
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0){
	$output = array();
	$sql  = "SELECT * FROM teams";
	$result = mysqli_query($connect, $sql);
	while($team = mysqli_fetch_array($result)){	
		$team_id = $team['team_id'];
		$sql2 = "SELECT * FROM team_player WHERE team_id = '$team_id'";
		$result2 = mysqli_query($connect, $sql2);
		$team['team_count'] = mysqli_num_rows($result2);
		if ($team['team_count'] == null){
			$team['team_count'] = "0";
		}
		$output[] = $team;
	}
	echo json_encode($output);
}
?>