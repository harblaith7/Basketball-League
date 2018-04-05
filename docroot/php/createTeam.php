<?php 
include "connect.php";
include "functions.php";
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0){
	$team_name = mysqli_real_escape_string($connect, $data->team_name);
	$email = mysqli_real_escape_string($connect, $data->email);
	
	// Checks if team leader is not in another team
	function team_leader_check(){
		global $connect, $email;
		$sql = "SELECT * FROM players WHERE email = '$email'";
		$result = mysqli_query($connect, $sql);		
		$count = mysqli_num_rows($result);
		if ($count > "0"){
			echo "A team leader cannot be in multiple teams";
			return;
		} else {
			return true;
		}
	}
	// Checks if team name is unique
	function team_name_check(){
		global $connect, $team_name;
		$sql = "SELECT * FROM teams WHERE team_name = '$team_name'";	$result = mysqli_query($connect, $sql);
		$count = mysqli_num_rows($result);
		if ($count > "0"){
			echo "Team name must be unique, check the teams page to see taken names. <a href='teams.php'>Click here.</a>";
			return;
		} else {
		return true;
		}
	}
	if (team_leader_check() && team_name_check()){
		echo "success";
	}
}	
?>