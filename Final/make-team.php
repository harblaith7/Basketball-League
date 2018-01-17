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
              <div class="col-md-6 mb-3">
		      <label for="validationServer02">Team Name</label>
		      <input type="text" class="form-control is-valid" id="validationServer02" placeholder="Last name" value="The Recorders" required>
		    </div>
              <div class="col-md-6 mb-3">
		      <label for="validationServer02">Player Number</label>
		      <input type="text" class="form-control is-valid" id="validationServer02" placeholder="23" required>
		    </div>
		  </div>
		  <div class="row">
		    <div class="col-md-6 mb-3">
		      <label for="validationServer03">Phone Number</label>
		      <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="Phone Number" required>
		      <div class="invalid-feedback">
		        Please provide a valid phone number.
		      </div>
		    </div>
              <div class="col-md-6 mb-3">
		      <label for="validationServer03">Email</label>
		      <input type="text" class="form-control is-invalid" id="validationServer03" placeholder="example@hotmail.com" required>
		      <div class="invalid-feedback">
		        Please provide a valid email.
		      </div>
		    </div>
		    
		    
		  </div>

		  <button class="btn btn-primary" type="submit">Make this Team!</button>
		</form>
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
