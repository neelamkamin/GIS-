
<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charrshet="UTF-8">
  <title>REPORT MANAGEMENT SYSTEM</title>
  
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/kamin.css") ?>"
</head>
<body>
 <button class="btn" style="float:right"><a href="<?php echo site_url("Admin/show_cost") ?>">Home</a></button>
 <button class="btn" style="float:center"><a href="<?php echo site_url("login/user_detail") ?>">Depts. Detail</a></button>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      </br></br>
<font color="light-blue"; size="2%;">
 <h1 align="center"><I>CHANGE PASSWORD HERE</I></h1>
    
</div>
     
    
</nav>
<nav align-text="center">

<div class="container" align="center">
<!--<form class="form-horizontal" action="">!-->
  <div class="col-lg-6">
	<?php echo form_open('Login/updatePwd',['class'=>'form-horizontal']) ?>
</div>
  <fieldset>
    <legend></legend>

    <div class="row">
      <div align="center" class="col-lg-10">
    		<div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label" align="left">Current Password</label>
    
      <div class="col-lg-4">

 <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
      echo form_password(['name'=>'pass','id'=>'inputPassword','class'=>"form-control",'placeholder'=>'Enter Current Password']); 
  ?> 

        <!--<input type="text" size="50" class="form-control-plaintext" id="staticEmail" placeholder="Enter Username">!-->
      </div>
  	</div>
    </div>
    <div class="col-lg-10">
    		<?php 
    			echo form_error('password'); 
    		?>
    <div align="center" class="col-lg-10">
      <label for="exampleInputPassword1">New Password</label>
      <div class="col-lg-6">

      <?php //HERE WE R USING FORM_INPUT INBUILT FUNCTION OF CODEIGNITER*//
      echo form_password(['name'=>'newpass','id'=>'inputPassword','class'=>'form-control','placeholder'=>'Enter New password']);
       ?>

      <?php echo form_error('newpass','<div class="text-danger">','</div>'); ?>

      <!--<input type="password" size="40" class="form-control" id="exampleInputPassword1" placeholder="Enter Password"> !-->
    </div>
     <!-- <button type="reset" class="btn btn-primary">Reset</button> !-->
 <div class="row">
      <div align="center" class="col-lg-10">
        <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label" align="left">Confirm Password</label>
    
      <div class="col-lg-8">

 <?php echo form_password(['name'=>'confpassword','id'=>'inputPassword','class'=>'form-control','placeholder'=>'Enter Confirm Password']);  ?>

<?php echo form_error('confpassword','<div class="text-danger">','</div>'); ?>

        <!--<input type="text" size="50" class="form-control-plaintext" id="staticEmail" placeholder="Enter Username">!-->
      </div>
    </div>
    </div>
    <br>
  <?php 
		echo form_submit(['name'=>'submit','value'=>'Change Password','class'=>'btn btn-primary']);
     ?>
 <?php echo form_close(); ?>


</nav>
  </fieldset>
</form>
</div></div></div></div></fieldset></div></nav></font></div></div></nav>
</body>
</head>
</html>

