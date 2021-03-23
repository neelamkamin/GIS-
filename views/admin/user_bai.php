<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>DEPT._DETAIL</title>
	<link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/kamin.css") ?>">
</head>
<body>
<button class="btn" style="float:right"><a href="<?php echo site_url("login/logout") ?>">Logout</a></button>
 <button class="btn btn-default" style="float:left"><a href="<?php echo site_url("Admin/show_cost") ?>">Home</a></button>
<nav class="navbar navbar-default">
    <div class="container">
      <div class="navbar-header">

 <!--FONT COLOR & SIZE SETTING BELOW !-->   

<font color="light-blue";>

 <!--FONT COLOR & SIZE SETTING ABOVE !-->  

 <h1 align="center"><I>REGISTERED DEPARTMENT DETAILS :</I></h1>   
</div>         
</nav>
	 <nav class="navbar navbar-default">
  	<div class="container">
  		<div class="navbar-header">
        <div class="col-lg-12">
	<table class="table table-hover">
		<thead align="center">
			<th>Sl.no</th>
			<th>Name of the Official</th>
			<th>Contact</th>
	
		</thead>
		<tbody>

		<?php 
			if($usr->num_rows() >0):
			$count = $this->uri->segment(3,0); 
			foreach($usr->result() as $pow): 
		?>
			<tr>
					<td align="center"> <?= ++$count ?>  </td>

					<td>  <?= $pow->id ; ?> </td>
					<td align="center">  <?= $pow->Mobile_no ; ?> </td>
					

			</tr>
			<?php endforeach;  ?>

			<?php else:  ?>
				<tr>
					<td colspan="3">NO RECORD FOUND</td>
				</tr>

			<?php endif;   ?>
			
		</tbody>
	</table>
</div></div></div></nav>

<?php include_once('admin_footer.php'); ?>