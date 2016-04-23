
  <section id="content">
    <section class="main padder">
      <div class="clearfix">
        <h3><i class="fa fa-edit"></i><?php echo $form_name ?></h3>
      </div>
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <section class="panel">
            <div class="panel-body">
              <form action="<?php echo site_url();?>client/add_client" class="form-horizontal" method="post" data-validate="parsley"> 
				<?php echo validation_errors(); ?>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Compnay Name</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-company-name" value="<?php echo set_value('client-company-name'); ?>" placeholder="Company Name" data-required="true" class="form-control">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Company Email</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-company-email" value="<?php echo set_value('client-company-email'); ?>" placeholder="test@example.com" class="bg-focus form-control" data-required="true" data-type="email">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Company Password</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-company-password" value="<?php echo set_value('client-company-password'); ?>" placeholder="Password" class="form-control" data-required="true" autocomplete="off">
				  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Postal Code</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-postal-code" value="<?php echo set_value('client-postal-code'); ?>" placeholder="Postal Code" class="form-control" id="client-postal-code" data-required="true" maxlength="6" autocomplete="off">
					<span class="form-error" id="form-error" style="color:red;"></span>
				  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Location</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-company-location" value="<?php echo set_value('client-company-location'); ?>" placeholder="Location" data-required="true" class="form-control" id="client-company-location" readonly>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Unite Number</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-unite-number" value="<?php echo set_value('client-unite-number'); ?>" placeholder="#00-00" class="form-control" id="client-unite-number" data-required="true" autocomplete="off">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Contact Number</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-contact-number" value="<?php echo set_value('client-contact-number'); ?>" placeholder="Conatct Number" data-required="true" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Billing Address</label>
                  <div class="col-lg-8">
                    <textarea name="client-billing-address" placeholder="Billing Address" class="form-control" id="client-billing-address" rows="5" data-required="true"> <?php echo set_value('client-billing-address'); ?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-12" style="text-align: center; font-size: 15px; margin-top: 10px;">Contact Person Details</label>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Name</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-cp-name" value="<?php echo set_value('client-cp-name'); ?>" placeholder="Contact Person Name" data-required="true" class="form-control">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Number</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-cp-number" value="<?php echo set_value('client-cp-number'); ?>" placeholder="+xx-xxxxxxxx" data-required="true" class="form-control">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Email</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-cp-email" value="<?php echo set_value('client-cp-email'); ?>" placeholder="test@example.com" class="bg-focus form-control" data-required="true" data-type="email">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Postal Code</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-cp-postal-code" value="<?php echo set_value('client-cp-postal-code'); ?>" placeholder="Postal Code" class="form-control" id="client-cp-postal-code" data-required="true" maxlength="6" autocomplete="off">
					<span class="form-error-cp" id="form-error-cp" style="color:red;"></span>
				  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Address</label>
                  <div class="col-lg-8">
                    <textarea name="client-cp-address" placeholder="Billing Address" class="form-control" id="client-cp-address" rows="5" data-required="true" readonly > <?php echo set_value('client-cp-address'); ?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Unite Number</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-cp-unite-number" value="<?php echo set_value('client-cp-unite-number'); ?>" placeholder="#00-00" class="form-control" id="client-cp-unite-number" data-required="true" autocomplete="off">
                  </div>
                </div>
				<div class="form-group">
                  <input type="hidden" name="client-type" class="form-control" value="<?php echo $client_type;?>"/>
                  <input type="hidden" name="ss-base-url" class="form-control" id="ss-base-url" value="<?php echo base_url();?>"/>
                </div>
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">                      
                    <a href="<?php echo site_url();?>client" class="btn btn-danger">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Add">
                  </div>
                </div>
              </form>
            </div>
          </section>
        </div>
      </div>
    </section>
  </section>
 