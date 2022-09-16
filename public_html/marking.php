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

$stmt = $mysqli->prepare("SELECT noti_title,noti_published_date,noti_content FROM edu_noti where noti_status=? and user_id=?");
$stmt->bind_param("ss", $param_status, $param_user_id);
// Set parameters 
$param_status = $active;
$param_user_id = $_SESSION["id"];
$stmt->execute();
$stmt->store_result();
$total_pages = $stmt->num_rows;
$stmt->fetch();
$stmt->close();
// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Number of results to show on each page.
$num_results_on_page = 20;
// Calculate the page to get the results we need from our table.
$calc_page = ($page - 1) * $num_results_on_page;
	
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
                            &nbsp;
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                 
                    <div class="row">
                        <br>
                        <div class="col-lg-12" align="right"><input type="button" id="cancel" value="Back" class="btn btn-success" style="font-weight:bold">
                        </div><br><br>
                        <div class="col-lg-12">
                            <div id="container-wrap">



							</div>
                            
                            
                        </div>
                        <!-- /.col-lg-8 -->
                        
                    </div>
                    <!-- /.row -->
                        <div class="row"><br><br><form method="post">
                        <div class="col-lg-6"><input class="form-control"  type="number" name="marksobtained" id="marksobtained"></div>
                         <div class="col-lg-6"><input type="button" id="saveMark" value="Save Marks" class="btn btn-success" style="font-weight:bold"></div></form>
                        </div><br><br>
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
		<!--<script type="text/javascript" src="canvasjs.js"></script>-->
		<!-- Custom Theme JavaScript -->
		<script src="js/startmin.js"></script>
		<script>
		$(document).ready(function () {
		    $(window).on('load', function() {
				var actDetail = 1;
				var art_id = <?php echo $_REQUEST['article_id']; ?>;
				var act_id = <?php echo $_REQUEST['activity_id']; ?>;
				var mag_id = <?php echo $_REQUEST['mag_id']; ?>;
				var addedBy = <?php echo $_REQUEST['addedBy']; ?>;

				$.ajax({
					type: 'POST',
					url: 'data/getPerformedActivity.php',
					data: {
						actDetail: actDetail,
						act_id: act_id,
						mag_id: mag_id,
						art_id: art_id,
						addedBy:addedBy
					},
					cache: false,
					success: function(data) {
						$("#container-wrap").html(data);

					}
				})

				
			});
			
			 //$(document).on("click", "#saveMark", function(e) { 
			 $('#saveMark').on('click', function(e) { 
					       e.preventDefault();
						   var marksAdd = 1;
					      var art_id = <?php echo $_REQUEST['article_id']; ?>;
							var act_id = <?php echo $_REQUEST['activity_id']; ?>;
							var mag_id = <?php echo $_REQUEST['mag_id']; ?>;
							var noti_id = <?php echo $_REQUEST['noti_id']; ?>;
							  var marksobtained   = $('#marksobtained').val();
							  var addedBy = <?php echo $_REQUEST['addedBy']; ?>;
							
					       $.ajax({
									type: 'POST',
								    url: 'data/getPerformedActivity.php',
									data: {
										marksobtained: marksobtained,
										act_id: act_id,
										mag_id: mag_id,
										art_id: art_id,
						                addedBy:addedBy,
										marksAdd:marksAdd,
										noti_id:noti_id
									},
									cache: false,
									success: function(data) { //console.log(response);
							        
							        $('#successAll').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
										});
										
							       setTimeout(function() {$('#successAll').modal('hide');}, 2000);
							      setTimeout(function(){
                                  // window.location='activityFeedback.php?artID=<?php #echo $_REQUEST['artID']; ?>&actID=<?php #echo $_REQUEST['actID']; ?>&magID=<?php #echo $_REQUEST['magID']; ?>';
                                 }, 2000);
						         }
					    });
					   
					  });
			
			
		});
		</script>
		<!-- Essential JS 2 Calendar's dependent scripts -->
		<script src="https://cdn.syncfusion.com/ej2/ej2-base/dist/global/ej2-base.min.js" type="text/javascript"></script>
		<script src="https://cdn.syncfusion.com/ej2/ej2-calendars/dist/global/ej2-calendars.min.js" type="text/javascript"></script>
		

    </body>
</html>
