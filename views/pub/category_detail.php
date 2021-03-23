<?php include_once('header.php'); ?>
<!------END !------->

<?php if($feedback = $this->session->flashdata('feedback')): 
		$feedback_class = $this->session->flashdata('feedback_class'); //**WORKS ONLY IF BOOTSTRAP.MIN.CSS WORK CORRECTLY
?>
    <div class="row">
    	<div class="col-lg-6 col-lg-offset-3">
    
        <div class="alert alert-dismissible alert-danger">
          <?= $feedback ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
	<table border="1">
		<thead align="center" style="color:blue;" bgcolor="white-gray">
			    <td><b>Sl.No</td>
			    <td><b>PROJECT_NAME</td>
				<td>&nbsp<b>TOTAL PROJECT COST (in Lakhs)</b>&nbsp</td>
				<td>&nbsp<b>EXPENDITURE (in Lakhs)  </b>&nbsp</td>
				<td>&nbsp<b>BALANCE_LEFT (in Lakhs)</b>&nbsp</td>
				<td>&nbsp<b>PROJECT IN-CHARGE</b>&nbsp</td>
				<td>&nbsp<b> REPORTED_ON </b>&nbsp</td>
				<td><b>PRINT</b></td>
		</thead>
		<tbody>

            <? if ( count($cat_id)): ?>
		<?php	$count = $this->uri->segment(4,0); ?>
          <?php foreach ($cat_id as $dd): ?>
		
			<tr align="center">
			<td> <?= ++$count ?> </td>
			<td> <?= anchor ("user/article/{$dd->id}",$dd->title) ?> </td>	
			<td> <b>Rs. <?= $dd->cost ; ?> Lakhs </b></td>
			<td> Rs. <?= $dd->exp ; ?> Lakhs</td>
			<td> Rs. <?= ($dd->cost - $dd->exp) ?> Lakhs </td>
			<td> <?= $dd->user_id ; ?> </td>
			<td><?= date('d M Y', strtotime($dd->reported_at)); ?></td>			
			<td>	
	<button class="btn">		
  			<?php  //HERE WE LINK FOR PDF CONVERTER //
  					echo '<a href="'.base_url().'Admin/pdfdetails/'.$dd->id.'">Print Report</a>' 
  			?> 
  		</button>
				</td>

			</tr>
				
<?php endforeach; ?>
		</tbody>
	</table>
		<?= $this->pagination->create_links() ?>

	<br>
	<?php foreach ($cat_id as $dd): ?>
<?php 
echo "<b>CATEGORY OF FUNDING (STATE/CENTRAL) :-  </b>" . $dd->category;
exit;
?>
<?php endforeach; ?>



<br><br><br>	
</div></td></tr></tbody></table></div></div></div></nav></body></html>
