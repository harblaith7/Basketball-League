var app = angular.module('leagueApp', ['ngSanitize']);
app.controller('leagueController', function($scope, $http) {
  $scope.apiRoot = "php/api.php?route=";

  $scope.contactFrom = function() {
    var name = document.getElementById("contactName").value;
    var email = document.getElementById("contactEmail").value;
    var message = document.getElementById("contactMessage").value;
    if (name == "") {
      alert("Name cannot be empty");
      return;
    }
    if (email == "") {
      alert("Email cannot be empty");
      return;
    }
    if (message == "") {
      alert("message cannot be empty");
      return;
    }
    $http.post("php/contactForm.php", {
      name: name,
      email: email,
      message: message
    }).success(function(data) {
      if (data == "success") {
        document.getElementById("contactName").value = null;
        document.getElementById("contactEmail").value = null;
        document.getElementById("contactMessage").value = null;
        return;
      } else {
        alert(data);
        return;
      }
    });
  }
  $scope.packageSelect = function(package) {
    document.getElementById("package").value = package;
  }
  $scope.teamRegistration = function() {
    var package = document.getElementById("package").value;
    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var address = document.getElementById("address").value;
    var email = document.getElementById("email").value;
    var phoneNumber = document.getElementById("phoneNumber").value;
    var teamName = document.getElementById("teamName").value;
    if (package !== "single player" & package !== "group" & package !== "business") {
      errorReporting("error");
      return;
    }

    function errorReporting(error) {
      $("#registerError").removeClass("hidden");
      document.getElementById("registerError").innerHTML = error;
    }
    if (firstName == "") {
      errorReporting("First name cannot be empty");
      return;
    }
    if (lastName == "") {
      errorReporting("Last name cannot be empty");
      return;
    }
    if (address == "") {
      errorReporting("Address cannot be empty");
      return;
    }
    if (email == "") {
      errorReporting("Email cannot be empty");
      return;
    }
    if (phoneNumber.length < 10 || phoneNumber.length > 12) {
      errorReporting("Please provide your 10 digit phone number");
      return;
    }
    if (teamName == "") {
      errorReporting("Team name cannot be empty");
      return;
    } else if (teamName.length > 20) {
      errorReporting("Team name cannot be longer than 20 characters");
      return;
    }
    $http.post($scope.apiRoot + "createTeam", {
      package: package,
      first_name: firstName,
      last_name: lastName,
      address: address,
      email: email,
      phone_numer: phoneNumber,
      team_name: teamName
    }).success(function(data) {
      if (data == "success") {
        $("#registerError").addClass("hidden");
        return;
      } else {
        errorReporting(data);
        return;
      }
    });
  }

  $scope.getTeams = function(team_id) {
    $http.post($scope.apiRoot + "readTeams", {
      type: "request",
      team_id: team_id
    }).success(function(data) {
      $scope.teams = data;
    });
  }

  $scope.teamSelect = function(team_id, index) {
    window.open('team.php?id=' + team_id + '&standing=' + index, "_self");
  }

  $scope.getSchedule = function(team_id) {
    $http.post($scope.apiRoot + "readSchedule", {
      type: "request",
      team_id: team_id
    }).success(function(data) {
      $scope.schedule = data;
    });
  }

  $scope.getStats = function(team_id) {
    $http.post($scope.apiRoot + "readPlayerStats", {
      type: 'request',
      team_id: team_id
    }).success(function(data) {
      $scope.stats = data;
    });
  }

  $scope.login = function() {
    var loginEmail = document.getElementById("loginEmail").value;
    var loginPassword = document.getElementById("loginPassword").value;
    $http.post($scope.apiRoot + "loginRequest", {
      email: loginEmail,
      password: loginPassword
    }).success(function(data) {
      window.open("dashboard.php", "_self");
      document.getElementById("loginResponse").innerHTML = data;
    });
  }

	$scope.adminTeamBtn = "Create Team";
  $scope.adminAddTeam = function() {
    var teamName = document.getElementById("teamName").value;
    if(teamName.length === 0){
      return;
    }
    $http.post($scope.apiRoot + "adminCreateEditTeam", {
      form_button: $scope.adminTeamBtn,
      team_id: $scope.adminEditTeamId,
      team_name: teamName
    }).success(function(data){
      if (data === "success") {
        $scope.getTeams();
        $scope.adminTeamBtn = "Create Team";
        document.getElementById("teamCreate").reset();
      }
    })
  }

  $scope.adminEditTeam = function(team_id, team_name) {
    $scope.adminTeamBtn = "Edit";
    $scope.adminEditTeamId = team_id;
    document.getElementById("teamName").value = team_name;
  }

  $scope.adminDeleteTeam = function(team_id) {
    if(!confirm("Are you sure you want to delete this team? It cannot be restored, and players connected to this team will lose their connection.")) {
      return;
    }
    $http.post($scope.apiRoot + "adminDeleteTeam", {
      team_id: team_id
    }).success(function(data){
      if(data === "success") {
        $scope.getTeams();
      }
    })
  }

  $scope.scheduleTeamSelect = function() {
    var team1 =  document.getElementById("team1").value;
    var team2 =  document.getElementById("team2").value;
    if(team1 === team2){
      document.getElementById("team2").value = null;
    }
  }

  $scope.adminScheduleBtn = "Add";
  $scope.adminAddEditSchedule = function(){
    var team1 = document.getElementById("team1").value;
    var team2 = document.getElementById("team2").value;
    var team1Result = document.getElementById("team1Result").value;
    var team2Result = document.getElementById("team2Result").value;
    var scheduleDate = document.getElementById("scheduleDate").value;
    var scheduleTime = document.getElementById("scheduleTime").value;
    var scheduleLocation = document.getElementById("scheduleLocation").value;
    $http.post($scope.apiRoot + "adminAddEditSchedule", {
      game_id: $scope.game_id,
      action: $scope.adminScheduleBtn,
      team1: team1,
      team2: team2,
      team1Result: team1Result,
      team2Result: team2Result,
      scheduleDate: scheduleDate,
      scheduleTime: scheduleTime,
      scheduleLocation: scheduleLocation
    }).success(function(data){
      if(data === "success") {
        $scope.getSchedule();
        $scope.adminScheduleBtn = "Add";
        document.getElementById("scheduleForm").reset();
      }
    })
  }

  $scope.adminEditSchedule = function(game_id, team1_name, team2_name, date, game_start, location, team1_result, team2_result) {
    $scope.game_id = game_id;
    if(date === "TBD"){
      var date = null;
    }
    if(game_start === "TBD"){
      var game_start = null;
    }
    if(location === "TBD"){
      var location = null;
    }
    if(team1_result === "TBD"){
      var team1_result = null;
      var team2_result = null;
    }
    $scope.adminScheduleBtn = "Edit";
    document.getElementById("team1").value = team1_name;
    document.getElementById("team2").value = team2_name;
    document.getElementById("team1Result").value = team1_result;
    document.getElementById("team2Result").value = team2_result;
    document.getElementById("scheduleDate").value = date;
    document.getElementById("scheduleTime").value = game_start;
    document.getElementById("scheduleLocation").value = location;
  }

  $scope.adminDeleteSchedule = function(game_id) {
    $http.post($scope.apiRoot + "adminDeleteSchedule", {
      game_id: game_id
    }).success(function(data){
      if(data === "success") {
        $scope.getSchedule();
      }
    })
  }

  $scope.adminGetPlayers =  function(){
    $http.get($scope.apiRoot + "adminReadPlayers").success(
      function(data) {
        $scope.adminPlayers = data;
      }
    )
  }

  $scope.adminPlayerBtn = "Add";
  $scope.adminCreateEditPlayer = function(){
    $http.post($scope.apiRoot + "adminCreateEditPlayer", {
      player_id: $scope.player_id,
      action: $scope.adminPlayerBtn,
      first_name: document.getElementById("firstNamePlayer").value,
      last_name: document.getElementById("lastNamePlayer").value,
      email: document.getElementById("emailPlayer").value,
      address: document.getElementById("addressPlayer").value,
      phone_number: document.getElementById("phoneNumberPlayer").value,
      team_id: document.getElementById("playerTeam").value,
      player_number: document.getElementById("playerNumber").value
    }).success(function(data){
      if(data === "success"){
        $scope.adminGetPlayers();
        $scope.adminPlayerBtn = "Add";
        document.getElementById("playerCreate").reset();
      }
    })
  }

  $scope.adminEditPlayer = function(player_id, first_name, last_name, email, address, phone_number, player_number, team_id){
    $scope.player_id = player_id;
    $scope.adminPlayerBtn = "Edit";
    document.getElementById("firstNamePlayer").value = first_name;
    document.getElementById("lastNamePlayer").value = last_name;
    document.getElementById("emailPlayer").value = email;
    document.getElementById("addressPlayer").value = address;
    document.getElementById("phoneNumberPlayer").value = phone_number;
    document.getElementById("playerTeam").value = team_id;
    document.getElementById("playerNumber").value = player_number;
  }

  $scope.adminDeletePlayer = function(player_id) {
    $http.post($scope.apiRoot + "adminDeletePlayer", {
      player_id: player_id
    }).success(function(data){
      if(data === "success") {
        $scope.adminGetPlayers();
      }
    })
  }

  $scope.addStatsModal = function(game_id, team1_id, team2_id) {
    $scope.game_id = game_id;
    $scope.playersStatsForm = [];
    $scope.team1_id = team1_id;
    $scope.team2_id = team2_id;
    $scope.adminPlayers.forEach($scope.playerStatsLoop);
  }

  $scope.playerStatsLoop = function(item){
    if(item.team_id === $scope.team1_id || item.team_id === $scope.team2_id){
      var output = [];
      output['team_name'] = item.team_name;
      output['player_id'] = item.player_id;
      output['first_name'] = item.first_name;
      output['last_name'] = item.last_name;
      output['team_id'] = item.team_id;
      $scope.playersStatsForm.push(output);
    }
  }

  $scope.adminAddStats = function() {
    var player_id = document.getElementById("playersSelect").value;
    var points = document.getElementById("statsPoints").value;
    var assists = document.getElementById("statsAssists").value;
    var rebounds = document.getElementById("statsRebounds").value;
    var blocks = document.getElementById("statsBlocks").value;
    var turnovers = document.getElementById("statsTurnovers").value;

    $http.post($scope.apiRoot + "adminCreateStat", {
      game_id: $scope.game_id,
      player_id: player_id,
      points: points,
      assists: assists,
      rebounds: rebounds,
      blocks: blocks,
      turnovers: turnovers
    }).success(function(data){
      if(data === "success"){
        document.getElementById("createStat").reset();
      }
    })
  }
});
