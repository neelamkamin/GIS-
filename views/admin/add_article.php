<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charrshet="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/kamin.css") ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src='<?= base_url() ?>assests/mm_mce/mm_mce.min.js'></script>
        <script>
                function form_validation()
                {
                  var title = $ ('#title').val();
                  var cost = $ ('#cost').val();
                  //var body = $ ('#body').val();
                  //var pas_length = $ ('#password').val().length;
                  //alert(pas_length);
                  if(title=='')
                  {
                    alert("Please Enter Project Name");
                    return false;
                  }
                  if(cost=='')
                  {
                    alert("Please Enter Total Project Cost");
                    return false;
                  }
                  //if(body=='')
                  //{
                    //alert("Please Write Something on Report Field");
                    //return false;
                  //}
                  //if(pas_length<4)
                  //{
                    //alert("Password must be minimum 4 characters");
                    //return false;
                  //}
                }
      </script>
</head>
<body>
  <button class="btn btn-default" style="float:right"><a href="<?php echo site_url("login/logout") ?>">Logout</a></button>
  <button class="btn btn-default" style="float:left"><a href="<?php echo site_url("Admin/dashboard") ?>">Back</a></button>

<form class="form-horizontal" method="post" action="store_article" onsubmit="return form_validation();">

<?php //echo form_open_multipart('Admin/store_article',['class'=>'form-horizontal']) ?>
  
<?php echo form_hidden('user_id', $this->session->userdata('user_id')); ?>



<?= //HERE WE USE THIS METHOD SO THAT "DATE" OF PROJECT REPORT WIL NOT CHANGE EVEN AFTER UPDATE
//FOR THIS WE HAV CREATED 1 MORE ROW AT TABLE "articles" NAMED "reported_at" WITH 'VALCHAR' AND GET DATE & TIME FROM THIS 'form_hidden' METHOD.
    form_hidden('reported_at', date('d-m-Y H:i:s'));
  //THIS 'form_hidden' METHOD IS NOT NECESSARY IS WE CREATE EXTRA ROW WITH "Timestamp" VALUE, BUT DATE WIL CHANGE IN ANY NEW UPDATE OF EARLIER REPORT//
?>
  <fieldset>
    <h2 align="center" style="color:blue;"> PROJECT REPORT SUBMISSION FORM </h2>
    <hr>
    <div class="container">
      <div class="col-lg-12">
    		<div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label"><font color="red">**</font>PROJECT NAME<font color="red">**</font></label>
      <div class="col-lg-6">

 <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
      echo form_input(['name'=>'title', 'id'=>'title', 'class'=>"form-control",'placeholder'=>'Enter Project Name','value'=>set_value('title')]); 
  ?> 
    <div class="col-lg-4">   
     <p style="color:green;"><b>Category of Fund:</b></p> 
          <input type="radio" name="category" value="State_Funded" checked>State Funded <br>
          <input type="radio" name="category" value="Centrally_Funded"> Central Funded<br>
  </div>
  <div class="col-lg-8"> 
    <p style="color:green;"><b>Is this the first report of this project:</b></p>
          <input type="radio" name="pro_list" value="1">YES <br>
          <input type="radio" name="pro_list" value="2" checked> NO<br>
  </div>     
      </div> </div></div></div>

<div class="container">
  <div class="col-lg-12">
    <div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label">SADA FINANCIAL YEAR</label>
        <div class="col-lg-6">
  
    <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*// 
   echo form_input(['name'=>'FY','class'=>"form-control",'placeholder'=>'SADA Financial Year','value'=>set_value('FY')]); 
      ?> 
  </div></div></div></div>
<div class="container">
  <div class="col-lg-12">
    <div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label"><font color="red">**</font>TOTAL PROJECT COST (in Lakhs)<font color="red">**</font></label>
       <div class="col-lg-6">
  
    <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
   echo form_input(['name'=>'cost', 'id'=>'cost', 'class'=>"form-control",'placeholder'=>'*Enter Total Project Cost in Lakhs only','value'=>set_value('cost')]); 
    ?> 
   </div></div></div></div>
<div class="container">
  <div class="col-lg-12">
    <div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label">EXPENDITURE TILL DATE (in Lakhs) </label>
        <div class="col-lg-6">
    <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
   echo form_input(['name'=>'exp','class'=>"form-control",'placeholder'=>'*Enter Total Expenditure in Lakhs only','value'=>set_value('exp')]); 
    ?> 
    </div></div></div></div>
<font color="red">**</font><b>PROJECT PROFILE<font color="red">**</b></font>
      <div>
 <textarea class='editor' name='body'>
      <?php if(isset($content)){ echo $content; } ?> 
      </textarea>
  </div>
  <h2><b>CURRENT STATUS/ ISSUES</b></h2>
  <div>
 <?php //HERE WE R USING FORM_INPUT INBUILT FUNCTION OF CODEIGNITER*//
      //echo form_textarea(['name'=>'remark','class'=>'form-control','placeholder'=>'Enter Project Description','value'=>set_value('remark')]);
         $option_mm = array(
                          'name'        => 'remark',
                          'rows'        => '8',
                          'cols'        => '10',
                          'style'       => 'width:100%',
                          'placeholder'  =>'',
                          'value'=> set_value('remark'),
                         );

      echo form_textarea($option_mm);
  ?>

       <?php echo form_error('remark');  ?>
  </div>


<!--Form_upload option to upload files/images!-->

<!--END of Form_upload option to upload files/images--END!-->
<div>
  <?php 
      echo form_reset(['name'=>'reset','value'=>'Reset','class'=>'btn btn-default']),  //HERE WE R USING INBUILT FUNCTION OF CODEIGNITER, INSTEAD OF HTML CODE*//
		form_submit(['name'=>'submit','value'=>'Submit','class'=>'btn btn-primary']);

   ?>
</div>
  </fieldset>
</form>

<script>
 tinymce.init({ 
      selector:'.editor',
      height: 300
    });

    </script>

<div class="container">
<font color="red">Please Note RED Colour Star **mark fill is mandatory
</font>
</div>
