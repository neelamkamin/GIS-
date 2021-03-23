<?php 
  include 'dbcon.php';
   include 'header.php';
  //session_start(); //SESSION IS ALREADY STARTED//
  $id = $_SESSION['user_id'];
  if(isset($_SESSION['user_id']))
    { 
?>
<body>
<div class="container">
  <form class="form-horizontal" method="post" action="insert_task">

    <input type="hidden" name="id" value="<?php echo $id = $_SESSION['user_id']; ?>">

  <fieldset>
   <div class="col-sm-9">
    <legend align="center">Assign Task / Comment Here</legend>
           
   <div class="form-group"  style="background-color: silver;">
      <label for="exampleInputEmail1">Message / Assign Task</label>
      <textarea class="form-control" rows="5" name="message" class="form-control" id="message" placeholder="Enter Message / Task" style="background-color: #d9d9d9; padding: 10px;"></textarea>
    </div>
  </div>
  
  <div class="form-group"> 
    <div class="col-lg-6 col-lg-offset-6">
      <button type="reset">Cancel</button>
      <button type="submit" class="btn btn-primary">Assign Task</button>
    </div>
  </div>

<!--FOR SELECTING EMPLOYEE !-->
    <div class="col-sm-12">
    
     <fieldset class="form-group">
          <legend>Hello - <?= $id; ?>, Please Select Employee Whom to Assign Task</legend>
           <?php 
        
              $sql ="SELECT * FROM users WHERE role='user' ORDER BY e_no DESC";
                $res =mysqli_query($conn,$sql);
                $count =mysqli_num_rows($res);
                if($count>0)
                {
                 while($row = mysqli_fetch_array($res))
                 {
         
            ?>
          <div class="checkbox">
            <label class="form-check-label">
              <input type="checkbox" class="form-check-input" name="emp[]" value="<?= $row['id']; ?>">
              <?= $row['id']; ?>
            </label>
          </div>

          <?php } //ENDING WHILE LOOP HERE// ?>
  </div>  
  
  </fieldset>
</form>
</div>
</body>
</html>
<?php 
          }
        }

?>
