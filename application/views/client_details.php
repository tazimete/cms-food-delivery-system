<div class="row" style="margin-top: 60px;">
        <div class="col-sm-6 col-sm-offset-3 portlet ui-sortable">
          <header style="text-align: center; margin-bottom: 30px;"> <h3><strong>View Client Details</strong></h3></header>
		  <?php if(count($client_list) > 0) { 
				foreach($client_list as $client) { ?> 
          <section class="panel portlet-item" style="opacity: 1;">
            <header class="panel-heading">
              <ul class="nav nav-pills pull-right">
                <li>
                  <a class="panel-toggle text-muted" href="#"><i class="fa fa-caret-down fa-lg text-active"></i><i class="fa fa-caret-up fa-lg text"></i></a>
                </li>
              </ul>
			  <h4> <strong> <?php echo $client->company_name; ?></strong></h4>
            </header>
            <section class="panel-body" style="height:auto">
              <article class="media">
                <div class="media-body">
                 <!-- <a class="h4" href="#">Bootstrap 3.0 is comming</a>
                  <small class="block">Sleek, intuitive, and powerful mobile-first front-end framework for faster and easier web development.</small>-->
				<p><span class="h4">Company Name : </span>
				<span class="h4"><?php echo $client->company_name; ?> </span> </p><br />
				<p><span class="h4">Location : </span>
				<span class="h4"><?php echo $client->location; ?> </span> </p><br />
				<p><span class="h4">Contact Number : </span>
				<span class="h4"><?php echo $client->contact_number; ?> </span> </p><br />
				<p><span class="h4">Billing Address : </span>
				<span class="h4"><?php echo $client->billing_address; ?> </span> </p><br />
				<p><span class="h4">Contact Person Name : </span>
				<span class="h4"><?php echo $client->contact_person_name; ?> </span> </p><br />
				<p><span class="h4">Contact Person Number : </span>
				<span class="h4"><?php echo $client->contact_person_number; ?> </span> </p><br />
				<p><span class="h4">Contact Person Address : </span>
				<span class="h4"><?php echo $client->contact_person_address; ?> </span> </p><br />
				<p><span class="h4">Created Date : </span>
				<span class="h4"><?php echo $client->created_date; ?> </span> </p><br />
				<p><span class="h4">Client Type : </span>
				<span class="h4"><?php echo ucfirst($client->client_type); ?> </span> </p><br />
			  </div>
              </article>             
            </section>
          </section>
				<?php } } ?>
        </div>
      </div>