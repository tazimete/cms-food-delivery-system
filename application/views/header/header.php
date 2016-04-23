<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $title; ?> </title>
  <meta name="description" content="mobile first, app, web app, responsive, admin dashboard, flat, flat ui">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	
	<link rel="stylesheet" href="<?php echo base_url();?>static/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url();?>static/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>static/css/font.css">
  <link rel="stylesheet" href="<?php echo base_url();?>static/css/plugin.css">
  <link rel="stylesheet" href="<?php echo base_url();?>static/css/style.css">
  <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>static/js/ie/respond.min.js"></script>
    <script src="<?php echo base_url();?>static/js/ie/html5.js"></script>
    <script src="<?php echo base_url();?>static/js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body>
  <!-- header -->
	<header id="header" class="navbar">
    <ul class="nav navbar-nav navbar-avatar pull-right">
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">            
          <span class="hidden-xs-only"><?php echo $this->session->userdata('user_name'); ?></span>
          <span class="thumb-small avatar inline"><img src="<?php echo base_url();?>static/images/profile-pictures/pp-icon.png" alt="Mika Sokeil" class="img-circle"></span>
          <b class="caret hidden-xs-only"></b>
        </a>
        <ul class="dropdown-menu pull-right">
          <li><a href="#">Update</a></li>
          <li><a href="#">Profile</a></li>
          <li><a href="<?php echo site_url();?>dashboard/logout">Logout</a></li>
        </ul>
      </li>
    </ul>
    <a class="navbar-brand col-lg-2" href="<?php echo site_url();?>dashboard">SmartSend</a>
    <button type="button" class="btn btn-link pull-left nav-toggle visible-xs" data-toggle="class:slide-nav slide-nav-left" data-target="body">
      <i class="fa fa-bars fa-lg text-default"></i>
    </button>
    <ul class="nav navbar-nav hidden-xs">
      <li>
		<div class="m-t-small">
			<a class="btn btn-sm btn-info" data-toggle="dropdown" href=""><i class="fa fa-fw fa-plus"></i> Add</a>
			<ul class="dropdown-menu">
				<li><a href="<?php echo site_url();?>client/add_client_restaurant_page">Restaurant</a></li>
				<li><a href="<?php echo site_url();?>client/add_client_company_page">Company</a></li>
				<li><a href="<?php echo site_url();?>outlet/add_outlet_page">Outlet</a></li>
				<li><a href="<?php echo site_url();?>rider/add_rider_page">Rider</a></li>
				<li><a href="<?php echo site_url();?>riderduty/add_rider_duty_page">Rider Duty</a></li>
			</ul>
		</div>
	  </li>
      <!-- <li class="dropdown shift" data-toggle="shift:appendTo" data-target=".nav-primary .nav">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog fa-lg visible-xs visible-xs-inline"></i>Settings <b class="caret hidden-sm-only"></b></a>
        <ul class="dropdown-menu">
          <li>
            <a href="#" data-toggle="class:navbar-fixed" data-target='body'>Navbar 
              <span class="text-active">auto</span>
              <span class="text">fixed</span>
            </a>
          </li>
          <li class="hidden-xs">
            <a href="#" data-toggle="class:nav-vertical" data-target="#nav">Nav 
              <span class="text-active">vertical</span>
              <span class="text">horizontal</span>
            </a>
          </li>
          <li class="divider hidden-xs"></li>
          <li class="dropdown-header">Colors</li>
          <li>
            <a href="#" data-toggle="class:bg bg-black" data-target='.navbar'>Navbar 
              <span class="text-active">white</span>
              <span class="text">inverse</span>
            </a>
          </li>
          <li>
            <a href="#" data-toggle="class:bg-light" data-target='#nav'>Nav 
              <span class="text-active">inverse</span>
              <span class="text">light</span>
            </a>
          </li>
        </ul>
      </li> -->
    </ul>
    <!-- <form class="navbar-form pull-left shift" action="" data-toggle="shift:prependTo" data-target=".nav-primary">
      <i class="fa fa-search text-muted"></i>
      <input type="text" class="input-sm form-control" placeholder="Search">
    </form> -->
	</header>
  <!-- / header -->