var app = angular.module('leagueApp', []);
app.controller('leagueController', function ($scope, $http) {
    $scope.contactFrom = function () {
        var name = document.getElementById("contactName").value;
        var email = document.getElementById("contactEmail").value;
        var message = document.getElementById("contactMessage").value;
        if (name == "") {
            console.log("asd");
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
        }).success(function (data) {
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
	$scope.packageSelect = function (package) {
		document.getElementById("package").value = package;
	}
});
