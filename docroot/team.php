<html lang="en">

<head>
	<?php include "head.php"?>
</head>

<body id="body" class="b-element" ng-app="leagueApp" ng-controller="leagueController" ng-init="getTeams(<?php echo $_GET['id']; ?>); getSchedule(<?php echo $_GET['id']; ?>); getStats(<?php echo $_GET['id']; ?>);">
	<!-- Preloader -->
	<div id="preloader" class="smooth-loader-wrapper">
		<div class="smooth-loader">
			<div class="loader1">
				<div class="loader-target">
					<div class="loader-target-main"></div>
					<div class="loader-target-inner"></div>
				</div>
			</div>
		</div>
	</div>
	<?php include "nav.php";?>
		<div class="main-wrapper">
			<section class="">
				<div class="bg-image-holder bredcrumb bg-primary">
					<div class="container">
						<div class="row">
							<div class="col-md-8">
								<h2>Team Info </h2>
								<hr class="hr_narrow hr_color">
							</div>
						</div>
					</div>
					<!-- container ends -->
				</div>
			</section>
			<!-- Member details -->
			<section class="member-details">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="img-container">
								<img  ng-repeat="x in teams" src="{{x.team_image}}" style="width:200px;  height:200px" alt="team member" class="img-full">
							</div>
						</div>
						<div class="col-md-8" style="color: black">
							<h2 ng-repeat="x in teams">{{x.team_name}}</h2>
							<br>
							<div class="member_desc">
								<table class="table">
									<thead>
										<th>Game Date</th>
										<th>Game</th>
										<th>Score</th>
										<th>Result</th>
									</thead>
									<tbody>
										<tr ng-repeat="x in schedule">
											<td>{{x.date}}</td>
											<td><strong>{{x.team1_name}}</strong>&nbsp;v.&nbsp;<strong>{{x.team2_name}}</strong></td>
											<td>{{x.team1_result}} : {{x.team2_result}}</td>
											<td>{{x.result}}</td>
										</tr>
									</tbody>
								</table>
							</div>
							<br>
							<div class="member_desc">
								<table class="table">
									<thead>
										<th>Player Name</th>
										<th>Player #</th>
										<th>PPG</th>
										<th>APG</th>
										<th>RPG</th>
										<th>BPG</th>
										<th>TOPG</th>
									</thead>
									<tbody>
										<tr ng-repeat="x in stats">
											<td>{{x.player_name}}</td>
											<td>{{x.player_number}}</td>
											<td>{{x.ppg | number: 1}}</td>
											<td>{{x.apg | number: 1}}</td>
											<td>{{x.rpg | number: 1}}</td>
											<td>{{x.bpg | number: 1}}</td>
											<td>{{x.topg | number: 1}}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- FOOTER -->
			<?php include "foot-nav.php";?>
		</div>
		<!-- JAVASCRIPTS -->
		<?php include "js-compile.php";?>
</body>

</html>
