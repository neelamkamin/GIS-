<?php 
     //include 'sum.php'; 
     include_once 'admin_header.php'; 
    //echo "<pre>";
    //print_r($articles); exit;     
      if($feedback = $this->session->flashdata('feedback')): 
		$feedback_class = $this->session->flashdata('feedback_class'); //**WORKS ONLY IF BOOTSTRAP.MIN.CSS WORK CORRECTLY
?>		    <div class="row">
		      <div class="col-lg-6 col-lg-offset-3">  
		        <div class="alert alert-success">
		          <?= $feedback ?> <!--FOR DISPLAY OF SUCCESS MESSAGE SET AT CONTROLLER ADMIN/store_article() !-->
		        </div>
		      </div>
		    </div>
  <?php endif; ?> 
<?php	      
	/* IF LOGIN USER SUBMITTED ANY REPORT i.e FOUND ANY REOCRD THEN BELOW WILL FOLLOW */
if(count($articles)): /*This if(count($articles)): end at line no. 85 */
$count = $this->uri->segment(3,0);
     //echo "Welcome:-" . $_SESSION['user_id']; echo "<br>";
			    $s_id = $_SESSION['user_id'];
                echo "Welcome :- <b>" . $s_id ."</b><br>"."<br>";     
 ?>
<div class="container-fluid">
	<div class="row">			
		<td>
		<a href="<?php echo site_url("admin/store_article") ?>" class="btn btn-lg btn-primary">SUBMIT PROJECT</a>
		</td>
	</div>
</div>
	<table class="table table-hover" border="1">
		<thead style="color:green;">
			<th>Sl.no</th>
			<th>NAME  OF  THE  PROJECTS</th>
			<th>Date of Reporting</th>
			<th>Total Project Cost (in Lakhs)</th>
			<th>Expenditure till date (in Lakhs)</th>
			<th>Balance (in Lakhs)</th>
			<th>FUND CATEGORY</th>
			<th>EDIT/DELETE</th>
		</thead>
		<tbody>

		<?php foreach($articles as $project): ?>
			<tr align="center">
				<td >
					<?= ++$count ?>
				</td>
				<td>
					<?=
					 //$pro->title                         
					anchor ("user/article/{$project->id}",$project->title) //$pro is taken from above syntex at line 46// 
					  ?>
 				</td>

			        <td>
					 <?= date('d M y', strtotime($project->reported_at)); ?>
				    </td>

			<td><b> Rs. <?= $project->cost ; ?> Lakhs </b></td>
			<td> Rs. <?= $project->exp ; ?> Lakhs</td>
			<td> Rs. <?= ($project->cost)-($project->exp) ; ?> Lakhs </td>
			<td> <?= $project->category ; ?></td>
			<td>
			<?=      //GET METHOD FOR EDITING//
 				anchor("Admin/edit_article/{$project->id}",'Edit',['class'=>'btn btn-primary']); 
 //{$article->id} FROM THIS '$article' IS TAKEN FROM ABOVE SYNTEX AT NO.41, i.e=<?php foreach($articles as $article): 
 			?> 
 				<?=  
 					//POST METHOD FOR DELETE//
 					form_open('admin/delete_article'),
 					form_hidden('mm_id',$project->id),
 					//form_submit(['name'=>'submit','value'=>'Delete','class'=>'btn btn-danger']),
 					 form_submit('submit','Delete',array('onclick' => "return confirm('WARNING :- Do you really want to Delete : $project->title Report.')",'class'=>'btn btn-danger float-center')),
 					form_close();
 				?>		
	
				</td>

			</tr>
		   <?php endforeach;  ?>
			</tbody>
	      </table>
<?php else: /*This else: will execute if() get false at line 18, ELSE CONDITION START HERE BELOW IF LOGIN USER HAVE NOT SUBMITTED ANY REPORT */
	$s_id = $_SESSION['user_id'];
?>

<div class="container">
	<td>
        <a href="<?php echo site_url('User/task') ?>" class="btn btn-lg btn-info">Assign New Task</a>
     </td>
     <td>
		<a href="<?php echo site_url("admin/store_article") ?>" class="btn btn-lg btn-primary">SUBMIT PROJECT</a>
		</td>
</div>
<br>
	<?php 
		echo "Welcome :-  ".  $s_id . ",<br>"; 
		echo "The following Tasks are assigned by:- ".  $s_id . ",<br>";
	?>
<br>		
<a href="<?php echo site_url("User/all_reply") ?>" class="btn btn-lg btn-primary btn-block">View All Reply to Me</a>

<table class="table table-hover">
  <thead align="center">
    <tr align="center" style="color:green;">
      <th scope="col">Sl.no.</th>
      <th scope="col">Task</th>
      <th scope="col">Assigned_to</th>      
      <th scope="col">On_Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <?php 
  		$conn = mysqli_connect('localhost:3306','root','','rms_db');
  		$i=1;
  		$sql1 ="SELECT * FROM task_db WHERE assign_by = '$s_id' ORDER BY t_id DESC";
   		 //$sql1 ="SELECT * FROM task_db JOIN reply_db ON reply_db.task_id=task_db.t_id WHERE assign_by = '$s_id'";
   			
	      $res1 =mysqli_query($conn,$sql1);
	      $count1 =mysqli_num_rows($res1);
	      if($count1>0):
	      
		     while($row1 = mysqli_fetch_array($res1))
		     {
		     	//echo "<pre>";
		     	//print_r($row); exit;
   ?>
  <tbody>
    <tr class="table-default">
	      <td>( <?= $i; ?> )</td>	      
	      <td><?= $row1['task']; ?></td>
	      <td><?= $row1['user_id']; ?></td>	      
	      <td><?= date('d M Y', strtotime($row1['task_date'])); ?></td>
	      <td>
	      	<?php echo form_open('User/delete_task',['class'=>'form-horizontal']) ?>

	    			<input type="hidden" name="delete_id" value="<?php echo $row1['t_id']; ?>">  	
	      	<?=  
 				 form_submit('submit','Delete Task',array('onclick' => "return confirm('WARNING :- Do you really want to Delete this Task')",'class'=>'btn btn-danger float-center')),
 					form_close();
 			?>
 					
	      </td>
    </tr>
        <?php 
	        	$i++;
	        	   } //WHILE LOOP OF LINE 125 END HERE//

	        	endif; // }//ENDING IF OF LINE 123 HERE
    	?> 
   </tbody>
  </table> 
 </body>
</html>		
<!--- ELSE CONDITON END HERE !-->				
				<?php endif; // ENDING IF OF LINE NO. 18 HERE  ?>		
	<br><br><br>
<h2 style="color:red;" align="center"> Please Do Not Use Mozilla Firefox <br><br> Use Chrome/Opera/UC Browser only </h2>
	<?= $this->pagination->create_links(); ?>
</div></td></tr></tbody></table></div></div></div></nav></body></html>


