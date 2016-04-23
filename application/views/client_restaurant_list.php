
  <section id="content">
    <section class="main padder">
      <div class="row">
        <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
             <h3>Restaurants</h3>
			 <?php if(isset($success_message)) {
				 echo '<div class="success-message">'.$success_message.'</div>';
			 }else if(isset($failed_message)) {
				 echo '<div class="failed-message">'.$failed_message.'</div>';
			 }?>
            </header>
            <div class="panel-body">
              <div class="row text-small">
                <div class="col-sm-4 m-b-mini">
                  <select class="input-sm inline form-control"  id="filter-form-client-restaurant" style="width:130px">
                    <option value="0" onClick="$('#form-client-restaurant').attr('action', '');">Select Action</option>
                    <option value="1" onClick="$('#form-client-restaurant').attr('action','<?php echo site_url();?>client/delete_clients_restaurant');">Delete Selected</option>
					<option value="2" onClick="$('#form-client-restaurant').attr('action','<?php echo site_url();?>client/view_details_multiple_client_restaurant_page');">View Details</option>
                  </select>
                  <button class="btn btn-sm btn-white" onClick="checkClientRestaurantFormBeforeSubmit(this)">Apply</button>                 
                </div>
                <div class="col-sm-4 m-b-mini">
					<div class="btn-group">
						<a href="<?php echo site_url();?>client/add_client_restaurant_page" class="btn btn-primary dropdown-toggle">Add Restaurant</a>
					</div>
                </div>
                <form action="<?php echo site_url();?>client/search_client_restaurant" method="post" id="form-search-client-restaurant" >
					<div class="col-sm-4">
					  <div class="input-group"> 
							<input type="text" name="keyword-search-client-restaurant" class="input-sm form-control" placeholder="Search by name or location or contact number">
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
                    <th class="th-sortable" data-toggle="class">Name
                      <span class="th-sort">
                        <i class="fa fa-sort-down text"></i>
                        <i class="fa fa-sort-up text-active"></i>
                        <i class="fa fa-sort"></i>
                      </span>
                    </th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Location</th>
                    <th>Contact Number</th>
                    <th width="200">Action</th>
                  </tr>
                </thead>
                <tbody>
					<form action="" id="form-client-restaurant" method="post">
				<?php if($client_list) {	 
						foreach($client_list as $client) {?>
						  <tr>
							<td><input type="checkbox" name="restaurants[]" value="<?php echo $client->id; ?>"></td>
							<td><?php echo $client->id; ?></td>
							<td><?php echo $client->company_name; ?></td>
							<td><?php echo $client->email; ?></td>
							<td><?php echo $client->password; ?></td>
							<td><?php echo $client->location; ?></td>
							<td><?php echo $client->contact_number; ?></td>
							<td>
							  <a href="<?php echo site_url();?>client/view_details_client_page/<?php echo $client->id;?>" class="btn btn-success btn-xs">View</a>
							  <a href="<?php echo site_url();?>client/edit_client_restaurant_page/<?php echo $client->id;?>" class="btn btn-info btn-xs">Edit</a>
							  <a href="<?php echo site_url();?>client/delete_restaurant_by_id/<?php echo $client->id;?>" class="btn btn-danger btn-xs" onClick="if(confirm('Are you sure to delete?')) {return true;} else{return false;}">Delete</a>
							</td>
						  </tr>
				<?php	 }  
					} else{ ?>
							<tr>
								<td  colspan="5" style="text-align: center;"><h5> No restaurant registered yet</h5></td>
							</tr>
						<?php } ?>
					</form>
                </tbody>
              </table>
            </div>
            <footer class="panel-footer">
              <div class="row">
                <div class="col-sm-4 hidden-xs">
                  <select class="input-sm inline form-control"  id="filter-form-client-restaurant-down" style="width:130px">
                    <option value="0" onClick="$('#form-client-restaurant').attr('action', '');">Select Action</option>
                    <option value="1" onClick="$('#form-client-restaurant').attr('action','<?php echo site_url();?>client/delete_clients_restaurant');">Delete Selected</option>
					<option value="2" onClick="$('#form-client-restaurant').attr('action','<?php echo site_url();?>client/view_details_multiple_client_restaurant_page');">View Details</option>
                  </select>
                  <button class="btn btn-sm btn-white" onClick="checkClientRestaurantFormBeforeSubmit(this)">Apply</button>                  
                </div>
                <div class="col-sm-3 text-center">
                  <!-- <small class="text-muted inline m-t-small m-b-small">showing 20-30 of 50 items</small> -->
                </div>
                <div class="col-sm-5 text-right text-center-sm">                
                  <ul class="pagination pagination-small m-t-none m-b-none">
                    <!-- <li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#"><i class="fa fa-chevron-right"></i></a></li>-->
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
 