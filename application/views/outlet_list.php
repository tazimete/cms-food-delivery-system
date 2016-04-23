
  <section id="content">
    <section class="main padder">
      <div class="row">
        <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
             <h3>Outlets</h3>
			 <?php if(isset($success_message)) {
				 echo '<div class="success-message">'.$success_message.'</div>';
			 }else if(isset($failed_message)) {
				 echo '<div class="failed-message">'.$failed_message.'</div>';
			 }?>
            </header>
            <div class="panel-body">
              <div class="row text-small">
                <div class="col-sm-4 m-b-mini">
                  <select class="input-sm inline form-control" id="filter-form-outlet" style="width:130px">
                    <option value="0" onClick="$('#form-outlet').attr('action','');">Select Action</option>
                    <option value="1" onClick="$('#form-outlet').attr('action','<?php echo site_url();?>outlet/delete_outlets');">Delete Selected</option>
                    <option value="2" onClick="$('#form-outlet').attr('action','<?php echo site_url();?>outlet/view_details_multiple_outlet_page');">View Details</option>
                  </select>
                  <button class="btn btn-sm btn-white" onClick="checkOutletFormBeforeSubmit(this)">Apply</button>                
                </div>
                <div class="col-sm-4 m-b-mini">
					<div class="btn-group">
					  <a href="<?php echo site_url();?>outlet/add_outlet_page" class="btn btn-primary dropdown-toggle">Add Outlet</a>
					</div>
                </div>
				<form action="<?php echo site_url();?>outlet/search_outlet" method="post" id="form-search-client" >
					<div class="col-sm-4">
					  <div class="input-group"> 
							<input type="text" name="keyword-search-outlet" class="input-sm form-control" placeholder="Search by name or location or contact number">
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
                    <th>Client</th>
                    <th>Location</th>
                    <th>Contact Number</th>
                    <th width="200">Action</th>
                  </tr>
                </thead>
                <tbody>
				<form action="" id="form-outlet" method="post">
				<?php if($outlet_list) {	 
						foreach($outlet_list as $outlet) {?>
						  <tr>
							<td><input type="checkbox" name="outlets[]" value="<?php echo $outlet->id; ?>"></td>
							<td><?php echo $outlet->id; ?></td>
							<td><?php echo $outlet->name; ?></td>
							<td>
								<?php 
									$smartSend = & get_instance(); 
									$smartSend->load->model('client_model', 'ClientModel');
									$client = $smartSend->ClientModel->get_client_by_id($outlet->client_id);
									if($client){
										echo $client->company_name;
									}else{
										echo 'N/A';
									}
								?>
							</td>
							<td><?php echo $outlet->location; ?></td>
							<td><?php echo $outlet->contact_number; ?></td>
							<td>
							  <a href="<?php echo site_url();?>outlet/view_details_outlet_page/<?php echo $outlet->id;?>" class="btn btn-success btn-xs">View</a>
							  <a href="<?php echo site_url();?>outlet/edit_outlet_page/<?php echo $outlet->id;?>" class="btn btn-info btn-xs">Edit</a>
							  <a href="<?php echo site_url();?>outlet/delete_outlet_by_id/<?php echo $outlet->id;?>" class="btn btn-danger btn-xs" onClick="if(confirm('Are you sure to delete?')) {return true;} else{return false;}">Delete</a>
							</td>
						  </tr>
				<?php	 }
					}else{ ?>
							<tr>
								<td colspan="5" style="text-align: center;"><h5> No client registered yet</h5></td>
							</tr>
					<?php } ?>
				</form>
                </tbody>
              </table>
            </div>
            <footer class="panel-footer">
              <div class="row">
                <div class="col-sm-4 hidden-xs">
                  <select class="input-sm inline form-control" id="filter-form-outlet-down" style="width:130px">
                    <option value="0" onClick="$('#form-outlet').attr('action','');">Select Action</option>
                    <option value="1" onClick="$('#form-outlet').attr('action','<?php echo site_url();?>outlet/delete_outlets');">Delete Selected</option>
                    <option value="2" onClick="$('#form-outlet').attr('action','<?php echo site_url();?>outlet/view_details_multiple_outlet_page');">View Details</option>
                  </select>
                  <button class="btn btn-sm btn-white" onClick="checkOutletFormBeforeSubmit(this)">Apply</button>                 
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
 