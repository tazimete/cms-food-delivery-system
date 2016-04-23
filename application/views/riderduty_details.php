<div class="row" style="margin-top: 60px;">
        <div class="col-sm-6 col-sm-offset-3 portlet ui-sortable">
          <header style="text-align: center; margin-bottom: 30px;"> <h3><strong>View Duty of Rider Details</strong></h3></header>
		  <?php if(count($rider_duty_list) > 0) { 
				foreach($rider_duty_list as $rider_duty) { 
					$smartSend = & get_instance(); 
					$smartSend->load->model('client_model', 'ClientModel');
					$smartSend->load->model('rider_model', 'RiderModel');
					$smartSend->load->model('outlet_model', 'OutletModel');
					$rider = $smartSend->RiderModel->get_rider_by_id($rider_duty->rider_id);
					$client = $smartSend->ClientModel->get_client_by_id($rider_duty->client_id);
					$outlet = $smartSend->OutletModel->get_outlet_by_id($rider_duty->outlet_id);
			?> 
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
				<p><span class="h4">ID : </span>
				<span class="h4"><?php echo $rider_duty->id; ?> </span> </p><br />
				<p><span class="h4">Rider ID : </span>
				<span class="h4"><?php echo $rider->id; ?> </span> </p><br />
				<p><span class="h4">Rider Name  : </span>
				<span class="h4">
					<?php echo $rider->name;?>
				</span> </p><br />
				<p><span class="h4">Rider Contact Number : </span>
				<span class="h4">
					<?php echo $rider->contact_number;?>
				</span> </p><br />
				<p><span class="h4">Company ID: </span>
				<span class="h4">
					<?php 
						if($rider_duty->outlet_type == 1){
							echo $rider_duty->client_id;
						}else{
							echo 'N/A';
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Company Name : </span>
				<span class="h4">
					<?php 
						if($rider_duty->outlet_type == 1){
							echo $client->company_name;
						}else{
							echo 'N/A';
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Company Postal Code : </span>
				<span class="h4">
					<?php 
						if($rider_duty->outlet_type == 1){
							echo $client->company_postal_code;
						}else{
							echo 'N/A';
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Company Location : </span>
				<span class="h4">
					<?php 
						if($rider_duty->outlet_type == 1){
							echo $client->location;
						}else{
							echo 'N/A';
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Company Billing Address : </span>
				<span class="h4">
					<?php 
						if($rider_duty->outlet_type == 1){
							echo $client->billing_address;
						}else{
							echo 'N/A';
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Company Contact Number : </span>
				<span class="h4">
					<?php 
						if($rider_duty->outlet_type == 1){
							echo $client->contact_number;
						}else{
							echo 'N/A';
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Outlet ID : </span>
				<span class="h4">
					<?php 
						if($rider_duty->outlet_type == 2){
							echo $rider_duty->outlet_id;
						}else{
							echo 'N/A';
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Outlet Name : </span>
				<span class="h4">
					<?php 
						if($rider_duty->outlet_type == 2){
							echo $outlet->name;
						}else{
							echo 'N/A';
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Outlet Postal Code : </span>
				<span class="h4">
					<?php 
						if($rider_duty->outlet_type == 2){
							echo $outlet->postal_code;
						}else{
							echo 'N/A';
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Outlet Location : </span>
				<span class="h4">
					<?php 
						if($rider_duty->outlet_type == 2){
							echo $outlet->location;
						}else{
							echo 'N/A';
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Outlet Billing Address : </span>
				<span class="h4">
					<?php 
						if($rider_duty->outlet_type == 2){
							echo $outlet->billing_address;
						}else{
							echo 'N/A';
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Outlet Contact Number : </span>
				<span class="h4">
					<?php 
						if($rider_duty->outlet_type == 2){
							echo $outlet->contact_number;
						}else{
							echo 'N/A';
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Created Date : </span>
				<span class="h4"><?php echo $rider_duty->created_date; ?> </span> </p><br />
			  </div>
              </article>             
            </section>
          </section>
				<?php } } ?>
        </div>
      </div>