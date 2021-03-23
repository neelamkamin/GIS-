
<?php 
     include 'sum.php'; 
     include_once 'admin_header.php'; 
    //echo "<pre>";
    //print_r($articles);
    //exit;  
    echo "<br>";                                    
         $s_id = $_SESSION['user_id'];

        echo "Welcome :- <b>" . $s_id ."</b><br>";                        
?>
<br>
 <div class="container">
    <?php echo count_all_title();  ?>

 </div>
</div>
<div class="container">
        <?php 
            if($feedback = $this->session->flashdata('feedback')): 
            $feedback_class = $this->session->flashdata('feedback_class'); 
        ?>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">   
        <div class="alert alert-success">

          <?= $feedback ?> <!--FOR DISPLAY OF SUCCESS MSG AFTER ASSIGNING TASK FROM CONTROLLER User/insert_task() !-->
        </div>
      </div>
    </div>
  <?php endif; ?>
    <table class="table table-hover">
        <thead style="color:green;">
            <tr>
                <td><b>Sl._No.</td>
                <td><b>PROJECT IN-CHARGE</td>
                <td><b>TOTAL_REPORT SUBMITTED</b></td>
            </tr>
            </thead>
        <tbody>
            <tr>
                <? if ( count($tol)): ?>
        <?php   $count = $this->uri->segment(3,0); ?>
        <?php foreach ($tol as $key => $sin): ?>
            
 <td>( <?= ++$count ?> )</td>
 <td> <?= anchor ("User/dept_result/{$sin->user_id}",$sin->user_id) ?> </td>
 <td> <?= $sin->count_mm; ?> Nos. </td>
 </tr>

      <?php endforeach; ?>
            <? else: ?>
        <tr>
        </tr>

        <? endif; ?>
            </tr>
        </tbody>
    </table>

<?= $this->pagination->create_links(); ?>
</div>
</body>
</html>