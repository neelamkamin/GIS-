<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charrshet="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <title>Projects Lists</title>
	   <style type="text/css">
			pre {
				    white-space: pre-wrap;       /* Since CSS 2.1 */
				    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
				    white-space: -pre-wrap;      /* Opera 4-6 */
				    white-space: -o-pre-wrap;    /* Opera 7 */
				    word-wrap: break-word;       /* Internet Explorer 5.5+ */
				}
		</style>	
		<link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/bootstrap.min.css") ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url("assests/css/mm.css") ?>">

    <script src="<?= base_url("assests/js/jquery.min.js") ?>"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#linkIncrease').click(function(){
					modifyfontsize('increase');
				});

				$('#linkDecrease').click(function(){
					modifyfontsize('decrease');
				});

				$('#linkReset').click(function(){
					modifyfontsize('reset');
				});


				function modifyfontsize(flag)
				{
					var divElement = $('#divContent');
					var currentFontsize = parseInt(divElement.css('font-size'));

					if (flag =='increase')
						currentFontsize += 2;
					else if (flag =='decrease')
						currentFontsize -= 2;
					else
						currentFontsize = 15;
					
					divElement.css('font-size', currentFontsize);
				}
			});
</script>
    
 </head>
<body>

 <button class="btn btn-default" style="float:left"><a href="<?php echo site_url("Admin/show_cost") ?>">Home</a></button>

<button class="btn btn-default" style="float:right">		
  			<?php  //HERE WE LINK FOR PDF CONVERTER //
  					echo '<a href="'.base_url().'Admin/pdfdetails/'.$art_id->id.'">Print Report</a>' 
  			?> 
  	</button>
 <h2 style="color:brown;" align="center">GOVERNMENT OF ARUNACHAL PRADESH <br>DEPATEMENT OF IT & COMMUNICATION <br>
 	DIGITAL CELL:: ROOM-107, BLOCK-1, CIVIL SECRETARIAT
 </h2>
 <hr>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6">
			<h1 style="color:blue;"> <?= "<b>PROJECT NAME</b>:-   . $art_id->title ." ?> </h1>
		 </div>
		<div class="col-lg-6"> 
			<span class="pull-right">
			<h3 style="color:green;">	<?= "<b>SUBMITTED ON DATE</b>:- "  .  date('d M Y', strtotime($art_id->reported_at)); ?> </h3>
			</span>
		</div>
		<div class="col-lg-6"> 
			<span class="pull-right">
			<h3 style="color:green;">	
				<?=  //WE RECEIVED THIS "$art_id" OBJECT FROM "public function article( $id )" FUNCTION OF "User.php" FILE OF CONTROLLERS FOLDER//
				 "<b>PROJECT IN-CHARGE</b> :-" . $art_id->user_id 
				 ?> 
			</h3>
			</span>
			<h3 style="color:green;">	
				<?=  
				 "<b>SADA Financial Year</b> :-" . $art_id->FY 
				 ?> 
			</h3>

		</div>

		<div class="col-lg-6"> 
			<span class="pull-right">
				<h3 style="color:green;">	
		<?=  "<b>CATEGORY OF FUND</b> :-" . $art_id->category ?> 
			</h2>
			<h1 style="color:red;">	<?= "<b>TOTAL PROJECT COST :- Rs." . $art_id->cost ?> Lakhs </b> </h1>
			</span>
		</div>

		<div class="col-lg-6"> 
			<span class="pull-right">
			<h1 style="color:red;">	<?= "<b>TOTAL EXPENSES :- Rs.". $art_id->exp ?> Lakhs </b> </h1>
			</span>
		</div>

		<div class="col-lg-6"> 
			<span class="pull-right">
			<h1 style="color:blue;">	<?= "<b>AVAILABLE BALANCE :- Rs." . ($art_id->cost - $art_id->exp)  ?> Lakhs </b> </h1>
			</span>
		</div>
	</div>
</div>		
	<hr> 
<!---Use font awsome for style !-->
	    <button class="btn btn-primary"><a id="linkIncrease" href="#">&nbsp; &nbsp; &nbsp; A+ &nbsp;</a> </button>
		<button class="btn btn-primary"><a id="linkDecrease" href="#">&nbsp; A- &nbsp;</a> </button>
		<button class="btn btn-default"><a id="linkReset" href="#">&nbsp; Reset</a> </button>

<div class="container-fluid">
  <div id="divContent" class="divClass">
	<div class="row">
		   <div class="col-lg-5">
			<pre>   
				<?php 			
				 $output = strip_tags($art_id->body);
				 echo "<b style='background-color:powderblue;'> Project Profile </b> :- <br> <p style='font-size:140%;'>" . $output;
				 ?> </p> 
			</pre>
	    		
	    	</p>	
	      </div>
	       <div class="col-lg-1">  
	       </div>
	      <div class="col-lg-6">  
         	  <pre>
				<?php 			
				echo "<b b style='background-color:powderblue;'>Current Status/ Issues</b> :- <br> <p style='font-size:140%;'>" . $art_id->remark
				 ?> </p>
	    	  </pre>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
</body>
</html> 
