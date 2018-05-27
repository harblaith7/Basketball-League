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
	$output = [];
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

			if($team_id !== null || $row['played'] !== "N"){
				if($team_id === $winner){
					$row['result'] = 'W';
				} else {
					$row['result'] = 'L';
				}
			}

			if($row['played'] === "N"){
				$row['result'] = 'TBD';
			}
			$output[] = $row;
		}
		return $output;
	}
}

function fetchPlayerStats($team_id){
	global $connect;
	$players = fetchPlayers($team_id);
	$output = [];
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
	$output = [];
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

function adminCreateTeam($team_name){
	global $connect;
	if(!uniqueTeamName($team_name)){
		return "The team name you chose has been taken";
	}
	$sql = "INSERT INTO teams(team_name) VALUES('$team_name')";
	if(mysqli_query($connect, $sql)){
		return "success";
	}
}

function adminUpdateTeam($team_id, $team_name) {
	global $connect;
	if(!uniqueTeamName($team_name)){
		return "The team name you chose has been taken";
	}
	$sql = "UPDATE teams SET team_name = '$team_name' WHERE team_id = '$team_id'";
	if(mysqli_query($connect, $sql)){
		return "success";
	}
}

function adminDeleteTeam($team_id){
	global $connect;
	$sql = "DELETE FROM teams WHERE team_id = '$team_id'";
	if(mysqli_query($connect, $sql)){
		return adminDeleteTeamPlayerConnection($team_id);
	}
}

function adminDeleteTeamPlayerConnection($team_id){
	global $connect;
	$sql = "DELETE FROM team_player WHERE team_id = '$team_id'";
	if(mysqli_query($connect, $sql)){
		return "success";
	}
}

function adminCreateSchedule($team1, $team2, $team1Result, $team2Result, $scheduleDate, $scheduleTime, $scheduleLocation){
	global $connect;
	if($scheduleDate == null){
		$scheduleDate = "TBD";
	}
	if(is_numeric($team1Result) && is_numeric($team2Result)){
		$played = "Y";
		if($team1Result > $team2Result){
			$winner_id = $team1;
		} else {
			$winner_id = $team2;
		}
	} else {
		$team1Result = "TBD";
		$team2Result = "TBD";
		$played = "N";
		$winner_id = "TBD";
	}
	if($scheduleTime == null){
		$scheduleTime = "TBD";
	}
	if($scheduleLocation == null){
		$scheduleLocation = "TBD";
	}
	$sql = "INSERT INTO schedule(team1_id, team2_id, date, game_start, location, team1_result, team2_result, winner_id, played) VALUES('$team1', '$team2', '$scheduleDate', '$scheduleTime', '$scheduleLocation', '$team1Result', '$team2Result', '$winner_id', '$played')";
	if(mysqli_query($connect, $sql)){
		return "success";
	}
}

function adminUpdateSchedule($game_id, $team1, $team2, $team1Result, $team2Result, $scheduleDate, $scheduleTime, $scheduleLocation) {
	global $connect;
	if($scheduleDate == null){
		$scheduleDate = "TBD";
	}
	if(is_numeric($team1Result) && is_numeric($team2Result)){
		$played = "Y";
		if($team1Result > $team2Result){
			$winner_id = $team1;
		} else {
			$winner_id = $team2;
		}
	} else {
		$team1Result = "TBD";
		$team2Result = "TBD";
		$played = "N";
		$winner_id = null;
	}
	if($scheduleTime == null){
		$scheduleTime = "TBD";
	}
	if($scheduleLocation == null){
		$scheduleLocation = "TBD";
	}
	$sql = "UPDATE schedule SET team1_id = '$team1', team2_id = '$team2', date = '$scheduleDate', game_start = '$scheduleTime', location = '$scheduleLocation', team1_result = '$team1Result', team2_result = '$team2Result', winner_id = '$winner_id', played = '$played' WHERE game_id = '$game_id'";
	if(mysqli_query($connect, $sql)){
		return "success";
	}
}

function adminDeleteSchedule($game_id){
	global $connect;
	$sql = "DELETE FROM schedule WHERE game_id = '$game_id'";
	if(mysqli_query($connect, $sql)){
		return "success";
	}
}

function adminCreatePlayer($player_first_name, $player_last_name, $email, $address, $phone_number, $team_id, $player_number) {
	global $connect;
	if(!isset($_SESSION['record_id'])){
		if(!uniquePlayerNumber($team_id, $player_number)){
			return "The player number you chose has been taken";
		}
	}
	$sql = "INSERT INTO players(first_name, last_name, email, address, phone_number) VALUES('$player_first_name', '$player_last_name', '$email', '$address', '$phone_number')";
	if(mysqli_query($connect, $sql)){
		$player_id = mysqli_insert_id($connect);
		return createTeamPlayerConnection(mysqli_insert_id($connect), $player_number, $team_id);
	}
}

function uniquePlayerNumber($team_id, $player_number){
	global $connect;
	$sql = "SELECT player_number FROM team_player WHERE team_id = '$team_id' AND player_number = '$player_number' UNION ALL SELECT player_number FROM unpaid_memberships WHERE team_id = '$team_id' AND player_number = '$player_number'";
	$count = mysqli_num_rows(mysqli_query($connect, $sql));
	if($count > 0){
		return false;
	} else {
		return true;
	}
}

function uniqueTeamName($team_name){
	global $connect;
	$sql = "SELECT team_name FROM teams WHERE team_name = '$team_name' UNION ALL SELECT team_name FROM unpaid_memberships WHERE team_name = '$team_name'";
	$result = mysqli_query($connect, $sql);
	$count = mysqli_num_rows($result);
	if($count > 0){
		return false;
	} else {
		return true;
	}
}

function createTeamPlayerConnection($player_id, $player_number, $team_id){
	global $connect;
	$sql = "INSERT INTO team_player(player_id, team_id, player_number) VALUES('$player_id', '$team_id', '$player_number')";
	if(mysqli_query($connect, $sql)){
		return "success";
	}
}

function adminReadPlayers(){
	global $connect;
	$sql = "SELECT * FROM players";
	$result = mysqli_query($connect, $sql);
	$output = [];
	while($row = mysqli_fetch_array($result)){
		$row['team_id'] = fetchPlayerTeam($row['player_id'])['team_id'];
		$row['player_number'] = fetchPlayerTeam($row['player_id'])['player_number'];
		$row['team_name'] = fetchPlayerTeamName($row['team_id'])['team_name'];
		$output[] = $row;
	}
	return $output;
}

function fetchPlayerTeam($player_id){
	global $connect;
	$sql = "SELECT team_id, player_number FROM team_player WHERE player_id = '$player_id'";
	$result = mysqli_query($connect, $sql);
	return mysqli_fetch_array($result);
}

function fetchPlayerTeamName($team_id){
	global $connect;
	$sql = "SELECT team_name FROM teams WHERE team_id = '$team_id'";
	$result = mysqli_query($connect, $sql);
	return mysqli_fetch_array($result);
}

function adminUpdatePlayer($player_id, $player_first_name, $player_last_name, $email, $address, $phone_number, $team_id, $player_number){
	global $connect;
	$sql = "UPDATE players SET first_name = '$player_first_name', last_name = '$player_last_name', email = '$email', address = '$address', phone_number = '$phone_number' WHERE player_id = '$player_id'";
	if(mysqli_query($connect, $sql)){
		return changePlayerTeam($player_id, $team_id, $player_number);
	}
}

function changePlayerTeam($player_id, $team_id, $player_number){
	global $connect;
	$sql = "UPDATE team_player SET team_id = '$team_id', player_number = '$player_number' WHERE player_id = '$player_id'";
	if(mysqli_query($connect, $sql)){
		return "success";
	}
}

function adminDeletePlayer($player_id){
	global $connect;
	$sql = "DELETE FROM players WHERE player_id = '$player_id'";
	if(mysqli_query($connect, $sql)){
		return "success";
	}
}

function adminCreateStat($game_id, $player_id, $points, $assists, $rebounds, $blocks, $turnovers){
	global $connect;
	$sql = "INSERT INTO player_stats(player_id, game_id, points, assists, rebounds, blocks, turn_overs) VALUES( '$player_id', '$game_id', '$points', '$assists', '$rebounds', '$blocks', '$turnovers')";
	if(mysqli_query($connect, $sql)){
		return "success";
	}
}

function createUnpaidOrder($action, $first_name, $last_name, $address, $phone_number, $team_id, $team_name, $email, $player_number){
	global $connect, $timestamp;
	if($action === "createTeam"){
		if(!uniqueTeamName($team_name)){
			return "The team name you chose has been taken";
		}
		$sql = "INSERT INTO unpaid_memberships(first_name, last_name, address, email, phone_number, team_name, order_type, timestamp, player_number) VALUES('$first_name', '$last_name', '$address', '$email', '$phone_number', '$team_name', '$action', '$timestamp', '$player_number')";
		if(mysqli_query($connect, $sql)){
			$_SESSION['record_id'] = mysqli_insert_id($connect);
			echo "success";
		}
	} else {
		if(!uniquePlayerNumber($team_id, $player_number)){
			return "The player number you chose has been taken";
		}
		$sql = "INSERT INTO unpaid_memberships(first_name, last_name, address, email, phone_number, team_id, order_type, player_number) VALUES('$first_name', '$last_name', '$address', '$email', '$phone_number', '$team_id', '$action', '$player_number')";
		if(mysqli_query($connect, $sql)){
			$_SESSION['record_id'] = mysqli_insert_id($connect);
			echo "success";
		}
	}
}

function adminReadUnpaid() {
	global $connect;
	$sql = "SELECT * FROM unpaid_memberships";
	$result = mysqli_query($connect, $sql);
	$output = [];
	while($row =  mysqli_fetch_array($result)){
		if($row['order_type'] === "joinTeam"){
			$row['team_name'] = fetchPlayerTeamName($row['team_id'])['team_name'];
		}
		$output[] = $row;
	}
	return $output;
}

function adminDeleteUnpaid($record_id){
	global $connect;
	$sql = "DELETE FROM unpaid_memberships WHERE record_id = '$record_id' AND paid = 'false'";
	if(mysqli_query($connect, $sql)){
		return "success";
	}
}

function createTeamFromUnpaid($team_name){
	global $connect;
	$sql = "INSERT INTO teams(team_name) VALUES('$team_name')";
	if(mysqli_query($connect, $sql)){
		return mysqli_insert_id($connect);
	}
}

function adminPaidUnpaid($record_id){
  global $connect;
  $sql = "UPDATE unpaid_memberships SET paid = 'true' WHERE record_id = '$record_id'";
  if(mysqli_query($connect, $sql)){
    return "success";
  }
}

function getRecord($record_id){
  global $connect;
  $sql = "SELECT * FROM unpaid_memberships WHERE record_id = '$record_id'";
  $result = mysqli_query($connect, $sql);
  return mysqli_fetch_array($result);
}

function processUnpaid($record_id){
	$record = getRecord($record_id);
	$first_name = $record['first_name'];
	$last_name = $record['last_name'];
	$address = $record['address'];
	$phone_number = $record['phone_number'];
	$team_name = $record['team_name'];
	$email = $record['email'];
	$player_number = $record['player_number'];

	if($record['order_type'] === "createTeam"){
	  $team_id = createTeamFromUnpaid($team_name);
	  if(adminCreatePlayer($first_name, $last_name, $email, $address, $phone_number, $team_id, $player_number) === "success"){
	    if(adminPaidUnpaid($record['record_id']) === "success"){
				if(isset($_SESSION['record_id']) || !isset($_SESSION['admin_id'])){
					unset($_SESSION['record_id']);
		      header('Location: ../teams.php');
				}
	    }
	  }
	} else {
	  $team_id = $record['team_id'];
	  if(adminCreatePlayer($first_name, $last_name, $email, $address, $phone_number, $team_id, $player_number) === "success"){
	    if(adminPaidUnpaid($record['record_id']) === "success"){
				if(isset($_SESSION['record_id']) || !isset($_SESSION['admin_id'])){
					unset($_SESSION['record_id']);
		      header('Location: ../teams.php');
				}
	    }
	  }
	}
}

?>
