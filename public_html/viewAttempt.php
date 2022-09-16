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
		  .easy { background-image: url("images/smile.png"); width:72px; height:72px;}
		  .neutral { background-image: url("images/neutral.png"); width:72px; height:72px;}
		  .tough { background-image: url("images/tough.png"); width:72px; height:72px;}
		  .modal-backdrop.in {
			  
			  opacity: .9;
			}
		  #container-wrap {
			  display: none;
			}
			.modal-dialog {
			  width: 90%;
			  height: 90%;
			  margin: 0;
			  padding: 0;
			}
			
			.modal-content {
			  height: auto;
			  min-height: 100%;
			  border-radius: 0;
			}
			
			.viewattemptsuccess {
			border: 1px solid #22ba9b;
			background-color:#f2fff7;
			}
			.viewattemptfail {
			border: 1px solid #ef7739;
			background-color:#f5eae6;
			}	
			.successColor {
			color:#22ba9b;
			}
			 
			.failColor {
			color:#ef7739;
			}
			
			.viewAns {
			border: 1px solid #22ba9b;
			color:#22ba9b;
			}
			
			
			
		</style>
        <style id="dataArticlecss">
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
                             <div class="col-lg-12" align="center" >
						         <article>
                                    <div id="container-wrap" >



                                    </div>
                                </article>
                                <br><br>
                                <button type="button" id="showArticle" class="btn btn-default btn-xl">Show Text</button>
                             </div>
                             <div class="col-lg-12 test11" align="center" style="background: #f5f6f8;">
                                 <div ><br><div id="dataactivityDet" class="pageTitlenew"></div><br>
                                   <br>
                                   <div id="dataAttemptmarks"></div><br>
                                   <div id="dataTotmarks" align="right" style="margin-right:15px"></div><br>
                                   <div id="dataShowlanggame" ></div>
                                 
                                 </div>
                            </div>   
                            <div >
                             <div class="col-lg-12">
                                   <div class="col-lg-6">
                                        <input type="button" id="generatePDF"  value="Download Answers" class="btn btn-default btn-xs" style="margin-right:15px; margin-bottom:10px; padding:5px 20px; background-color:#CCCCCC; color:#000000; border:1px solid #666666">
                                   </div>
                                   <div class="col-lg-6" align="right"> 
                                         <input type="button" id="attempAgain"  value="Attempt Again" class="btn btn-default btn-xs" style="padding:5px 20px; ">
                                   </div>
                               </div> 
                               
                               <div class="col-lg-12">
                                      
                           
                              </div>
                   
                       
                        
                        
                    <!-- /.row -->
                    
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        
       
                           
       
        <!-- Modal content quick tips-->
         <div class="modal fade" id="viewQuicktips" role="dialog" align="center">
                                   <div class="modal-dialog" style="margin-top:30px;">
                            
                                      <!-- Modal content-->
                                      <div class="modal-content">
                                             <div class="modal-header" style="border-bottom:none">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  
                                              </div>
                                         
                                          <div class="modal-body" id="dataShowquicktips">
                                              
                                         </div>
                                          <!--<div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                         </div>-->
                                     </div>
                              
                                 </div>
         </div>

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
        
		<script>
		$(document).ready(function () {
		     
		    //-----------get article detail --------------------------------------
			$("#showArticle").on("click", function () { 
			      
				 $("#container-wrap").slideToggle("slow");
				 $(this).text( $(this).text() == 'Show Text' ? "Hide Text" : "Show Text");
				   var artDetail = 1;
					   var art_id = <?php echo $_REQUEST['artID'];?>; 
					   var artDetailcss ='';
					   var mag_id = <?php echo $_REQUEST['magID'];?>;
					   $.ajax({
								type: 'POST',
								url: 'data/getArticle.php',
								data: {artDetail:artDetail, art_id:art_id, artDetailcss:artDetailcss, mag_id:mag_id},
								cache: false,
								success: function(data){
								   $("#container-wrap").html(data);
								  
								}
					});
					
					var artDetail = '';
					   var art_id = <?php echo $_REQUEST['artID'];?>;
					   var artDetailcss =1;
					   var mag_id = <?php echo $_REQUEST['magID'];?>;
					   $.ajax({
								type: 'POST',
								url: 'data/getArticle.php',
								data: {artDetail:artDetail, art_id:art_id, artDetailcss:artDetailcss, mag_id:mag_id},
								cache: false,
								success: function(data){
								   $("#dataArticlecss").html(data);
								  
								}
					});
			});
			
			
			//---------------------------------------------------------------
		   
		
			 
			 $("#attempAgain").on("click", function (){
			    window.location='activity-detail.php?artID=<?php echo $_REQUEST['artID'];?>&actID=<?php echo $_REQUEST['actID'];?>&magID=<?php echo $_REQUEST['magID'];?>';
			 });
			 
			 $(window).on('load', function() { 
				  
				   var langG = 1; 
				   var art_id = <?php echo $_REQUEST['artID'];?>;
				   var mag_id = <?php echo $_REQUEST['magID'];?>;
				   var act_id = <?php echo $_REQUEST['actID'];?>;
				   var attmt_id = <?php echo $_REQUEST['attmt'];?>;
				   var totMarks ='';
					   $.ajax({
								type: 'POST',
								url: 'data/langGame313viewattempt.php',
								data: {langG:langG, art_id:art_id,mag_id:mag_id,act_id:act_id,totMarks:totMarks, attmt_id:attmt_id},
								cache: false,
								success: function(data){
								   $("#dataShowlanggame").html(data);
								  
								}
					});
					
					var activityDet = 1; 
					$.ajax({
								type: 'POST',
								url: 'data/activityDet.php',
								data: {activityDet:activityDet,art_id:art_id,mag_id:mag_id,act_id:act_id},
								cache: false,
								success: function(data){
								   $("#dataactivityDet").html(data);
								  
								}
					});
			});		
			$(window).on('load', function() { 		
					var langG = '';
					var totMarks =1;
					var art_id = <?php echo $_REQUEST['artID'];?>;
				   var mag_id = <?php echo $_REQUEST['magID'];?>;
				   var act_id = <?php echo $_REQUEST['actID'];?>;
				   var attmt_id = <?php echo $_REQUEST['attmt'];?>;
					$.ajax({
								type: 'POST',
								url: 'data/langGame313viewattempt.php',
								data: {langG:langG, art_id:art_id,mag_id:mag_id,act_id:act_id,totMarks:totMarks, attmt_id:attmt_id},
								cache: false,
								success: function(data){
								   $("#dataTotmarks").html(data);
								  
								}
					});
			});
		});
		
		$(window).on('load', function() { 
				  
				   var vAttemptsmarks = 1;
				   var art_id = <?php echo $_REQUEST['artID'];?>;
				   var mag_id = <?php echo $_REQUEST['magID'];?>;
				   var act_id = <?php echo $_REQUEST['actID'];?>; 
				    var attmt_id = <?php echo $_REQUEST['attmt'];?>;
					   $.ajax({
								type: 'POST',
								url: 'data/selectAttemptmarks.php',
								data: {vAttemptsmarks:vAttemptsmarks, art_id:art_id,mag_id:mag_id,act_id:act_id, attmt_id:attmt_id},
								cache: false,
								success: function(data){
								   $("#dataAttemptmarks").html(data);
								   $
								}
					});
			});		
		
		//---------------------------download PDF answers -----------------------
		$("#generatePDF").click(function () {
			let doc = new jsPDF('p', 'pt', 'a4');
			//var printableArea = document.getElementById('dataShowlanggame');
			var options = {
				 
			};
			doc.addHTML($(".test11"), options, function () {
				doc.save('testpoc.pdf');
				
			});
		});
		
		
		

		</script>
		
		
		

    </body>
</html>
