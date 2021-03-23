<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charrshet="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Project Report Management System</title>
	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/kamin.css") ?>">
</head>
<body>
 
<!-- Navbar menu Start here !-->
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo site_url("Admin/show_cost") ?>">HOME</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="<?php echo site_url("User/task_list") ?>">MY TASK</a></li>
        <li><a href="<?php echo site_url("Admin/show_category") ?>">FUND CATEGORY</a></li>
        <li><a href="<?php echo site_url("User/extra") ?>">IN_CHARGE LIST</a></li>
        <li><a href="<?php echo site_url('User') ?>">All PROJECT</a></li>
        <li><a href="<?php echo site_url('Admin/dashboard') ?>">DASHBOARD</a></li>
        <li><a href="<?php echo site_url("Login/updatePwd") ?>">A/C SETTING</a></li>
    </ul>
    
    <?= form_open('user/search',['class'=>'form-inline my-2 my-lg-0','role'=>'search']); ?>
    <input type="text" name="query" class="form-control mr-sm-4" size="30" type="text" placeholder="Enter Project Name">
     <button class="btn btn-default" type="submit">Search</button>
    <?= form_close(); ?>
    <?= form_error('query',"<p class='navbar-text'>",'</p>') ?>

    <button class="btn btn-default" style="float:right"><a href="<?php echo site_url("login/logout") ?>">Logout</a>
    </button>
  </div>
 </div>
</nav>
<!-- Navbar menu End here !-->
  
  	


