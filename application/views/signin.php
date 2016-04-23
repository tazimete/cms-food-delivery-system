

  <section id="content">
    <div class="main padder">
      <div class="row">
        <div class="col-lg-4 col-lg-offset-4 m-t-large">
          <section class="panel">
            <header class="panel-heading text-center h4">
              Sign in
            </header>
            <form action="<?php echo site_url();?>dashboard/signin" method="post" class="panel-body">
				<?php echo validation_errors(); ?>
				<?php if(isset($error_message)){ ?>
					<div class="failed-message"> <?php echo $error_message; ?></div>
				<?php } ?>
				
				<?php if(isset($success_message)){ ?>
					<div class="success-message"> <?php echo $success_message; ?></div>
				<?php } ?>
				<div class="block">
					<label class="control-label">Email</label>
					<input name="user-email" type="email" placeholder="test@example.com" class="form-control" value="<?php echo set_value('user-email'); ?>">
				</div>
				<div class="block">
					<label class="control-label">Password</label>
					<input type="password" name="user-password" id="inputPassword" placeholder="Password" class="form-control" value="<?php echo set_value('user-password'); ?>">
				</div>
              <!-- <div class="checkbox">
                <label>
                  <input type="checkbox"> Keep me logged in
                </label>
              </div> -->
			  <div class="line line-dashed"></div>
			  <button type="submit" class="btn btn-facebook btn-block m-b-small">Sign in</button>
              <a href="#" class="pull-right m-t-mini"><small>Forgot password?</small></a>
              <!-- <a href="#" class="btn btn-facebook btn-block m-b-small"><i class="fa fa-facebook pull-left"></i>Sign in with Facebook</a>
              <a href="#" class="btn btn-twitter btn-block"><i class="fa fa-twitter pull-left"></i>Sign in with Twitter</a> -->          
             <!-- <p class="text-muted text-center"><small>Do not have an account?</small></p>
              <a href="signup.html" class="btn btn-white btn-block">Create an account</a> -->
            </form>
          </section>
        </div>
      </div>
    </div>
  </section>
  