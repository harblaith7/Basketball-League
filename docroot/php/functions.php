<?php 
$connect = mysqli_connect("localhost", "root", "", "anklebreaker");
date_default_timezone_set('US/Eastern');
$date = date("Y-m-d", strtotime("now"));
$time = date("H:i:s", strtotime("now"));
$timestamp = $date . 'T' . $time . '-04:00';

// Checks if team leader is not in another team
function team_leader_check($email){
	global $connect;
	$sql = "SELECT * FROM players WHERE email = '$email'";
	$result = mysqli_query($connect, $sql);		
	$count = mysqli_num_rows($result);
	if ($count > "0"){
		return "A team leader cannot be in multiple teams";
		} else {
		return true;
	}
}
// Checks if team name is unique
function team_name_check($team_name){
	global $connect;
	$sql = "SELECT * FROM teams WHERE team_name = '$team_name'";	
	$result = mysqli_query($connect, $sql);
	$count = mysqli_num_rows($result);
	if ($count > "0"){
		return "Team name must be unique, check the teams page to see taken names. <a href='teams.php'>Click here.</a>";
	} else {
	return true;
	}
}

function fetchTeamInfo($team_id) {
	if($team_id === null){
		$sql = "SELECT * FROM teams";
	} else {
		$sql = "SELECT * FROM teams WHERE team_id = '$team_id'";
	}
	global $connect;
	$result = mysqli_query($connect, $sql);
	while($team = mysqli_fetch_array($result)){	
		$team_id = $team['team_id'];
		$sql2 = "SELECT * FROM team_player WHERE team_id = '$team_id'";
		$result2 = mysqli_query($connect, $sql2);
		$team['team_count'] = mysqli_num_rows($result2);
		if ($team['team_count'] == null){
			$team['team_count'] = "0";
		}
		$sql3 = "SELECT * FROM schedule WHERE winner_id = '$team_id'";
		$res3 = mysqli_query($connect, $sql3);
		$team['wins'] = mysqli_num_rows($res3);
		
		$sql4 = "SELECT * FROM schedule WHERE played = 'Y' AND winner_id <> '$team_id' AND team1_id = '$team_id' UNION SELECT * FROM schedule WHERE played = 'Y' AND winner_id <> '$team_id' AND team2_id = '$team_id'";
		$res4 = mysqli_query($connect, $sql4);
		$team['loses'] = mysqli_num_rows($res4);
		$team['standing'] = $team['wins'] - $team['loses'];
		$output[] = $team;
	}
	return $output;
}

function fetchSchedule($team_id) {
	if($team_id === null){
		$sql = "SELECT * FROM schedule";
	} else {
		$sql = "SELECT * FROM schedule WHERE team1_id = '$team_id' OR team2_id = '$team_id'";
	}
	global $connect;
	$result = mysqli_query($connect, $sql);
	$count = mysqli_num_rows($result);
	if($count > 0){
		$output = [];
		while($row = mysqli_fetch_array($result)){
			$team1 = $row['team1_id'];
			$team2 = $row['team2_id'];
			
			$sql2 = "SELECT team_name FROM teams WHERE team_id = '$team1'";
			$res2 = mysqli_query($connect, $sql2);
			$row2 = mysqli_fetch_array($res2);
			$row['team1_name'] = $row2['team_name'];
			
			$sql3 = "SELECT team_name FROM teams WHERE team_id = '$team2'";
			$res3 = mysqli_query($connect, $sql3);
			$row3 = mysqli_fetch_array($res3);
			$row['team2_name'] = $row3['team_name'];
			
			$winner = $row['winner_id'];
			if ($winner !== "TBD"){
				$sql4 = "SELECT team_name FROM teams WHERE team_id = '$winner'";
				$res4 = mysqli_query($connect, $sql4);
				$row4 = mysqli_fetch_array($res4);
				$row['winner_name'] = $row4['team_name'];
			} else {
				$row['winner_name'] = 'TBD';
			}
			
			if($team_id !== null){
				if($team_id === $winner){
					$row['result'] = 'W';
				} else {
					$row['result'] = 'L';
				}
			}
			$output[] = $row;
		}
		return $output;
	}
}

function fetchPlayerStats($team_id){
	global $connect;
	$players = fetchPlayers($team_id);
	foreach($players as $player){
		$player_id = $player['player_id'];
		$sql = "SELECT AVG(points) AS ppg, AVG(assists) AS apg, AVG(rebounds) AS rpg, AVG(blocks) AS bpg, AVG(turn_overs) AS topg, player_id FROM player_stats WHERE player_id = '$player_id'";
		$result = mysqli_query($connect, $sql);
		while($row = mysqli_fetch_array($result)){
			$row['player_name'] = $player['player_name'];
			$row['player_number'] = $player['player_number'];
			$output[] = $row;
		}
	}
	return $output;
}

function fetchPlayers($team_id){
	$sql = "SELECT player_id, player_number FROM team_player WHERE team_id = '$team_id'";
	global $connect;
	$result = mysqli_query($connect, $sql);
	while($row = mysqli_fetch_array($result)){
		$player_id = $row['player_id'];
		$sql2 = "SELECT first_name, last_name FROM players WHERE player_id = '$player_id'";
		$result2 = mysqli_query($connect, $sql2);
		$row2 = mysqli_fetch_array($result2);
		$row['player_name'] = $row2['first_name'].' '.$row2['last_name'];
		$output[] = $row;
	}
	return $output;
}

function loginRequest($email, $password){
	global $connect;
	$sql = "SELECT admin_id, admin_name, password FROM admin_users WHERE admin_email = '$email'";
	$result = mysqli_query($connect, $sql);
	if(mysqli_num_rows($result) === 1){
		$row = mysqli_fetch_array($result);
		$passwordVerify = password_verify($password, $row['password']);
		if($passwordVerify){
			session_start();
			$_SESSION['admin_id'] = $row['admin_id'];
			$_SESSION['admin_name'] = $row['admin_name'];
			$_SESSION['admin_email'] = $email;
			return "success";
		} else {
			return "Password is incorrect";
		}
	} else {
		return "Email is in correct";
	}	
}

?>
