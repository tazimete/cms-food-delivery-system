<div class="row" style="margin-top: 60px;">
        <div class="col-sm-6 col-sm-offset-3 portlet ui-sortable">
          <header style="text-align: center; margin-bottom: 30px;"> <h3><strong>View Rider Details</strong></h3></header>
		  <?php if(count($rider_list) > 0) { 
				foreach($rider_list as $rider) { ?> 
          <section class="panel portlet-item" style="opacity: 1;">
            <header class="panel-heading">
              <ul class="nav nav-pills pull-right">
                <li>
                  <a class="panel-toggle text-muted" href="#"><i class="fa fa-caret-down fa-lg text-active"></i><i class="fa fa-caret-up fa-lg text"></i></a>
                </li>
              </ul>
			  <h4> <strong> <?php echo $rider->name; ?></strong></h4>
            </header>
            <section class="panel-body" style="height:auto">
              <article class="media">
                <div class="media-body">
                 <!-- <a class="h4" href="#">Bootstrap 3.0 is comming</a>
                  <small class="block">Sleek, intuitive, and powerful mobile-first front-end framework for faster and easier web development.</small>-->
				<p style="width:100%; text-align: center; margin-bottom:50px;"><img src="<?php echo base_url();?>static/images/profile-pictures/<?php if($rider->profile_picture){echo $rider->profile_picture;}else{echo 'pp-icon.png';} ?>" width="200" height="200" alt="No Picture" /></p>
				<p><span class="h4">Name : </span>
				<span class="h4"><?php echo $rider->name; ?> </span> </p><br />
				<p><span class="h4">Eamil : </span>
				<span class="h4"><?php echo $rider->email; ?> </span> </p><br />
				<p><span class="h4">Password : </span>
				<span class="h4"><?php echo $rider->password; ?> </span> </p><br />
				<p><span class="h4">Bike Number : </span>
				<span class="h4"><?php echo $rider->bike_number; ?> </span> </p><br />
				<p><span class="h4">Contact Number : </span>
				<span class="h4"><?php echo $rider->contact_number; ?> </span> </p><br />
			  </div>
              </article>             
            </section>
          </section>
				<?php } } ?>
        </div>
      </div>