<?php
/* to display errors */
error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start(); /*Session Start*/
/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
/* include files */
require_once "inc/config.php";
include "inc/constants.php";

	  
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Edutique System</title>
		
        
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
       <!-- Essential JS 2 Calendar's dependent material theme -->
            <link href="https://cdn.syncfusion.com/ej2/ej2-base/styles/material.css" rel="stylesheet" type="text/css" />
            <link href="https://cdn.syncfusion.com/ej2/ej2-buttons/styles/material.css" rel="stylesheet" type="text/css" />
            <link href="css/material.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
		
        
        <link href='lib/main.css' rel='stylesheet' />
        <style>
		  .annocom {cursor: pointer;}
		  .emoji { background-color:transparent; border:none; height:60px}
		  .easy { background-image: url("images/smile-bw.png"); width:72px; height:72px;}
		  .neutral { background-image: url("images/neutral-bw.png"); width:72px; height:72px;}
		  .tough { background-image: url("images/tough-bw.png"); width:72px; height:72px;}
		  .modal-backdrop.in {
			  
			  opacity: .9;
			}
			.imgBigeasy {background-image: url("images/smile.png");width:72px; height:72px; }
			.imgBigneutral {background-image: url("images/neutral.png"); width:72px; height:72px; }
			.imgBigtough {background-image: url("images/tough.png"); width:72px; height:72px; }
		</style>
    </head>
    <body oncontextmenu="return false;" >

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar-inverse navbar-fixed-top" role="navigation">
                
				<!-- toggle menu in mobile and tablet view -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- /.navbar-top-links -->

                 <?php include 'inc/sidebar.php'; ?>
                </nav> 

            <div id="page-wrapper" ><div id="testback"></div>
                <div class="row">
                        <?php include 'inc/gsearch.php'; ?>
                        <!-- /.col-lg-12 -->
                </div>
                <div class="container-fluid">
                    
                 
                    
					     <div class="row">
						 <div class="col-lg-4" ></div>
                        <div class="col-lg-4" align="center" >&nbsp;
						    <div class="pageTitlenew">How did you find the activity? </div><br><br>
                            <form  id="feedbackSubmit">
						    <div style="font-size:48px">
                                 <input type="button" id="easy"  class="emoji easy">
                                 <input type="button" id="neutral"  class="emoji neutral">
                                 <input type="button" id="tough"  class="emoji tough">
                            </div>
						    
					       
					               
					          <br><br> 
					          <textarea class="form-control" rows="4"  id="messagetext" name="messagetext" placeholder="What did you like or did you have any struggles? Do you have any suggestions for improvement for us" ></textarea><br><br>
                                    <button type="button" class="btn btn-default btn-xl" id="skipact" style="background-color:#CCCCCC; color:#999999; border:1px solid #666666">Skip</button>&nbsp;&nbsp;
                                    <button class="btn btn-default btn-xl" id="subact" type="submit">Submit</button>
                                    
							</form>
                            <br><br>
							<div id="dataSuccess"></div>
							
							
							   <!-- Modal popup form for feedback success -->
                               <div class="modal fade" id="successfeedback" role="dialog" align="center">
                                   <div class="modal-dialog" style="margin-top:150px;">
                            
                                      <!-- Modal content-->
                                      <div class="modal-content" style="border: 2px solid #22ba9b; background-color:#e8faf0">
                                         
                                          <div class="modal-body1">
                                              <span class="material-icons-outlined" style="color:#22ba9b">check</span><br>
                                              Thank you for your Feedback,<br>
                                              You have completed this activity!<br>
                                              <!--<button type="button" id="reviewActivity1"  class="buttonblue">Review Activity</button>-->
                                         </div>
                                          <!--<div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                         </div>-->
                                     </div>
                              
                                 </div>
                              </div>
                              
                              <!-- Modal popup form for skip feedback -->
                               <div class="modal fade" id="skipfeedback" role="dialog" align="center">
                                   <div class="modal-dialog" style="margin-top:150px;">
                            
                                      <!-- Modal content-->
                                      <div class="modal-content" style="border: 2px solid #22ba9b; background-color:#e8faf0">
                                         
                                          <div class="modal-body1">
                                              <span class="material-icons-outlined" style="color:#22ba9b">check</span><br>
                                              You have completed this activity!<br>
                                              <!--<button type="button" id="reviewActivity2"  class="buttonblue">Review Activity</button>-->
                                         </div>
                                          <!--<div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                         </div>-->
                                     </div>
                              
                                 </div>
                              </div>
						
							 
							
							
							  
                      
                    
                     
                   
					
                         
                        </div>
                        <div class="col-lg-4" ></div>
                       
                        <!-- /.col-lg-12 -->
                    </div>
                       
                        
                        
                    <!-- /.row -->
                    
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        
       
       
       

		<!-- jQuery -->
		<script src="js/jquery.min.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>

		<!-- Metis Menu Plugin JavaScript -->
		<script src="js/metisMenu.min.js"></script>

		<!-- Morris Charts JavaScript -->
		<!-- <script src="js/raphael.min.js"></script>
		<script src="js/morris.min.js"></script>
		<script src="js/morris-data.js"></script>-->
		<script type="text/javascript" src="canvasjs.js"></script>
		<!-- Custom Theme JavaScript -->
		<script src="js/startmin.js"></script>
        <script src='lib/main.js'></script>
		<script>
		$(document).ready(function () {
		    $("#skipact").on("click", function () {
				  $('#skipfeedback').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					 });
					 
					  setTimeout(function(){
                                   window.location='activities.php';
                                 }, 2000);
				  
				});
		    
		     var easy ='';
			 var neutral ='';
			 var tough ='';
			 var emo='';
			 var art_id = <?php echo $_REQUEST['artID'];?>;
			 var act_id = <?php echo $_REQUEST['actID'];?>;
			 var mag_id = <?php echo $_REQUEST['magID'];?>;
			  $('#easy').on('click', function () { 
			    easy ='easy';
				emo = easy;
				$('#easy').addClass("imgBigeasy");
				$('#neutral').removeClass("imgBigneutral");
				$('#tough').removeClass("imgBigtough");
			  });
			   $("#neutral").on("click", function () {
			    neutral ='neutral';
				emo = neutral;
				
				$('#easy').removeClass("imgBigeasy");
				$('#neutral').addClass("imgBigneutral");
				$('#tough').removeClass("imgBigtough");
			  });
			  $("#tough").on("click", function () {
			    tough ='tough';
				emo = tough;
				
				$('#easy').removeClass("imgBigeasy");
				$('#neutral').removeClass("imgBigneutral");
				$('#tough').addClass("imgBigtough");
			  }); 
		    $(document).on("submit", "#feedbackSubmit", function(e){ // onclic function
				   e.preventDefault();
					 var messagetext = $("#messagetext").val();
					  if (emo == "") {
					alert("Please select the emoji.");
					 return false;
			  }else if (messagetext == "") {
					alert("Please enter the Message.");
					 return false;
			  }else{ 
			       $.ajax({
						type: 'POST',
						url: 'data/feedbackInsert.php',
						data: {messagetext:messagetext,emo:emo, art_id:art_id,act_id:act_id,mag_id:mag_id},
						cache: false,
						success: function(data){
						  // alert('Thank you for you valuale feedback');
						   $("#dataSuccess").html(data);
						  // setTimeout(function() {$('#successAll').modal('hide');}, 2000);
						  setTimeout(function(){
                                   window.location='activities.php';
                                 }, 2000); 
						}
				  });event.preventDefault();
			  }
				      
             });
			$("#reviewActivity1").on("click", function () { 
			  window.location='reviewActivity.php?artID=<?php echo $_REQUEST['artID'];?>&actID=<?php echo $_REQUEST['actID'];?>&magID=<?php echo $_REQUEST['magID'];?>';
			   
			});
			
			$("#reviewActivity2").on("click", function () { 
			  window.location='reviewActivity.php?artID=<?php echo $_REQUEST['artID'];?>&actID=<?php echo $_REQUEST['actID'];?>&magID=<?php echo $_REQUEST['magID'];?>';
			});
		     
		});
		</script>
		
		
		

    </body>
</html>
