<?php 
	include_once 'header.php'; 
	include 'dbcon.php';
	$s_id = $_SESSION['user_id'];
?>

<br>

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

<?php echo "All Task-Reply to :-  <b>".  $s_id . "</b>,<br>"; ?>

<table class="table table-hover">
  <thead align="center">
    <tr align="center" style="color:green;">
      <th scope="col">Sl.no.</th>
      <th scope="col">Task_Assigned</th>
      <th scope="col">Reply</th>
      <th scope="col">Reply_by</th>      
      <th scope="col">Replied_On</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <?php 
  		$i=1;

   $sql_join ="SELECT * FROM task_db JOIN reply_db ON reply_db.task_id=task_db.t_id WHERE assign_by='$s_id' ORDER BY reply_db.r_id DESC";
   			
	      $res1 =mysqli_query($conn,$sql_join);
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
	      <td><?= $row1['task']; ?></td> <!--FROM TABLE 'task_db' AS WE HAVE MADE JOIN QUERY !-->
	      <td><?= $row1['reply']; ?></td> <!--FROM TABLE 'reply_db' AS WE HAVE MADE JOIN QUERY !-->
	      <td><?= $row1['reply_by']; ?></td>	      
	      <td><?= date('d M Y', strtotime($row1['reply_date'])); ?></td>
	      <td>
	      	<?php echo form_open('User/delete_reply',['class'=>'form-horizontal']) ?>

	    			<input type="hidden" name="delete_Rid" value="<?php echo $row1['r_id']; ?>">  	
	      	<?=  
 				 form_submit('submit','Delete',array('onclick' => "return confirm('WARNING :- Do you really want to Delete this Reply')",'class'=>'btn btn-danger float-center')),
 					form_close();
 			?>
	      </td>
    </tr>
        <?php 
	        	$i++;
	        	   } //WHILE LOOP END HERE//

	        	endif; // }//ENDING IF HERE	    	
    	?> 
  </tbody>
</table> 

</body>
</html>


