<html lang="en">

<head>
	<?php include "head.php"?>
</head>

<body id="body" class="b-element">
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
								<h2>Player Info </h2>
								<hr class="hr_narrow  hr_color">
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
						<div class="col-lg-3 col-md-4">
							<div class="img-container"> <img src="img/about/team4.jpg" alt="team member" class="img-full"> </div>
						</div>
						<div class="col-lg-9 col-md-8">
							<div class="member_designation">
								<h2>{{x.first_name}} {{x.last_name}}</h2> <span>{{x.team}}</span> </div>
							<div class="member_desc">
								<h4>Stats</h4>
								<!-- progressbar starts -->
								<div class="progress-holder">
									<div class="barWrapper"> <span class="progressText"><B>Javascript</B></span>
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div> <span class="popOver" data-toggle="tooltip" data-placement="top" title="80%"> </span> </div>
									</div>
									<div class="barWrapper"> <span class="progressText"><B>Photoshop</B></span>
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div> <span class="popOver" data-toggle="tooltip" data-placement="top" title="95%"> </span> </div>
									</div>
									<div class="barWrapper"> <span class="progressText"><B>Web Design</B></span>
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div> <span class="popOver" data-toggle="tooltip" data-placement="top" title="85%"> </span> </div>
									</div>
									<div class="barWrapper"> <span class="progressText"><B>Wordpress</B></span>
										<div class="progress">
											<div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div> <span class="popOver" data-toggle="tooltip" data-placement="top" title="75%"> </span> </div>
									</div>
								</div>
								<!-- progressbar ends -->
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