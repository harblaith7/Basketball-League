<html lang="en">
<?php include "head.php"; ?>

<body id="body" class="home-classic">
    <!-- HEADER -->
    <?php include "nav.php"; ?>
    <div class="main-wrapper">
        <div class="main-wrapper">
            <div class="grid-wrapper section">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-12 element-content">
       
                            
                            <div class="display-single_element">
		<h3 class="form_title">Sign Up Form</h3>
		<form  class="register">
			<div class="row">
				<div class="form-group col-md-12 input-icon">
					<div class="input-group-addon"><i class="fa fa-user"></i></div>
					<input type="text" class="form-control" id="uname" aria-describedby="fullName" placeholder="Full Name">
				</div>
				<div class="form-group col-md-12 input-icon">
					<div class="input-group-addon"><i class="fa fa-envelope"></i></div>
					<input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
				</div>
				<div class="form-group col-md-12 input-icon">
					<div class="input-group-addon"><i class="fa fa-lock"></i></div>
					<input type="password" class="form-control" id="password" placeholder="Password">
				</div>
			</div>
			<button type="submit" class="btn btn-default btn-primary btn-block">Sign Up</button>
			<div class="row">
				<div class="form-check col-md-6">
					<input id="checkbox-2" class="checkbox-custom form-check-input" name="checkbox-2" type="checkbox">
					<label for="checkbox-2" class="checkbox-custom-label form-check-label ">Remember me</label>
				</div>
				<div class="col-md-3 offset-md-3 text-right">
					<a href="" class="btn-link">Forgot password ?</a>
				</div>
			</div>
			<span class="or text-center">OR</span>
			<button type="submit" class="btn btn-default btn-facebook btn-block">Log in with Facebook</button>
			<button type="submit" class="btn btn-default btn-twitter btn-block">Log in with Twitter</button>
		</form>
		<p class="form-footer">Already have an Account? <a href="" class="btn-link text-primary">Log in</a></p>
	</div>
    
        <!-- FOOTER -->
         </div>
                    </div>
                    <!-- element-content ends -->
                </div>
            </div>
            <!-- element main container ends -->
        </div>

        <!-- FOOTER -->
        <?php include "foot-nav.php"; ?>
    </div>
    <!-- JAVASCRIPTS -->
    <?php include "js-compile.php"; ?>
</body>

</html>
