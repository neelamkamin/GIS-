<?php 
    include 'header.php';
    if($feedback = $this->session->flashdata('feedback')): 
		$feedback_class = $this->session->flashdata('feedback_class'); //**WORKS ONLY IF BOOTSTRAP.MIN.CSS WORK CORRECTLY
?>
  <div class="container-fluid">
    <div class="col-lg-6 col-lg-offset-3">
    
        <div class="alert alert-dismissible alert-danger">
          <?= $feedback ?>
        </div>
      </div>

  <?php endif; ?>
	<table class="table table-hover">
		<thead align="center">
			<tr style="color:green;">
			    <td><b>Sl.No</td>
			    <td><b>PROJECT_NAME</td>
				<td><b>TOTAL PROJECT COST (in Lakhs)</b></td>
				<td><b>EXPENDITURE (in Lakhs)  </b></td>
				<td><b>BALANCE_LEFT (in Lakhs)</b></td>
				<td><b>CATEGORY</b></td>
				<td><b>PRINT</b></td>
			</tr>
		</thead>
		       <tbody>

    <? if ( count($dept_id)): ?>
		<?php	$count = $this->uri->segment(4,0); ?>
          	<?php foreach ($dept_id as $dd): ?>
		
				<tr align="center">
					<td> <?= ++$count ?> .</td>
					<td> <?= anchor ("user/article/{$dd->id}",$dd->title) ?> </td>	
					<td><b> Rs. <?= $dd->cost ; ?> Lakhs </b></td>
					<td> Rs. <?= $dd->exp ; ?> Lakhs</td>
					<td> Rs. <?= ($dd->cost - $dd->exp) ?> Lakhs </td>
					<td> <?= $dd->category ; ?> </td>
					<td> <button class="btn">		
			  			      <?php  //HERE WE LINK FOR PDF CONVERTER //
			  					echo '<a href="'.base_url().'Admin/pdfdetails/'.$dd->id.'">Print Report</a>' 
			  			       ?> 
			  		         </button> </td>
		   	<?php endforeach; ?>
	  <? else: ?>	
	<? endif; ?> 
				</tr>    	
		      </tbody> </table>

		     <?= $this->pagination->create_links() ?>
	<br>
			<?php 
			echo "<b>NAME OF THE Official :-  </b>" . $dd->user_id ;
			?>
	<br><br><br>
	
	
</div></td></tr></tbody></table></div></div></div></nav></body></html>


