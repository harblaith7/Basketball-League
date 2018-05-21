<?php
include "functions.php";
$route = $_GET['route'];
$data = json_decode(file_get_contents("php://input"));

if(!$route) {
	echo "no route defined";
}

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

session_start();
if(isset($_SESSION['admin_id'])){

	if($route === "adminCreateEditTeam"){
		$team_name = mysqli_real_escape_string($connect, $data->team_name);
		if($data->form_button === "Edit") {
			$team_id = mysqli_real_escape_string($connect, $data->team_id);
			echo adminUpdateTeam($team_id, $team_name);
		} else {
			echo adminCreateTeam($team_name);
		}
	}

	if($route === "adminDeleteTeam"){
		$team_id = mysqli_real_escape_string($connect, $data->team_id);
		echo adminDeleteTeam($team_id);
	}

	if($route === "adminAddEditSchedule"){
		$action = mysqli_real_escape_string($connect, $data->action);
		$team1 = mysqli_real_escape_string($connect, $data->team1);
		$team2 = mysqli_real_escape_string($connect, $data->team2);
		$team1Result = mysqli_real_escape_string($connect, $data->team1Result);
		$team2Result = mysqli_real_escape_string($connect, $data->team2Result);
		$scheduleDate = mysqli_real_escape_string($connect, $data->scheduleDate);
		$scheduleTime = mysqli_real_escape_string($connect, $data->scheduleTime);
		$scheduleLocation = mysqli_real_escape_string($connect, $data->scheduleLocation);

		if($action === "Edit"){
			$game_id = mysqli_real_escape_string($connect, $data->game_id);
			echo adminUpdateSchedule($game_id, $team1, $team2, $team1Result, $team2Result, $scheduleDate, $scheduleTime, $scheduleLocation);
		} else {
			echo adminCreateSchedule($team1, $team2, $team1Result, $team2Result, $scheduleDate, $scheduleTime, $scheduleLocation);
		}
	}
	if($route === "adminDeleteSchedule"){
		$game_id = mysqli_real_escape_string($connect, $data->game_id);
		echo adminDeleteSchedule($game_id);
	}

	if($route === "adminReadPlayers"){
		echo json_encode(adminReadPlayers());
	}

	if($route === "adminCreateEditPlayer"){
		$action = mysqli_real_escape_string($connect, $data->action);
		$player_first_name = mysqli_real_escape_string($connect, $data->first_name);
		$player_last_name = mysqli_real_escape_string($connect, $data->last_name);
		$email = mysqli_real_escape_string($connect, $data->email);
		$address = mysqli_real_escape_string($connect, $data->address);
		$phone_number = mysqli_real_escape_string($connect, $data->phone_number);
		$team_id = mysqli_real_escape_string($connect, $data->team_id);
		$player_number = mysqli_real_escape_string($connect, $data->player_number);
		$player_id = mysqli_real_escape_string($connect, $data->player_id);
		if($action === "Edit"){
			echo adminUpdatePlayer($player_id, $player_first_name, $player_last_name, $email, $address, $phone_number, $team_id, $player_number);
		} else {
			echo adminCreatePlayer($player_first_name, $player_last_name, $email, $address, $phone_number, $team_id, $player_number);
		}
	}

	if($route === "adminDeletePlayer"){
		$player_id = mysqli_real_escape_string($connect, $data->player_id);
		echo adminDeletePlayer($player_id);
	}

	if($route === "adminCreateStat"){
		$game_id = mysqli_real_escape_string($connect, $data->game_id);
		$player_id = mysqli_real_escape_string($connect, $data->player_id);
		$points = mysqli_real_escape_string($connect, $data->points);
		$assists = mysqli_real_escape_string($connect, $data->assists);
		$rebounds = mysqli_real_escape_string($connect, $data->rebounds);
		$blocks = mysqli_real_escape_string($connect, $data->blocks);
		$turnovers = mysqli_real_escape_string($connect, $data->turnovers);
		echo adminCreateStat($game_id, $player_id, $points, $assists, $rebounds, $blocks, $turnovers);
	}
}
