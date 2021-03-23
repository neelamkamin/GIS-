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
      <a class="navbar-brand" href="<?php echo site_url("Admin/show_cost") ?>">Home</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="<?php echo site_url("User/task_list") ?>">My Task</a></li>
        <li><a href="<?php echo site_url("Admin/show_category") ?>">Categogy of Fund</a></li>
        <li><a href="<?php echo site_url("User/extra") ?>">In_Charge List</a></li>
        <li><a href="<?php echo site_url('User') ?>">All Project List</a></li>
        <li><a href="<?php echo site_url('Admin/dashboard') ?>">Dashboard</a></li>
        <li><a href="<?php echo site_url("Login/updatePwd") ?>">A/C Setting</a></li>
    </ul>
    <button class="btn btn-default" style="float:right"><a href="<?php echo site_url("login/logout") ?>">Logout</a>
    </button>
  </div>
 </div>
</nav>
<!-- Navbar menu End here !-->

<br><br>
<table align="center" class="table table-hover">
   <form action="" method="post">
<tr>
	<th style="color: red">PROJECT IN-CHARGE NAME :-</th>
	  <td>
		<select name="dept">
			<option value="">Choose any</option>
			<option value="Neelam_kamin-PC">Neelam_kamin-PC</option>
			<option value="Goter_Duchi_PO">Goter_Duchi-PO</option>
			<option value="Tumken_Amo-PC">Tumken_Amo-PC</option>
			<option value="Techi_Tado-TA">Techi_Tado-TA</option>
			<option value="Yater_Pari-ASST-DIR">Yater_Pari-ASST-DIR</option>
			<option value="Banya_Boje-PO">Banya_Boje-PO</option>
			<option value="Namgey_Wangmu-PO">Namgey_Wangmu-PO</option>
			<option value="Duyu_Ampa-PO">Duyu_Ampa-PO</option>
			<option value="Nyayo_Ete-SEMT">Nyayo_Ete-SEMT</option>
			<option value="Kembi_Ete-RO">Kembi_Ete-RO</option>
			<option value="Sangey_Drema-TA">Sangey_Drema-TA</option>
			<option value="Pinge_Doji-SEMT">Pinge_Doji-SEMT</option>
			<option value="Toko_Tulo-PC">Toko_Tulo-PC</option>
		</select>
	</td>
	
<td colspan="2" align="right"><input type="submit" name="submit" value="Search"/></td>
 </tr>	
  </form>
   </table>
          <br>
<table align="center" width="100%" border="1" style="margin-top: 10px;">
	<tr style="background-color:#cafbed; color:blue;">
		<th style="text-align: center;">Sl No.</th>
		<th style="text-align: center;">Project Name</th>
		<th style="text-align: center;">Description/Status</th>
		<th style="text-align: center;">Remarks</th>
		<th style="text-align: center;">Project Cost (In Lakhs)</th>
		<th style="text-align: center;">Expen -diture (In Lakhs)</th>
		<th style="text-align: center;">Balance (In Lakhs)</th>
		<td style="text-align: center;"><b>CATEGORY</b></td>
		<td style="text-align: center;"><b>PRINT</b></td>
	</tr>
<?php
	if(isset($_POST['submit']))
	{
	include('dbcon.php');
	$mm = $_POST['dept']; //THIS 'dept' IS RECEIVED FROM '<select name="dept">' FROM LINE NO.-23 ABOVE//
	
	$sql="SELECT * FROM `articles` WHERE user_id='$mm' ORDER BY id DESC";
	$run = mysqli_query($conn,$sql);

	if(mysqli_num_rows($run)<1)
	{
		echo "<tr><td colspan='5'>No Records Found</td></tr>";	
	}
	else
	{
		$count=0;
		while($data = mysqli_fetch_assoc($run))
		{
			$count++;
?>
			<tr align="center">
				<td><?php echo $count; ?></td>
				<td> <?= anchor ("user/article/{$data['id']}",$data['title']); ?> </td>	
				<td><?php 
						$body = $data['body'];
					echo $post = substr($body,0, 300);//FOR DISPLAYING 300 ALPHABET				
					 ?>					 	
				</td>
				<td><?php echo $data['remark']; ?></td>
				<td><b>Rs. <?php echo $data['cost']; ?> Lakhs</b></td>
				<td>Rs. <?php echo $data['exp']; ?> Lakhs</td>
				<td> Rs. <?= ($data['cost'] - $data['exp']) ?> Lakhs </td>
				<td><?php echo $data['category']; ?></td>
				<td>	
	<button class="btn">		
  			<?php  //HERE WE LINK FOR PDF CONVERTER //
  					echo '<a href="'.base_url().'Admin/pdfdetails/'.$data['id'].'">Print</a>' 
  			?> 
  		</button>
				</td>				
			</tr>
<?php
		}
	}	
}		

?>

</table>
</div>
</body>
</html>
