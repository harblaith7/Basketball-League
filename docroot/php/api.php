<?php 
include "functions.php";
$route = $_GET['route'];
$data = json_decode(file_get_contents("php://input"));

if($route === "readTeams"){
	if(empty($data->team_id)){
		$team_id = null;
	} else {
		$team_id = mysqli_real_escape_string($connect, $data->team_id);
	}
	echo json_encode(fetchTeamInfo($team_id));
}

if($route === "readSchedule"){
	if(empty($data->team_id)) {
		$team_id = null;
	} else {
		$team_id = mysqli_real_escape_string($connect, $data->team_id);
	}
	echo json_encode(fetchSchedule($team_id));
}

if($route === "readPlayerStats"){
	$team_id = mysqli_real_escape_string($connect, $data->team_id);
	echo json_encode(fetchPlayerStats($team_id));
}

if($route === "loginRequest"){
	$email = mysqli_real_escape_string($connect, $data->email);
	$password = mysqli_real_escape_string($connect, $data->password);
	echo loginRequest($email, $password);
}

if($route === "logout"){
	session_start();
	session_destroy();
	$home_url = '../login.php';
	header('Location: ' . $home_url);
}

if($route === "createTeam"){
	$team_name = mysqli_real_escape_string($connect, $data->team_name);
	$email = mysqli_real_escape_string($connect, $data->email);
	if (team_leader_check($email) && team_name_check($team_name)){
		echo "success";
	} else {
		echo team_leader_check($email);
		echo team_name_check($team_name);
	}
}