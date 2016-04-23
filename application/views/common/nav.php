  <!-- nav -->
  <nav id="nav" class="nav-primary hidden-xs nav-vertical">
    <ul class="nav" data-spy="affix" data-offset-top="50">
      <li class="active"><a href="<?php echo site_url();?>dashboard"><i class="fa fa-dashboard fa-lg"></i><span>Dashboard</span></a></li>
      <li class="dropdown-submenu">
        <a href="<?php echo site_url();?>client"><i class="fa fa-users fa-lg"></i><span> Client </span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo site_url();?>client/client_restaurant_page">Restaurant</a></li>
          <li><a href="<?php echo site_url();?>client/client_company_page">Company</a></li>
          <li><a href="<?php echo site_url();?>client/client_report_page">Reports</a></li>
        </ul>
      </li>
	  <li class="dropdown-submenu">
        <a href="<?php echo site_url();?>outlet"><i class="fa fa-qrcode fa-lg"></i><span>Outlet</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo site_url();?>outlet">All Outlets</a></li>
          <li><a href="<?php echo site_url();?>outlet/add_outlet_page">Add New Outlet</a></li>
          <li><a href="<?php echo site_url();?>outlet">Reports</a></li>
        </ul>
      </li>
      <li class="dropdown-submenu">
        <a href="<?php echo site_url();?>rider"><i class="fa fa-truck fa-lg"></i><span>Rider</span></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo site_url();?>rider">All Riders</a></li>
          <li><a href="<?php echo site_url();?>rider/add_rider_page">Add New Rider</a></li>
          <li><a href="<?php echo site_url();?>riderduty">Duty Of Riders</a></li>
          <li><a href="<?php echo site_url();?>rider">Reports</a></li>
        </ul>
      </li>
      <li class="dropdown-submenu">
		<a href="<?php echo site_url();?>order"><i class="fa fa-bar-chart-o fa-lg"></i><span>Order</span></a>
		<ul class="dropdown-menu">
          <li><a href="<?php echo site_url();?>order">All Orders</a></li>
          <li><a href="<?php echo site_url();?>order">Reports</a></li>
        </ul>
	  </li>
	  <li class="dropdown-submenu">
		<a href="<?php echo site_url();?>rider"><i class="fa fa-user fa-lg"></i><span>User</span></a>
		<ul class="dropdown-menu">
          <li><a href="<?php echo site_url();?>rider">All Users</a></li>
          <li><a href="<?php echo site_url();?>rider/add_rider_page">Add New User</a></li>
        </ul>
	  </li>
	  <li class="dropdown-submenu">
		<a href="<?php echo site_url();?>option_controller"><i class="fa fa-cog fa-lg"></i><span>Settings</span></a>
	  </li>
    </ul>
  </nav>
  <!-- / nav -->