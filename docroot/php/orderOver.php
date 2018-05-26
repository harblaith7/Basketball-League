<?php
session_start();
include "functions.php";

if(isset($_GET['cancel'])){
  if(adminDeleteUnpaid($_SESSION['record_id']) === "success"){
    session_destroy();
    header('Location: ../teams.php');
  }
}

if($_SESSION['action'] === "createTeam"){
  $record = getRecord();
  $first_name = $record['first_name'];
  $last_name = $record['last_name'];
  $address = $record['address'];
  $phone_number = $record['phone_number'];
  $team_name = $record['team_name'];
  $email = $record['email'];
  $player_number = $record['player_number'];
  $team_id = createTeamFromUnpaid($team_name);
  if(adminCreatePlayer($first_name, $last_name, $email, $address, $phone_number, $team_id, $player_number) === "success"){
    if(adminPaidUnpaid($_SESSION['record_id']) === "success"){
      session_destroy();
      header('Location: ../teams.php');
    }
  }
} else {
  $record = getRecord();
  $first_name = $record['first_name'];
  $last_name = $record['last_name'];
  $address = $record['address'];
  $phone_number = $record['phone_number'];
  $team_name = $record['team_name'];
  $email = $record['email'];
  $player_number = $record['player_number'];
  $team_id = $record['team_id'];

  if(adminCreatePlayer($first_name, $last_name, $email, $address, $phone_number, $team_id, $player_number) === "success"){
    if(adminPaidUnpaid($_SESSION['record_id']) === "success"){
      session_destroy();
      header('Location: ../teams.php');
    }
  }
}
