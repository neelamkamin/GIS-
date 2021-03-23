<?php include_once('header.php'); ?>
<div class="container-fluid">
	
<?php
          function count_all_title() {
			$servername = "localhost:3306";
			$username = "root";
			$password = "";
			$dbname = "rms_db";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
			//$user_id = $this->session->userdata('user_id');
			//$sql = "SELECT SUM(cost) AS value_sum FROM articles";
			$sql = "SELECT COUNT(title) AS value_count FROM articles";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
			        echo "<b>TOTAL REPORT SUBMITTED BY ALL PROJECT IN-CHARGE IS :- " . $row["value_count"]. "  Reports</b>";
			    }
			} else {
			    echo "0 results";
			}
			$conn->close();

		}
		echo count_all_title();
        ?>
<br>
<div class="container-fluid">

	<?php echo "Welcome :- "  .  $_SESSION['user_id']; ?>

 <h3 style="color:red;"> <b>ALL PROJECTS LIST</h3>
	<hr>
	<table class="table table-hover">
		<thead align="center">
			<tr style="color:green;">
				<td><b>Sl. No.</td>
				<td><b>PROJECT_NAME</td>		
				<td><b>TOTAL_PROJECT_COST (in Lakhs)</b></td>
				<td><b>EXPENDITURE (in Lakhs)</b></td>
				<td><b>BALANCE_LEFT (in Lakhs)</b></td>
				<td><b>PROJECT IN-CHARGE</b></td>
				<td><b>FUND CATEGORY</b></td>
				<td><b>SUBMITTED_ON</b></td>
				<td><b>ACTION</b></td>
			</tr>
			</thead>
		<tbody>
			<tr>
	<? if ( count($articles)): ?>
		<?php	$count = $this->uri->segment(3,0); ?>
			<?php foreach( $articles as $mm): ?>
				<td>(<?= ++$count ?>)</td>
				<td><?= anchor ("user/article/{$mm->id}",$mm->title) ?></td>			
				<td> Rs. <?= $mm->cost; ?> Lakhs </td>
				<td> Rs. <?= $mm->exp; ?> Lakhs</td>
				<td> Rs. <?= ($mm->cost - $mm->exp) ?> Lakhs </td>
				<td> <?= $mm->user_id; ?> </td>
				<td> |<?= $mm->category; ?>| </td>
				<td>|<?= date('d M Y', strtotime($mm->reported_at)); ?>|</td>

				<td><button class="btn">		
				  			<?php  //HERE WE LINK FOR PDF CONVERTER //
				  				echo '<a href="'.base_url().'Admin/pdfdetails/'.$mm->id.'">Print</a>' 
				  			?> 
  					</button></td>
			</tr>
			<?php endforeach; ?>
	 <? else: ?>
				
	<? endif; ?>
			</tr>
		</tbody>
	</table>

		<?= $this->pagination->create_links() ?>

</div></td></td></tr></thead></table></div></div>

<?php include_once('footer.php'); ?>

