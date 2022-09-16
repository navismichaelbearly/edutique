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

if($_SESSION["utypeid"]== $admstdconst){
  $needHelp = "need-help.php";
}else if($_SESSION["utypeid"]== $admconst){
  $needHelp = "need-help-admin.php";
}else if($_SESSION["utypeid"]== $admtchconst){
  $needHelp = "need-help.php";
}

/* Select Query to get FAQ Type */
$stmt = $mysqli->prepare("SELECT faq_type,id FROM edu_faq_type where status=? and faq_type = ?");
/* Bind parameters */
$stmt->bind_param("ss", $param_status,$param_faq_type);
/* Set parameters */
$param_faq_type = $parentFaq;
$param_status = $active;
$stmt->execute();
$stmt->bind_result($faq_type, $faq_typeid);
$stmt->fetch();
$stmt->close();
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
		
	 
			
			
    </head>
    <body oncontextmenu="return false;">

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

            <div id="page-wrapper">
                <div class="row">
                        <?php include 'inc/gsearch.php'; ?>
                        <!-- /.col-lg-12 -->
                </div>
                <div class="container-fluid">
                     <div class="row">
                        <div class="col-lg-12">
                            <br><a href="<?php echo $needHelp; ?>" class="themelinkcolor"><i class="arrowFaq leftFaq"></i><span style="vertical-align:top"> Need Help</span></span></a><br><br>
                            
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                 
                    <div class="row">
                        <div class="col-lg-12">
                            
                                
                                
                                    <!-- display data from Ajax call -->
                                    <div id="dataTableshow"></div>
                                    <div class="chatBox" ><a href="live-chat.php" class="btn btn-default btn-xl">Chat with support</a></div>
									
									 
									 
											
                                    
                              
                            
                            
                        </div>
                        <!-- /.col-lg-8 -->
                        
               
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
		<script>
		$(document).ready(function () {
			$(window).on("load", function(){   // onload jQuery Ajax Call in PHP Script 
			    var faqType = '<?php echo $faq_typeid; ?>';
               $.ajax({
				type: 'POST',
				url: 'data/selectFaqlist.php',
				data: {faqType:faqType},
				cache: false,
				success: function(data){
				   $("#dataTableshow").html(data);
				  
				}
			  });
            });
			
			
		});
			
		</script>
		

    </body>
</html>
