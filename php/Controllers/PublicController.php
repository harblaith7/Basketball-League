<?php

class PublicController
{
  public static function readTeams(){
  	if(empty($_POST['team_id'])){
  		$team_id = null;
  	} else {
  		$team_id = $_POST['team_id'];
  	}
  	return Functions::fetchTeamInfo($team_id);
  }

  public static function readSchedule(){
  	if(empty($_POST['team_id'])){
  		$team_id = null;
  	} else {
  		$team_id = $_POST['team_id'];
  	}
  	return Functions::fetchSchedule($team_id);
  }

  public static function readPlayerStats(){
  	$team_id = $_POST['team_id'];
  	return Functions::fetchPlayerStats($team_id);
  }

  public static function loginRequest(){
  	$email = $_POST['email'];
  	$password = $_POST['password'];
  	return Functions::loginRequest($email, $password);
  }

  public static function logout(){
  	session_destroy();
  	$home_url = '../login.php';
  	header('Location: ' . $home_url);
  }

  public static function createTeam(){
  	$action = "createTeam";
  	$first_name = $_POST['first_name'];
  	$last_name = $_POST['last_name'];
  	$address = $_POST['address'];
  	$phone_number = $_POST['phone_number'];
  	$team_id = $_POST['team_id'];
  	$team_name = $_POST['team_name'];
  	$email = $_POST['email'];
  	$player_number = $_POST['player_number'];

  	if (Functions::team_leader_check($email) && Functions::team_name_check($team_name)){
  		return Functions::createUnpaidOrder($action, $first_name, $last_name, $address, $phone_number, $team_id, $team_name, $email, $player_number);
  	} else {
  		return Functions::team_leader_check($email);
  		return Functions::team_name_check($team_name);
  	}
  }

  public static function joinTeam(){
  	$action = "joinTeam";
  	$first_name = $_POST['first_name'];
  	$last_name = $_POST['last_name'];
  	$address = $_POST['address'];
  	$phone_number = $_POST['phone_number'];
  	$team_id = $_POST['team_id'];
  	$team_name = $_POST['team_name'];
  	$email = $_POST['email'];
  	$player_number = $_POST['player_number'];

  	if (Functions::team_leader_check($email) && Functions::team_name_check($team_name)){
  		return Functions::createUnpaidOrder($action, $first_name, $last_name, $address, $phone_number, $team_id, $team_name, $email, $player_number);
  	} else {
  		return Functions::team_leader_check($email);
  		return Functions::team_name_check($team_name);
  	}
  }
}
