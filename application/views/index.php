

  <section id="content">
    <section class="main padder">
      <div class="row">
        <div class="col-lg-12">
          <section class="toolbar clearfix m-t-large m-b">
            <!-- <a href="mail.html" class="btn btn-white btn-circle"><i class="fa fa-envelope-o"></i>Inbox <b class="badge bg-white">5</b></a> -->
            <a href="<?php echo site_url();?>client" class="btn btn-primary btn-circle"><i class="fa fa-users fa-lg"></i><strong>Client</strong></a>
            <a href="<?php echo site_url();?>outlet" class="btn btn-info btn-circle"><i class="fa fa-qrcode fa-lg"></i><strong>Outlet</strong></a>
            <a href="<?php echo site_url();?>rider" class="btn btn-success btn-circle"><i class="fa fa-truck fa-lg"></i><strong>Rider</strong></a>
			 <a href="<?php echo site_url();?>riderduty" class="btn btn-warning btn-circle"><i class="fa fa-calendar-o"></i><strong>Duty Of Rider</strong></a>
            <!--<a href="#" class="btn btn-info btn-circle active"><i class="fa fa-clock-o"></i>Timeline<b class="badge bg-info"><i class="fa fa-plus"></i></b></a> -->
            <a href="<?php echo site_url();?>rider" class="btn btn-inverse btn-circle"><i class="fa fa-bar-chart-o"></i><strong>Order</strong></a>
            <a href="<?php echo site_url();?>user" class="btn btn-danger btn-circle"><i class="fa fa-user fa-lg"></i> <strong>User</strong></a>
            <!-- <a href="#" class="btn btn-circle"><i class="fa fa-plus"></i>More</a> -->
          </section>
        </div>
        <div class="col-lg-6">
          <div class="row">
            <!-- easypiechart -->
            <div class="col-xs-6">              
              <section class="panel">
                <header class="panel-heading bg-white">
                  <div class="text-center h5"><strong>Client</strong></div>
                </header>
                <div class="panel-body pull-in text-center">
                  <div class="inline">
                    <div class="easypiechart" data-percent="<?php if($number_of_client){echo $number_of_client;}else{echo 0;} ?>" data-loop="false">
                      <span class="h2" style="margin-left:10px;margin-top:10px;display:inline-block"><?php if($number_of_client){echo $number_of_client;}else{echo 0;} ?></span>
					   <div class="easypie-text text-muted">Client</div>
                      <!--<div class="easypie-text"><button class="btn btn-link m-t-n-small" data-toggle="class:pie"><i class="fa fa-play text-active text-muted"></i><i class="fa fa-pause text text-muted"></i></button></div>-->
                    </div>
                  </div>
                </div>
              </section>
            </div>
            <div class="col-xs-6">
              <section class="panel">
                <header class="panel-heading bg-white">
                  <div class="text-center h5"><strong>Rider</strong></div>
                </header>
                <div class="panel-body pull-in text-center">
                  <div class="inline">
                    <div class="easypiechart" data-percent="<?php if($number_of_rider){echo $number_of_rider;}else{echo 0;} ?>" data-bar-color="#576879">
                      <span class="h2" style="margin-left:10px;margin-top:10px;display:inline-block"><?php if($number_of_rider){echo $number_of_rider;}else{echo 0;} ?></span>
                      <div class="easypie-text text-muted">Rider</div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
            <!-- easypiechart end-->
          </div>
		  <div class="row">
            <!-- easypiechart -->
            <div class="col-xs-6">              
              <section class="panel">
                <header class="panel-heading bg-white">
                  <div class="text-center h5"><strong>Outlet</strong></div>
                </header>
                <div class="panel-body pull-in text-center">
                  <div class="inline">
                    <div class="easypiechart" data-percent="<?php if($number_of_outlet){echo $number_of_outlet;}else{echo 0;} ?>" data-loop="false">
                      <span class="h2" style="margin-left:10px;margin-top:10px;display:inline-block"><?php if($number_of_rider){echo $number_of_rider;}else{echo 0;} ?></span>
					   <div class="easypie-text text-muted">Outlet</div>
                      <!--<div class="easypie-text"><button class="btn btn-link m-t-n-small" data-toggle="class:pie"><i class="fa fa-play text-active text-muted"></i><i class="fa fa-pause text text-muted"></i></button></div>-->
                    </div>
                  </div>
                </div>
              </section>
            </div>
            <div class="col-xs-6">
              <section class="panel">
                <header class="panel-heading bg-white">
                  <div class="text-center h5"><strong>Order</strong></div>
                </header>
                <div class="panel-body pull-in text-center">
                  <div class="inline">
                    <div class="easypiechart" data-percent="75" data-bar-color="#576879">
                      <span class="h2" style="margin-left:10px;margin-top:10px;display:inline-block">75</span>
                      <div class="easypie-text text-muted">Order</div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
            <!-- easypiechart end-->
          </div>
          <section class="panel">
            <div class="panel-body text-muted l-h-2x">
              <span class="badge"><?php if($number_of_client){echo $number_of_client;}else{echo 0;} ?></span>
              <span class="m-r-small">Clients</span>
              <span class="badge bg-success"><?php if($number_of_rider){echo $number_of_rider;}else{echo 0;} ?></span>
              <span class="m-r-small">Riders</span>
              <span class="badge"><?php if($number_of_outlet){echo $number_of_outlet;}else{echo 0;} ?></span>
              <span class="m-r-small">Outlets</span>
              <span class="badge">0</span> Order
            </div>
          </section>
        </div>
        <div class="col-lg-6">
          <!-- sparkline stats -->
          <section class="panel">
            <header class="panel-heading">
              <ul class="nav nav-pills pull-right">
                <li><a href="#" data-loading-text="loading..."><i class="fa fa-retweet"></i></a></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="text">Day</span> <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu pull-right">
                    <li class="active"><a href="#">Day</a></li>
                    <li><a href="#">Week</a></li>
                    <li><a href="#">Month</a></li>
                  </ul>
                </li>
              </ul>
              <span>Snapshot</span>
            </header>
            <ul class="list-group">
              <li class="list-group-item">
                <div class="media">
                  <div class="pull-left text-center media-large">
                    <div class="h4 m-t-mini"><strong>890</strong></div>
                    <small class="text-muted">Total views</small>              
                  </div>
                  <div class="pull-right hidden-sm text-right m-t">
                    <b class="badge bg-info" data-toggle="tooltip" data-title="New">250</b>
                  </div>
                  <div class="media-body">
                    <div class="sparkline" data-type="bar" data-bar-color="#8e98a9" data-bar-width="10" data-height="28"><!--20,10,15,21,12,5,21,30,24,15,8,19--></div>
                    <ul class="list-inline text-muted axis"><li>12<br>a</li><li>2</li><li>4</li><li>6</li><li>8</li><li>10</li><li>12<br>p</li><li>2</li><li>4</li><li>6</li><li>8</li><li>10</li></ul>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="pull-left text-center media-large">
                    <div class="h4 m-t-mini"><strong>$4,800</strong></div>
                    <small class="text-muted">Revenue</small>
                  </div>
                  <div class="pull-right hidden-sm text-right m-t">
                    <b class="badge bg-success" data-toggle="tooltip" data-title="Captured">$4,000</b>
                  </div>
                  <div class="media-body">
                    <div class="sparkline" data-type="bar" data-bar-color="#13c4a5" data-bar-width="10" data-height="28"><!--200,400,500,100,90,1200,1500,1000,800,500,80,50--></div>
                    <ul class="list-inline text-muted axis"><li>12<br>a</li><li>2</li><li>4</li><li>6</li><li>8</li><li>10</li><li>12<br>p</li><li>2</li><li>4</li><li>6</li><li>8</li><li>10</li></ul>
                  </div>
                </div>
              </li>
              <li class="list-group-item">
                <div class="media">
                  <div class="pull-left text-center media-large">
                    <div class="h4 m-t-mini"><strong>595</strong></div>
                    <small class="text-muted">Orders</small>
                  </div>
                  <div class="pull-right hidden-sm text-right m-t">
                    <b class="badge" data-toggle="tooltip" data-title="Awaiting">120<i class="fa fa-plane"></i></b>
                  </div>
                  <div class="media-body">
                    <div class="sparkline" data-type="bar" data-bar-color="#61a1e1" data-bar-width="10" data-height="28"><!--15,21,30,24,15,8,19,20,10,15,21,12--></div>
                    <ul class="list-inline text-muted axis"><li>12<br>a</li><li>2</li><li>4</li><li>6</li><li>8</li><li>10</li><li>12<br>p</li><li>2</li><li>4</li><li>6</li><li>8</li><li>10</li></ul>
                  </div>
                </div>
              </li>
            </ul>
          </section>
          <!-- sparkline stats end -->
        </div>        
      </div>
    </section>
  </section>
  <!-- .modal -->
  <div id="modal" class="modal fade">
    <form class="m-b-none">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i></button>
            <h4 class="modal-title" id="myModalLabel">Post your first idea</h4>
          </div>
          <div class="modal-body">          
            <div class="block">
              <label class="control-label">Title</label>
              <input type="text" class="form-control" placeholder="Post title">
            </div>
            <div class="block">
              <label class="control-label">Content</label>
              <textarea class="form-control" placeholder="Content" rows="5"></textarea>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox"> Share with all memebers of first
              </label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Save</button>
            <button type="button" class="btn btn-sm btn-primary" data-loading-text="Publishing...">Publish</button>
          </div>
        </div><!-- /.modal-content -->
      </div>
    </form>
  </div>
  <!-- / .modal -->
  