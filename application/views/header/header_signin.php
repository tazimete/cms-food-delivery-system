<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo $title; ?></title>
  <meta name="description" content="mobile first, app, web app, responsive, admin dashboard, flat, flat ui">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <link rel="stylesheet" href="<?php echo base_url();?>static/css/bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url();?>static/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>static/css/font.css">
  <link rel="stylesheet" href="<?php echo base_url();?>static/css/style.css">
  <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>static/js/ie/respond.min.js"></script>
    <script src="<?php echo base_url();?>static/js/ie/html5.js"></script>
  <![endif]-->
</head>
<body>
  <!-- header -->
  <header id="header" class="navbar bg bg-black">
    <a href="<?php echo current_url();?>" class="btn btn-link pull-right m-t-mini"><i class="fa fa-user-md fa-lg text-default"></i></a>
    <a class="navbar-brand" href="<?php echo current_url();?>">SmartSend</a>
  </header>
  <!-- / header -->