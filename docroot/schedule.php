<html lang="en">

<head>
    <?php include "head.php"?>
</head>

<body id="body" class="b-element" ng-app="leagueApp" ng-controller="leagueController">
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
                <!-- style="background-image: url('img/promo-1.jpg');" -->
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h2>Schedule </h2>
                            <hr class="hr_narrow  hr_color">
                            <p>Players are advised to be present 20 minutes before their game</p>
                        </div>
                    </div>
                </div>
                <!-- container ends -->
            </div>
        </section>
        <section class="bg-sand hero-block home-about">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" style="color: black">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Game #</th>
                                    <th>Teams</th>
                                    <th>Date</th>
                                    <th>Start Time</th>
                                    <th>Location</th>
									<th>Results</th>
									<th>Winner</th>
                                </tr>
                            </thead>
                            <tbody ng-init="getSchedule()">
                                <tr ng-repeat="x in schedule">
                                    <th>{{x.game_id}}</th>
                                    <td><strong>{{x.team1_name}}</strong>&nbsp;v.&nbsp;<strong>{{x.team2_name}}</strong></td>
									<td>{{x.date}}</td>
                                    <td>{{x.game_start}}</td>
                                    <td>{{x.location}}</td>
									<td>{{x.team1_result}} : {{x.team2_result}}</td>
									<td><strong>{{x.winner_name}}</strong></td>
                                </tr>
                            </tbody>
                        </table>
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
