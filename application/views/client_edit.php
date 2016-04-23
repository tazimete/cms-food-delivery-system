
  <section id="content">
    <section class="main padder">
      <div class="clearfix">
        <h3><i class="fa fa-edit"></i><?php echo $form_name ?></h3>
      </div>
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
          <section class="panel">
            <div class="panel-body">
              <form action="<?php echo site_url();?>client/edit_client_by_id/<?php echo $client_data->id;?>" class="form-horizontal" method="post" data-validate="parsley"> 
				<div class="form-group">
                  <label class="col-lg-3 control-label">Compnay Name</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-company-name" value="<?php echo $client_data->company_name; ?>" placeholder="Company Name" data-required="true" class="form-control">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Company Email</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-company-email" value="<?php echo $client_data->email; ?>" placeholder="test@example.com" class="bg-focus form-control" data-required="true" data-type="email">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Company Password</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-company-password" value="<?php echo $client_data->password; ?>" placeholder="Password" class="form-control" data-required="true">
				  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Postal Code</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-postal-code" value="<?php echo $client_data->company_postal_code; ?>" placeholder="Postal Code" class="form-control" id="client-postal-code" data-required="true" maxlength="6">
					<span class="form-error" id="form-error" style="color:red;"></span>
				  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Location</label>
                  <div class="col-lg-8">
					<input type="text" name="client-company-location" value="<?php echo $client_data->location; ?>" placeholder="Location" data-required="true" class="form-control" id="client-company-location" readonly>
				  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Unite Number</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-unite-number" value="<?php echo $client_data->company_unit_number; ?>" placeholder="#00-00" class="form-control" id="client-unite-number" data-required="true">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Contact Number</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-contact-number" value="<?php echo $client_data->contact_number; ?>" placeholder="Conatct Number" data-required="true" class="form-control">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Billing Address</label>
                  <div class="col-lg-8">
                    <textarea name="client-billing-address-name" placeholder="Billing Address" rows="5" class="form-control" data-trigger="keyup" data-rangelength="[20,200]"><?php echo $client_data->billing_address; ?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-12" style="text-align: center; font-size: 15px; margin-top: 10px;">Contact Person Details</label>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Name</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-cp-name" value="<?php echo $client_data->contact_person_name; ?>" placeholder="Contact Person Name" data-required="true" class="form-control">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Number</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-cp-number" value="<?php echo $client_data->contact_person_number; ?>" placeholder="+xx-xxxxxxxx" data-required="true" class="form-control">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Email</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-cp-email" value="<?php echo $client_data->contact_person_email; ?>" placeholder="test@example.com" class="bg-focus form-control" data-required="true" data-type="email">
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Postal Code</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-cp-postal-code" value="<?php echo $client_data->contact_person_postal_code; ?>" placeholder="Postal Code" class="form-control" id="client-cp-postal-code" data-required="true" maxlength="6">
					<span class="form-error-cp" id="form-error-cp" style="color:red;"></span>
				  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-3 control-label">Address</label>
                  <div class="col-lg-8">
                    <textarea name="client-cp-address" value="<?php echo $client_data->contact_person_address; ?>" placeholder="Billing Address" class="form-control" id="client-cp-address" rows="5" data-required="true" readonly > <?php echo $client_data->contact_person_address; ?></textarea>
                  </div>
                </div>
				<div class="form-group">
                  <label class="col-lg-3 control-label">Unite Number</label>
                  <div class="col-lg-8">
                    <input type="text" name="client-cp-unite-number" value="<?php echo $client_data->contact_person_unit_number; ?>" placeholder="#00-00" class="form-control" id="client-cp-unite-number" data-required="true">
                  </div>
                </div>
				<div class="form-group">
                  <input type="hidden" name="client-type" class="form-control" value="<?php echo $client_data->client_type; ?>"/>
				  <input type="hidden" name="ss-base-url" class="form-control" id="ss-base-url" value="<?php echo base_url();?>"/>
                </div>
                <div class="form-group">
                  <div class="col-lg-9 col-lg-offset-3">                      
                    <a href="<?php echo site_url();?>client" class="btn btn-danger">Cancel</a>
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
 