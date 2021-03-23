<?php include 'header.php'; ?>

 <h2 style="color:green;" align="center">GOVERNMENT OF ARUNACHAL PRADESH <br>DEPATEMENT OF IT & COMMUNICATION <br>
 	DIGITAL CELL:: ROOM-107, BLOCK-1, CIVIL SECRETARIAT
 </h2>
 <hr>
 <div class="container">
	<div class="row">
 <div class="col-lg-6"> 
			<span class="pull-right">
			<h3 style="color:blue;">	
				<?=  //WE RECEIVED THIS "$art_id" OBJECT FROM "public function article( $id )" FUNCTION OF "User.php" FILE OF CONTROLLERS FOLDER//
				 "<b>Assigned_By</b> :-" . $task->assign_by 
				 ?> 
			</h3>
			</span>
		</div>

		<div class="col-lg-6"> 
			<span class="pull-right">
			<h3 style="color:blue;">	<?= "<b>ON DATE</b>:- "  .  date('d M Y', strtotime($task->task_date)); ?> </h3>
			</span>

		</div>	
	<div>
		
	<hr> 
	</body>
</html>
<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
			pre {
				    white-space: pre-wrap;       /* Since CSS 2.1 */
				    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
				    white-space: -pre-wrap;      /* Opera 4-6 */
				    white-space: -o-pre-wrap;    /* Opera 7 */
				    word-wrap: break-word;       /* Internet Explorer 5.5+ */
				}
		</style>
		
	</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-lg-12">
	<pre>
			<?php 			
			echo "<b>Task / Message</b> :- <br>" . $task->task
			 ?> 
	  </pre>
	</div></div></div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js') ?>">  </script>

</body>
</html> 
<!DOCTYPE html>
<html>
<body>
<hr>
<?php include 'dbcon.php'; ?>
<body>
<div class="container">
  
  	<?php echo form_open('User/insert_reply',['class'=>'form-horizontal']) ?>

    <input type="hidden" name="reply_by" value="<?php echo $id = $_SESSION['user_id']; ?>">

  <fieldset>
   <div class="col-sm-12">           
   <div class="form-group"  style="background-color: silver;">
      <label for="exampleInputEmail1">Hello - <?= $id; ?>, Please Write your reply here, If any !</label>
      <textarea class="form-control" rows="5" name="reply" class="form-control" id="reply" placeholder="Write your reply here, if any" style="background-color: #d9d9d9; padding: 10px;"></textarea>
    </div>
  </div>
<!--FOR  !-->
      <?php 
        	 $r_id = $task->t_id;
        	
              $sql ="SELECT * FROM task_db WHERE t_id='$r_id'";
                $res =mysqli_query($conn,$sql);
                $count =mysqli_num_rows($res);
                 $row = mysqli_fetch_array($res);
              		//echo $row['assign_by'] . "<br>"; 
        ?>
  <?php //echo  " reply_to :-  ". $row['assign_by']; ?>
 
<input type="hidden" name="reply_to" value="<?php echo $row['assign_by']; ?>"> 
<input type="hidden" name="task_id" value="<?php echo $row['t_id']; ?>">     
  </div>  
   <div class="form-group"> 
    <div class="col-lg-6 col-lg-offset-6">
      <button type="submit" class="btn btn-primary">Submit Reply</button>
    </div>
  </div>
  
  </fieldset>
</form>
</div>
</body>
</html>




