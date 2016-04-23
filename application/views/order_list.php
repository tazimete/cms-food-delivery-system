
  <section id="content">
    <section class="main padder">
      <div class="row">
        <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
             <h3>Orders</h3>
			 <?php if(isset($success_message)) {
				 echo '<div class="success-message">'.$success_message.'</div>';
			 }else if(isset($failed_message)) {
				 echo '<div class="failed-message">'.$failed_message.'</div>';
			 }?>
            </header>
            <div class="panel-body">
              <div class="row text-small">
                <div class="col-sm-4 m-b-mini">
                  <select class="input-sm inline form-control" id="filter-form-order" style="width:130px">
                    <option value="0" onClick="$('#form-order').attr('action','');">Select Action</option>
                    <option value="2" onClick="$('#form-order').attr('action','<?php echo site_url();?>order/view_details_multiple_order_page');">View Details</option>
                  </select>
                  <button class="btn btn-sm btn-white" onClick="checkOrderFormBeforeSubmit(this)">Apply</button>                
                </div>
                <div class="col-sm-4 m-b-mini">
					
                </div>
				<form action="<?php echo site_url();?>order/search_order" method="post" id="form-search-order" >
					<div class="col-sm-4">
					  <div class="input-group"> 
							<input type="text" name="keyword-search-order" class="input-sm form-control" placeholder="Search by id or name or address or contact number">
							<span class="input-group-btn">
							  <input class="btn btn-sm btn-white" type="submit" value="Go!">
							</span>
					  </div>
					</div>
				</form>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-striped b-t text-small">
                <thead>
                  <tr>
                    <th width="20"><input type="checkbox"></th>
                    <th width="60">ID</th>
                    <th class="th-sortable" data-toggle="class">Client
                      <span class="th-sort">
                        <i class="fa fa-sort-down text"></i>
                        <i class="fa fa-sort-up text-active"></i>
                        <i class="fa fa-sort"></i>
                      </span>
                    </th>
                    <th>Rider</th>
					<th>Address</th>
                    <th>Customer Name</th>
                    <th>Pickup Time</th>
                    <th>Delivery Time</th>
                    <th width="100">Action</th>
                  </tr>
                </thead>
                <tbody>
				<form action="" id="form-order" method="post">
				<?php if($order_list) {	 
						foreach($order_list as $order) {?>
						  <tr>
							<td><input type="checkbox" name="orders[]" value="<?php echo $order->id; ?>"></td>
							<td><?php echo $order->id; ?></td>
							<td>
								<?php 
									$smartSend = & get_instance(); 
									$smartSend->load->model('client_model', 'ClientModel');
									$smartSend->load->model('outlet_model', 'OutletModel');
									$smartSend->load->model('rider_model', 'RiderModel');
									
									if((int) $order->outlet_type == 1){
										$client = $smartSend->ClientModel->get_client_by_id($order->client_id);
										
										if($client){ ?>
											<a href="<?php echo site_url();?>client/view_details_client_page/<?php echo $order->client_id; ?>">
												<?php echo $client->company_name; ?> 
											</a> 
											
										<?php }
									}else if((int) $order->outlet_type == 2){
										$outlet = $smartSend->OutletModel->get_outlet_by_id($order->client_id);
										
										if($outlet){ ?> 
											<a href="<?php echo site_url();?>outlet/view_details_outlet_page/<?php echo $order->client_id; ?>">
												<?php echo $outlet->name; ?>
											</a> 					
										<?php }else{echo "N/A";}
									}	
								?>
								</a>
							</td>
							<td> 
								<a href="<?php echo site_url();?>rider/view_details_rider_page/<?php echo $order->rider_id;?>">
								<?php 
									$rider = $smartSend->RiderModel->get_rider_by_id($order->rider_id); 
									if($rider){
										echo $rider->name;
									}else{
										echo 'N/A';
									}
								?>
								</a>
							</td>
							<td><?php echo $order->address; ?></td>
							<td><?php echo $order->customer_name; ?></td>
							<td><?php echo $order->pickup_datetime; ?></td>
							<td><?php echo $order->deliver_datetime; ?></td>
							<td>
							  <a href="<?php echo site_url();?>order/view_details_order_page/<?php echo $order->id;?>" class="btn btn-success btn-xs">View</a>
							</td>
						  </tr>
				<?php	 }
					}else{ ?>
							<tr>
								<td colspan="5" style="text-align: center;"><h5> Empty order list </h5></td>
							</tr>
					<?php } ?>
				</form>
                </tbody>
              </table>
            </div>
            <footer class="panel-footer">
              <div class="row">
                <div class="col-sm-4 hidden-xs">
                  <select class="input-sm inline form-control" id="filter-form-order-down" style="width:130px">
                    <option value="0" onClick="$('#form-order').attr('action','');">Select Action</option>
                    <option value="2" onClick="$('#form-order').attr('action','<?php echo site_url();?>order/view_details_multiple_order_page');">View Details</option>
                  </select>
                  <button class="btn btn-sm btn-white" onClick="checkOrderFormBeforeSubmit(this)">Apply</button>                 
                </div>
                <div class="col-sm-3 text-center">
                </div>
                <div class="col-sm-5 text-right text-center-sm">                
                  <ul class="pagination pagination-small m-t-none m-b-none">          
					<?php foreach ($links as $link) {
						echo "<li>". $link."</li>";
					} ?>
                  </ul>
                </div>
              </div>
            </footer>
          </section>
        </div>
      </div>
    </section>
  </section>
 