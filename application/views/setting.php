
  <section id="content">
    <section class="main padder">
      <div class="clearfix">
        <h3><i class="fa fa-edit"></i><?php echo $form_name ?></h3>
      </div>
	  <?php if(isset($success_message)) {
				 echo '<div class="success-message">'.$success_message.'</div>';
			 }else if(isset($failed_message)) {
				 echo '<div class="failed-message">'.$failed_message.'</div>';
			 }?>
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
          <section class="panel">
            <div class="panel-body">
              <form action="<?php echo site_url();?>option_controller/add_option" class="form-horizontal" method="post" data-validate="parsley"> 
				<?php echo validation_errors(); ?>
				<?php 
					$smartSend = & get_instance(); 
					$smartSend->load->model('client_model', 'ClientModel');
					$smartSend->load->model('rider_model', 'RiderModel');
					$smartSend->load->model('outlet_model', 'OutletModel'); 
					$smartSend->load->model('option_model', 'OptionModel'); 
				?>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Maximum Distance For Deliver Address (km)</label>
                  <div class="col-lg-8">
                    <input type="text" name="max-distance-order" value="<?php $option = $smartSend->OptionModel->get_option_by_key('max-distance-order'); if($option){ echo $option;}else{echo 0;}?>" placeholder="Distance in km" data-required="true" class="form-control" data-type="number"> 
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Maximum Distance For Rider (km)</label>
                  <div class="col-lg-8">
                    <input type="text" name="max-distance-rider" value="<?php $option = $smartSend->OptionModel->get_option_by_key('max-distance-rider'); if($option){ echo $option;}else{echo 0;}?>" placeholder="Distance in km" class="bg-focus form-control" data-required="true" data-type="number">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">                      
                    <a href="{{URL::to('/admin_panel/index')}}dashboard" class="btn btn-danger">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Apply">
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </section>
  </section>
 
