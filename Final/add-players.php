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
		<h3 style="margin-top:35px">Invite a Player</h3>
            <br>
		<form>
		  <div class="row">
		    <div class="col-md-6 mb-3">
		      <label for="validationServer01">First name</label>
		      <input type="text" class="form-control is-valid" id="validationServer01" placeholder="First name" value="Mark" required>
		    </div>
		    <div class="col-md-6 mb-3">
		      <label for="validationServer02">Last name</label>
		      <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Last name" value="Otto" required>
		    </div>
		  </div>
		  <div class="row">
		    <div class="col-md-6 mb-3">
		      <label for="validationServer03">Email</label>
		      <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="John@hotmail.com" required>
		      <div class="invalid-feedback">
		        Please provide a valid email.
		      </div>
		    </div>
		    <div class="col-md-3 mb-3">
		      <label for="validationServer04">Phone Number</label>
		      <input type="text" class="form-control is-invalid" id="validationServer04" placeholder="Phone Number" required>
		      <div class="invalid-feedback">
		        Please provide a valid Phone Number.
		      </div>
		    </div>
		    
		  </div>

		  <button class="btn btn-primary" type="submit">Invite More Players</button>
            
            <button class="btn btn-primary" type="submit">Submit</button>
		</form>
	</div>
    
        <!-- Defining states end -->
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
