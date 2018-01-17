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
		
		<h3 class="form_title">Log in your Account</h3>
		<form  class="register">
			<div class="row">
				<div class="form-group col-md-12">
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
				</div>
				<div class="form-group col-md-12">
					<input type="password" class="form-control" id="exampleInputPassword" placeholder="Password">
				</div>
			</div>
			<button type="submit" class="btn btn-default btn-primary btn-block">Log In</button>
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
		<p class="form-footer">Don’t have an Account? <a href="sign-up.php" class="btn-link text-primary">Sign up</a></p>
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
