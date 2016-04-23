<div class="row" style="margin-top: 60px;">
        <div class="col-sm-6 col-sm-offset-3 portlet ui-sortable">
          <header style="text-align: center; margin-bottom: 30px;"> <h3><strong>View Order Details</strong></h3></header>
		  <?php 
			$smartSend = & get_instance(); 
			$smartSend->load->model('client_model', 'ClientModel');
			$smartSend->load->model('outlet_model', 'OutletModel');
			$smartSend->load->model('rider_model', 'RiderModel');
			
			if(count($order_list) > 0) { 
			foreach($order_list as $order) { ?> 
          <section class="panel portlet-item" style="opacity: 1;">
            <header class="panel-heading">
              <ul class="nav nav-pills pull-right">
                <li>
                  <a class="panel-toggle text-muted" href="#"><i class="fa fa-caret-down fa-lg text-active"></i><i class="fa fa-caret-up fa-lg text"></i></a>
                </li>
              </ul>
			  <h4> <strong> Order ID : <?php echo $order->id; ?></strong></h4>
            </header>
            <section class="panel-body" style="height:auto">
              <article class="media">
                <div class="media-body">
                 <!-- <a class="h4" href="#">Bootstrap 3.0 is comming</a>
                  <small class="block">Sleek, intuitive, and powerful mobile-first front-end framework for faster and easier web development.</small>-->
				<p><span class="h4">Order ID : </span>
				<span class="h4"><?php echo $order->id; ?> </span> </p><br />
				<?php if((int) $order->outlet_type == 1) { ?>
					<p><span class="h4">Client ID : </span>
					<span class="h4"><?php echo $order->client_id; ?> </span> </p><br />
					<p><span class="h4">Client Name : </span>
					<span class="h4">
						<?php 
							$client = $smartSend->ClientModel->get_client_by_id($order->client_id);
							echo $client->company_name; 
						?> 
					</span> </p><br />
				<?php }elseif((int) $order->outlet_type == 2){ ?>
					<p><span class="h4">Outlet ID : </span>
					<span class="h4"><?php echo $order->client_id; ?> </span> </p><br />
					<p><span class="h4">Outlet Name : </span>
					<span class="h4">
						<?php 
							$outlet = $smartSend->OutletModel->get_outlet_by_id($order->client_id);
							echo $outlet->name; 
						?> 
					</span> </p><br />
				<?php } ?>
				<p><span class="h4">Rider ID : </span>
				<span class="h4">
					<?php 
						$rider = $smartSend->RiderModel->get_rider_by_id($order->rider_id);
						if($rider){
							echo $rider->id;
						}else{
							echo "N/A";
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Rider Name : </span>
				<span class="h4">
					<?php 
						if($rider){
							echo $rider->name;
						}else{
							echo "N/A";
						}
					?> 
				</span> </p><br />
				<p><span class="h4">Pickup Date & Time: </span>
				<span class="h4"><?php echo $order->pickup_datetime; ?> </span> </p><br />
				<p><span class="h4">Delivery Date & Time: </span>
				<span class="h4"><?php echo $order->deliver_datetime; ?> </span> </p><br />
				<p><span class="h4">Postal Code : </span>
				<span class="h4"><?php echo $order->postal_code; ?> </span> </p><br />
				<p><span class="h4">Address : </span>
				<span class="h4"><?php echo $order->address; ?> </span> </p><br />
				<p><span class="h4">Customer Name : </span>
				<span class="h4"><?php echo $order->customer_name; ?> </span> </p><br />
				<p><span class="h4">Customer Contact Number : </span>
				<span class="h4"><?php echo $order->mobile_number; ?> </span> </p><br />
				<p><span class="h4">Food Cost : </span>
				<span class="h4"><?php echo $order->food_cost; ?> </span> </p><br />				
				<p><span class="h4">Receipt Number : </span>
				<span class="h4"><?php echo $order->receipt_number; ?> </span> </p><br />
				<p><span class="h4">Created Date : </span>
				<span class="h4"><?php echo $order->created_date; ?> </span> </p><br />
			  </div>
              </article>             
            </section>
          </section>
				<?php } } ?>
        </div>
      </div>