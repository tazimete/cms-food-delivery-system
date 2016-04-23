
  <section id="content">
    <section class="main padder">
      <div class="row">
        <div class="col-lg-12">
          <section class="panel">
            <header class="panel-heading">
             <h3>Riders</h3>
			 <?php if(isset($success_message)) {
				 echo '<div class="success-message">'.$success_message.'</div>';
			 }else if(isset($failed_message)) {
				 echo '<div class="failed-message">'.$failed_message.'</div>';
			 }?>
            </header>
            <div class="panel-body">
              <div class="row text-small">
                <div class="col-sm-4 m-b-mini">
                  <select class="input-sm inline form-control" id="filter-form-rider" style="width:130px">
                    <option value="0" onClick="$('#form-rider').attr('action','');">Select Action</option>
                    <option value="1" onClick="$('#form-rider').attr('action','<?php echo site_url();?>rider/delete_riders');">Delete Selected</option>
                    <option value="2" onClick="$('#form-rider').attr('action','<?php echo site_url();?>rider/view_details_multiple_rider_page');">View Details</option>
                  </select>
                  <button class="btn btn-sm btn-white" onClick="checkRiderFormBeforeSubmit(this)">Apply</button>                
                </div>
                <div class="col-sm-4 m-b-mini">
					<div class="btn-group">
						<a href="<?php echo site_url();?>rider/add_rider_page" class="btn btn-primary dropdown-toggle">Add Rider</a>
					</div>
                </div>
				<form action="<?php echo site_url();?>rider/search_rider" method="post" id="form-search-rider" >
					<div class="col-sm-4">
					  <div class="input-group"> 
							<input type="text" name="keyword-search-rider" class="input-sm form-control" placeholder="Search by name or bike number or contact number">
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
                    <th>Bike Number</th>
                    <th>Contact Number</th>
                    <th>Photo</th>
					<!-- <th width="120">Status</th> -->
                    <th width="200">Action</th>
                  </tr>
                </thead>
                <tbody>
				<form action="" id="form-rider" method="post">
				<?php if($rider_list) {	 
						foreach($rider_list as $rider) {?>
						  <tr>
							<td><input type="checkbox" name="riders[]" value="<?php echo $rider->id; ?>"></td>
							<td><?php echo $rider->id; ?></td>
							<td><?php echo $rider->name; ?></td>
							<td><?php echo $rider->email; ?></td>
							<td><?php echo $rider->password; ?></td>
							<td><?php echo $rider->bike_number; ?></td>
							<td><?php echo $rider->contact_number; ?></td>
							<td><img src="<?php echo base_url();?>static/images/profile-pictures/<?php if($rider->profile_picture){echo $rider->profile_picture;}else{echo 'pp-icon.png';} ?>" width="70" height="70" alt="N/A" /></td>
							<!-- <td><?php if($rider->status){echo 'Assigned';} else{echo 'Not Assigned';} ?></td> -->
							<td>
							  <a href="<?php echo site_url();?>rider/view_details_rider_page/<?php echo $rider->id;?>" class="btn btn-success btn-xs">View</a>
							  <a href="<?php echo site_url();?>rider/edit_rider_page/<?php echo $rider->id;?>" class="btn btn-info btn-xs">Edit</a>
							  <a href="<?php echo site_url();?>rider/delete_rider_by_id/<?php echo $rider->id;?>" class="btn btn-danger btn-xs" onClick="if(confirm('Are you sure to delete?')) {return true;} else{return false;}">Delete</a>
							</td>
						  </tr>
				<?php	 }
					}else{ ?>
							<tr>
								<td colspan="5" style="text-align: center;"><h5> No rider registered yet</h5></td>
							</tr>
					<?php } ?>
				</form>
                </tbody>
              </table>
            </div>
            <footer class="panel-footer">
              <div class="row">
                <div class="col-sm-4 hidden-xs">
                  <select class="input-sm inline form-control" id="filter-form-rider-down" style="width:130px">
                    <option value="0" onClick="$('#form-rider').attr('action','');">Select Action</option>
                    <option value="1" onClick="$('#form-rider').attr('action','<?php echo site_url();?>rider/delete_riders');">Delete Selected</option>
                    <option value="2" onClick="$('#form-rider').attr('action','<?php echo site_url();?>rider/view_details_multiple_rider_page');">View Details</option>
                  </select>
                  <button class="btn btn-sm btn-white" onClick="checkRiderFormBeforeSubmit(this)">Apply</button>                 
                </div>
                <div class="col-sm-3 text-center">
                 <!--  <small class="text-muted inline m-t-small m-b-small">showing 20-30 of 50 items</small> -->
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
 