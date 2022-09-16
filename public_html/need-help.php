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
						 <br>
                         <div class="col-lg-12" align="right"><input type="button" id="cancel" value="Back" class="btn btn-success" style="font-weight:bold"></div>
                        <div class="col-lg-9" >&nbsp;
						    <div class="pageTitlenew">Edutique Tutorial Video </div>
						    <div  class="normaltext">A short video tutorial to get you started with our platform</div>
						    <div class="videoclass">
						       <video class="videoclass" controls>
					             <source src="video/Piper.mp4" type="video/mp4">
					           </video>
						    </div>
                            <br><br> 
							<div class="pageTitlenew">Frequently Asked Questions</div><br>
					       
					          <div class="row">
                                   <?php if($_SESSION['utypeid'] == $admtchconst) {?>
                                   <div class="col-lg-6"  >
					                    <a href="educator-faq.php" class="btn btn-lg btn-success btn-block stptbuttontoppad">For Educators</a>
                                   </div>
                                   <?php } ?>
                                   <div class="col-lg-6"  >
					                    <a href="student-faq.php" class="btn btn-lg btn-success btn-block stptbuttontoppad">For Students</a>
                                   </div>
                                   <div class="col-lg-6"  >     
					                   <a href="parent-faq.php" class="btn btn-lg btn-success btn-block stptbuttontoppad">For Parents</a>
                                   </div>
                              </div>         
					          <br><br> 
					          <div class="pageTitlenew">Still have a question </div>
					          <p class="normaltext">If you have queries about our magazines or products,this is the place where you can reach us for admin related matters</p>
							  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="messageId">
							        <input type="text" name="messagetitle" id="messagetitle"  class="form-control" placeholder="Message Title" >
                                    <span id="messagetitle-info" class="info"></span><br>
                                    <textarea class="form-control" rows="3"  id="messagetext" name="messagetext" placeholder="Leave your question here and we will get back to you as soon as possible" ></textarea>
                                    <span id="messagetext-info" class="info"></span><br>
                                    <a href="viewmessage.php" class="btn btn-default btn-xl" >View Message Log</a>
                                    <button class="btn btn-default btn-xl btnAlign" id="msgid">Send Message</button>
                                    
							</form>
                            <br><br>
							
							
							
							 
						
							 
							
							
							  
                      
                    
                     
                   
					
                         
                        </div>
                        <div class="col-lg-3"  >
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                       
                        
                        
                    <!-- /.row -->
                    <div class="chatBox" ><a href="live-chat.php" class="btn btn-default btn-xl">Chat with support</a></div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        
         <!-- Modal popup form for success -->
                               <div class="modal fade" id="successAll" role="dialog" align="center">
                                   <div class="modal-dialog" style="margin-top:150px;">
                            
                                      <!-- Modal content-->
                                      <div class="modal-content1">
                                         
                                          <div class="modal-body1">
                                              
                                              <img src="images/tick-icon.png" width="100" height="100" style="width:100px; height:100px;">
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
		<script>
		$(document).ready(function () {
		     $('#cancel').on('click', function(e){
				e.preventDefault();
				window.history.back();
			    });
			$("#messageId").on("submit", function () {
			  $(".info").html("");
			$("messagetext").removeClass("input-error");
			  var messagetext = $("#messagetext").val();
			  $("messagetitle").removeClass("input-error");
			  var messagetitle = $("#messagetitle").val();

			  if (messagetitle == "") {
					$("#messagetitle-info").html("Please enter the Message title.");
					$("#messagetitle").addClass("input-error");
					 return false;
			  }else if (messagetext == "") {
					$("#messagetext-info").html("Please enter the Message.");
					$("#messagetext").addClass("input-error");
					 return false;
			  }else{ 
			       $.ajax({
						type: 'POST',
						url: 'data/messageInsert.php',
						data: {messagetext:messagetext,messagetitle:messagetitle},
						cache: false,
						success: function(data){
						   //alert('Your message is sent successfully. Admin will get back to you within 72 hours');
						   $('#successAll').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					        });
					        setTimeout(function() {$('#successAll').modal('hide');}, 2000);
							setTimeout(function(){
                                window.location='need-help.php';
                             }, 2000);
						   
						   
						}
				  });event.preventDefault();
			  }
			
			
			
		  });
		});
		</script>
		
		
		

    </body>
</html>
