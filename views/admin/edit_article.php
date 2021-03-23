<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charrshet="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/kamin.css") ?>">
    <script src='<?= base_url() ?>assests/tinymce/tinymce.min.js'></script>
</head>
<body>
  <button class="btn btn-default" style="float:right"><a href="<?php echo site_url("login/logout") ?>">Logout</a></button>
  <button class="btn btn-default" style="float:left"><a href="<?php echo site_url("Admin/dashboard") ?>">Back</a></button>

<?php 
echo form_open("admin/update_article/{$article->id}",['class'=>'form-horizontal']);
//THIS EXTENSION i.e "{artic->id}" is to provide article-id OF ARTICLE TO BE UPDATE
//PLZ SEE SYNTEX= "public function update_article($artic_id)" OF ADMIN.PHP FILE ON LINE 60
//IN WHICH '{artic->id}' IS PASS AS PERAMETER///  
?>
  
  <fieldset>
  <h2 align="center" style="color:blue;"> PROJECT REPORT SUBMISSION FORM </h2> 
  <hr>
    <div class="container">
      <div class="col-lg-12">
        <div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label">
        <font color="red">**</font>PROJECT NAME<font color="red">**</font></label>
      <div class="col-lg-8">

 <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
 echo form_input(['name'=>'title','class'=>"form-control",'placeholder'=>'Enter Project Name','value'=>set_value('title',$article->title)]); 
  ?> 

        <!--<input type="text" size="50" class="form-control-plaintext" id="staticEmail" placeholder="Enter Username">!-->
      </div></div></div></div>
<div class="container">
      <div class="col-lg-12">
        <div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label">TOTAL PROJECT COST (in Lakhs)</label>
      <div class="col-lg-4">
    <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
   echo form_input(['name'=>'cost','class'=>"form-control",'placeholder'=>'Total Project Cost (in Lakhs)','value'=>set_value('cost',$article->cost)]); 
    ?> 
    </div></div></div></div>
    <div class="container">
      <div class="col-lg-12">
        <div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label">EXPENDITURE TILL DATE (in Lakhs) </label>
      <div class="col-lg-4">
    <?php //HERE WE R USING INBUILT FORM_INPUT FUNCTION OF CODEIGNITER, INSTEAD OF USING HTML FORM INPUT*//
   echo form_input(['name'=>'exp','class'=>"form-control",'placeholder'=>'Total Expenditure (in Lakhs)','value'=>set_value('exp',$article->exp)]); 
    ?> 
    </div></div></div></div>

<div>

        <?php 
          echo form_error('title'); 
        ?>
     </div>
    
<div class="container">
  <div class="col-lg-12">
    <div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label">
         <font color="red">**</font>EDIT PROJECT REPORT<font color="red">**</font>
       </label>
         <div class="col-lg-12">
<?php 
      //HERE WE R USING FORM_INPUT INBUILT FUNCTION OF CODEIGNITER*//
      //echo form_textarea(['name'=>'body','class'=>'form-control','placeholder'=>'Enter monthly Report','value'=>set_value('body',$article->body)]);
          $option_body = array(
                                'name'        => 'body',
                                'rows'        => '15',
                                'cols'        => '10',
                                'style'       => 'width:100%',
                             //'value'=> set_value(strip_tags('body',$article->body))
                                'value'=> set_value('body',$article->body) /*Here strip_tags is removed*/ 
                                );

    echo form_textarea($option_body);
 ?>

       <?php echo form_error('body');  ?>

    </div></div></div></div>
<div class="container">
  <div class="col-lg-12">
    <div class="form-group">
      <label for="inputEmail" class="col-lg-4 control-label"> EDIT REMARK, IF ANY </label>
         <div class="col-lg-12">

  <?php 
      //echo form_textarea(['name'=>'remark','class'=>'form-control','placeholder'=>'Remarks if Any','value'=>set_value('remark',$article->remark)]);
         $option_remark = array(
                          'name'        => 'remark',
                          'rows'        => '3',
                          'cols'        => '10',
                          'style'       => 'width:100%',
                          'value'=> set_value('remark',$article->remark),
                         );

      echo form_textarea($option_remark);
  
  ?>

       <?php echo form_error('remark');  ?>
</div></div></div></div>

  <?php 
      echo form_reset(['name'=>'reset','value'=>'Reset','class'=>'btn btn-default']),  //HERE WE R USING INBUILT FUNCTION OF CODEIGNITER, INSTEAD OF HTML CODE*//
		form_submit(['name'=>'submit','value'=>'Submit','class'=>'btn btn-primary']);

   ?>
   
  </fieldset>
</form>