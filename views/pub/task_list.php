<?php 
	include_once 'header.php'; 
	include 'dbcon.php';
	$s_id = $_SESSION['user_id'];
?>

<?php if($feedback = $this->session->flashdata('feedback')): 
		$feedback_class = $this->session->flashdata('feedback_class'); //**WORKS ONLY IF BOOTSTRAP.MIN.CSS WORK CORRECTLY
?>
    <div class="row">
    	<div class="col-lg-6 col-lg-offset-3">
    
        <div class="alert alert-success">
          <?= $feedback ?> <!--FOR DISPLAY OF SUCCESS MESSAGE SET AT CONTROLLER ADMIN/store_article() !-->
        </div>
      </div>
    </div>
  <?php endif; ?>



	 <div>
            <?php 
                  if(isset($_SESSION['success']))
                  {
                    echo $_SESSION['success'];
                    unset($_SESSION['success']); //TO DESTROY THE SUCCESS MESSAGE FROM THE PAGE//
                  }
            ?>
       </div>
  <?php 
  		$i=1;
      $sql ="SELECT * FROM task_db WHERE user_id = '$s_id'";
	      $res =mysqli_query($conn,$sql);
	      $count =mysqli_num_rows($res);
	      if($count>0)
	      {
	?>
<br>
	<?php echo "All Tasks assigned to :- <b> ".  $s_id . ",</b><br>"; ?>
<br>
<a href="<?php echo site_url("User/my_reply") ?>" class="btn btn-lg btn-primary btn-block">View My Reply</a>

			<table class="table table-hover">
			  <thead align="center">
			    <tr style="color:green;">
			      <th scope="col">Sl.no.</th>
			      <th scope="col">Task</th>
			      <th scope="col">Assigned_by</th>      
			      <th scope="col">On_Date</th>
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
	<?php
		     while($row = mysqli_fetch_array($res))
		     {
		     	//echo "<pre>";
		     	//print_r($row); exit;
   ?>
  <tbody>
    <tr class="table-default">
	      <td>( <?= $i; ?> )</td>
	      <td><?= $row['task']; ?></td>
	      <td><?= $row['assign_by']; ?></td>	      
	      <td><?= date('d M Y', strtotime($row['task_date'])); ?></td>
	      <td><a href="view_msg/<?php echo $row['t_id']; ?>">Reply</a></td>
	           
 		
    </tr>
        <?php $i++;
        	   } //WHILE LOOP END HERE//

    	   }else{ //IF $count = 0 THEN BELOW CODE WILL HAPPEN//
    				//echo "No Tasks Found ! (You are not given any task)";
    	   	?>
   	<!--- ELSE PART START HERE WITH LITTE CHANGE IN SQL QUERY  !-->
<div class="container">
	<td>
        <a href="<?php echo site_url('User/task') ?>" class="btn btn-lg btn-info">Assign New Task</a>
     </td>
</div>
<?php echo "All Tasks assigned by :- <b> ". $s_id . ",</b><br>"; ?>
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
	        	   } //WHILE LOOP END HERE//

	        	endif; // }//ENDING IF HERE
	    	
	    		} //ENDING ELSE HERE//
	    		//echo "NO Task Found ! You have not assign any task.";
    	?> 
  </tbody>
</table> 
</body>
</html>


