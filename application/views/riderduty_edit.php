
  <section id="content">
    <section class="main padder">
      <div class="clearfix">
        <h3><i class="fa fa-edit"></i><?php echo $form_name ?></h3>
      </div>
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <section class="panel" style="margin-top: 100px;">
            <div class="panel-body">
              <form action="<?php echo site_url();?>riderduty/edit_rider_duty_by_id/<?php echo $rider_duty->id;?>" class="form-horizontal" method="post" data-validate="parsley" enctype="multipart/form-data"> 
				<div class="form-group">
                  <label class="col-lg-3 control-label">Select Outlet</label>
                  <div class="col-lg-8">
                    <select name="outlet-id" value="<?php echo set_value('outlet-id'); ?>" data-required="true" class="form-control"> 
						<option></option>
						<?php 
							if($rider_duty->outlet_type == 1){
								$selectClient = true;
								$selectOutlet = false;
							}else if($rider_duty->outlet_type == 2){
								$selectClient = false;
								$selectOutlet = true;
							}
						?>
						<?php if($client_list){
							foreach($client_list as $client){ 
								if($selectClient == true && $rider_duty->client_id == $client->id){
									$selected = 'selected="selected"';
								}else{
									$selected = '';
								}
						?>
								<option value="<?php echo $client->id; ?>" onClick="$('#ss-outlet-type').val(1);" <?php echo $selected; ?> ><?php echo $client->company_name; ?> </option> 
							<?php }
						}?>
						<?php if($outlet_list){
							foreach($outlet_list as $outlet){ 
								if($selectOutlet == true && $rider_duty->outlet_id == $outlet->id){
									$selected = 'selected="selected"';
								}else{
									$selected = '';
								}
						?>
								<option value="<?php echo $outlet->id; ?>" onClick="$('#ss-outlet-type').val(2);" <?php echo $selected;?> ><?php echo $outlet->name; ?> </option>
							<?php }
						} ?>
					</select>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Select Rider</label>
                  <div class="col-lg-8"> 
					<select name="rider-id" value="<?php echo set_value('rider-id'); ?>" data-required="true" class="form-control"> 
						<option></option>
						<?php if($rider_list){
							foreach($rider_list as $rider){
								if($rider_duty->rider_id == $rider->id){
									$selected = 'selected="selected"';
								}else{
									$selected = '';
								}
								
								echo '<option value="'.$rider->id.'"'.$selected.'>'.$rider->name.'</option>';
							}
						}?>
					</select>
                  </div>
                </div>
				<div class="form-group">
                  <input type="hidden" name="ss-base-url" class="form-control" id="ss-base-url" value="<?php echo base_url();?>"/>
                  <input type="hidden" name="ss-outlet-type" class="form-control" id="ss-outlet-type" value=""/>
                </div>
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">                      
                    <a href="<?php echo site_url();?>riderduty" class="btn btn-danger">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Update">
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </section>
  </section>
 