<?php
class AdminController
{
  public static function adminCreateEditTeam(){
    $team_name = $_POST['team_name'];
    if($_POST['form_button'] === "Edit") {
      $team_id = $_POST['team_id'];
      return Functions::adminUpdateTeam($team_id, $team_name);
    } else {
      return Functions::adminCreateTeam($team_name);
    }
  }

  public static function adminDeleteTeam(){
    $team_id = $_POST['team_id'];
    return Functions::adminDeleteTeam($team_id);
  }

  public static function adminAddEditSchedule(){
    $action = $_POST['action'];
    $team1 = $_POST['team1'];
    $team2 = $_POST['team2'];
    $team1Result = $_POST['team1Result'];
    $team2Result = $_POST['team2Result'];
    $scheduleDate = $_POST['scheduleDate'];
    $scheduleTime = $_POST['scheduleTime'];
    $scheduleLocation = $_POST['scheduleLocation'];
    if($action === "Edit"){
      $game_id = $_POST['game_id'];
      return Functions::adminUpdateSchedule($game_id, $team1, $team2, $team1Result, $team2Result, $scheduleDate, $scheduleTime, $scheduleLocation);
    } else {
      return Functions::adminCreateSchedule($team1, $team2, $team1Result, $team2Result, $scheduleDate, $scheduleTime, $scheduleLocation);
    }
  }

  public static function adminDeleteSchedule(){
    $game_id = $_POST['game_id'];
    return Functions::adminDeleteSchedule($game_id);
  }

  public static function adminReadPlayers(){
    return Functions::adminReadPlayers();
  }

  public static function adminCreateEditPlayer(){
    $action = $_POST['action'];
    $player_first_name = $_POST['first_name'];
    $player_last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $team_id = $_POST['team_id'];
    $player_number = $_POST['player_number'];
    if($action === "Edit"){
      $player_id = $_POST['player_id'];
      return Functions::adminUpdatePlayer($player_id, $player_first_name, $player_last_name, $email, $address, $phone_number, $team_id, $player_number);
    } else {
      return Functions::adminCreatePlayer($player_first_name, $player_last_name, $email, $address, $phone_number, $team_id, $player_number);
    }
  }

  public static function adminDeletePlayer(){
    $player_id = $_POST['player_id'];
    return Functions::adminDeletePlayer($player_id);
  }

  public static function adminCreateStat(){
    $game_id = $_POST['game_id'];
    $player_id = $_POST['player_id'];
    $points = $_POST['points'];
    $assists = $_POST['assists'];
    $rebounds = $_POST['rebounds'];
    $blocks = $_POST['blocks'];
    $turnovers = $_POST['turnovers'];
    return Functions::adminCreateStat($game_id, $player_id, $points, $assists, $rebounds, $blocks, $turnovers);
  }

  public static function adminReadUnpaid(){
    return Functions::adminReadUnpaid();
  }

  public static function adminDeleteUnpaid(){
    $record_id = $_POST['record_id'];
    return Functions::adminDeleteUnpaid($record_id);
  }

  public static function adminPaidUnpaid(){
    $record_id = $_POST['record_id'];
    return processUnpaid($record_id);
  }
}
