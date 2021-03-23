<?php include_once('header.php'); ?>

<div class="container-fluid">
	<h3>SEARCH RESULT</h3>
	<hr>
	<table class="table table-hover">
		<thead>
			<tr style="color:green;">
				<td><b>Sl._No.</td>
				<td><b>PROJECT_NAME</td>
				<td><b>TOTAL PROJECT COST (in Lakhs)|</b></td>
				<td><b>|EXPENDITURE_TILL DATE (in Lakhs)|</b></td>
				<td><b>|BALANCE_LEFT (in Lakhs)|</b></td>
				<td><b>|PROJECT IN-CHARGE|</b></td>
				<td><b>|SUBMITTED ON|</b></td>
				<td><b>ACTION</b></td>
			</tr>
			</thead>
		<tbody>
			<tr>
			<? if ( count($src_result)): ?>
		<?php	$count = $this->uri->segment(4,0); ?>
		<?php foreach( $src_result as $mm): ?>
				<td> (<?= ++$count ?>) </td>
				<td> <?= anchor ("user/article/{$mm->id}",$mm->title) ?> </td>
				<td><b> Rs. <?= $mm->cost; ?> Lakhs</b></td>
				<td> Rs. <?= $mm->exp; ?> Lakhs</td>
				<td> Rs. <?= ($mm->cost - $mm->exp)  ?> Lakhs</td>
				<td> <?= $mm->user_id; ?> </td>
				<td> |<?= date('d M Y', strtotime($mm->reported_at)); ?>| </td>
				<td>	
					<button class="btn">		
  						<?php  //HERE WE LINK FOR PDF CONVERTER //
  							echo '<a href="'.base_url().'Admin/pdfdetails/'.$mm->id.'">Print</a>' 
  						?> 
  					</button>
				</td>
			</tr>
		<?php endforeach; ?>
			<? else: ?>
		<tr>
		</tr>

		<? endif; ?>
			</tr>
		</tbody>
	</table>
		<?= $this->pagination->create_links() ?>

</div>

<?php include_once('footer.php'); ?>

