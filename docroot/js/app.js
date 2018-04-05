var app = angular.module('leagueApp', ['ngSanitize']);
app.controller('leagueController', function ($scope, $http) {
	$scope.contactFrom = function () {
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
			name: name
			, email: email
			, message: message
		}).success(function (data) {
			if (data == "success") {
				document.getElementById("contactName").value = null;
				document.getElementById("contactEmail").value = null;
				document.getElementById("contactMessage").value = null;
				return;
			}
			else {
				alert(data);
				return;
			}
		});
	}
	$scope.packageSelect = function (package) {
		document.getElementById("package").value = package;
	}
	$scope.teamRegistration = function () {
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
		}
		else if (teamName.length > 20) {
			errorReporting("Team name cannot be longer than 20 characters");
			return;
		}
		$http.post("php/createTeam.php", {
			package: package
			, first_name: firstName
			, last_name: lastName
			, address: address
			, email: email
			, phone_numer: phoneNumber
			, team_name: teamName
		}).success(function (data) {
			if (data == "success") {
				$("#registerError").addClass("hidden");
				return;
			}
			else {
				errorReporting(data);
				return;
			}
		});
	}
	$scope.getTeams = function (team_id) {
		$http.post("php/readTeams.php", {
			type: "request"
			, team_id: team_id
		}).success(function (data) {
			$scope.teams = data;
		});
	}
	$scope.teamSelect = function (team_id, index) {
		window.open('team.php?id=' + team_id + '&standing=' + index, "_self");
	}
	$scope.getSchedule = function (team_id) {
		$http.post("php/readSchedule.php", {
			type: "request"
			, team_id: team_id
		}).success(function (data) {
			$scope.schedule = data;
		});
	}
	$scope.getStats = function (team_id) {
		$http.post("php/readPlayerStats.php", {
			type: 'request'
			, team_id: team_id
		}).success(function (data) {
			console.log(data);
			$scope.stats = data;
		});
	}
	
	$scope.login = function () {
		var loginEmail = document.getElementById("loginEmail").value;
		var loginPassword = document.getElementById("loginPassword").value;
		$http.post("php/loginRequest.php", {
			email: loginEmail,
			password: loginPassword
		}).success(function (data) {
			if(data === "success"){
				window.open("dashboard.php", "_self");
			}
			document.getElementById("loginResponse").innerHTML = data;
		});
	}
});