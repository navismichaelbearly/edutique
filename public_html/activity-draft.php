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
        <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">        
        <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css">
        <style>
		       .toggle {
      --width: 80px;
      --height: calc(var(--width) / 3);

      position: relative;
      display: inline-block;
      width: var(--width);
      height: var(--height);
      border-radius: var(--height);
      cursor: pointer;
    }

    .toggle input {
      display: none;
    }

    .toggle .slider {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border-radius: var(--height);
      border: 2px solid #969696;
      box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
      transition: all 0.4s ease-in-out;
    }

    .toggle .slider::before {
      content: "";
      position: absolute;
      top: 2.5px;
      left: 2px;
      width: calc(var(--height)*0.6);
      height: calc(var(--height)*0.6);
      border-radius: calc(var(--height) / 2);
      border: 3px solid #969696;
      background-color:#999999;
      box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
      transition: all 0.4s ease-in-out;
    }

    .toggle input:checked+.slider {
      border-color: #3f3a60;
    }

    .toggle input:checked+.slider::before {
      border-color: #3f3a60;
      background-color: #3f3a60;
      transform: translateX(calc(var(--width) - var(--height)));
    }

    .toggle .labels {
      position: absolute;
      top: 3px;
      left: 0;
      width: 100%;
      height: 100%;
      color: #3f3a60;
      font-size: 12px;
      font-family: sans-serif;
      transition: all 0.4s ease-in-out;
    }

    .toggle .labels::after {
      content: attr(data-off);
      position: absolute;
      right: 5px;
      opacity: 1;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.4);
      transition: all 0.4s ease-in-out;
	  color: #999999;
    }

    .toggle .labels::before {
      content: attr(data-on);
      position: absolute;
      left: 5px;
      opacity: 0;
      text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.4);
      transition: all 0.4s ease-in-out;
    }

    .toggle input:checked~.labels::after {
      opacity: 0;
    }

    .toggle input:checked~.labels::before {
      opacity: 1;
    }
	
	.scrolls {
    overflow-x: scroll;
    overflow-y: hidden;
    height: 350px;
    white-space:nowrap;
}

    .scrolls2 {
    overflow-x: scroll;
    overflow-y: hidden;
    height: 350px;
    white-space:nowrap;
}
	
	* { box-sizing: border-box; padding: 0; margin: 0; font-family: sans-serif; }
div.wrapper {
    background-color: #ddd; width: auto; height: 64px;
    clear: both; overflow: hidden; margin-top: 16px;white-space: nowrap;
}
div.arrow {
    float: left; width: 10%; min-width: 24px; height: 300px; line-height: 300px;
    text-align: center; vertical-align: middle; overflow: hidden;
}

div.numWrap {
    float: left; height: 500px; line-height: 500px;
/*     height: calc(100% + 1px);*/
    width: 80%; vertical-align: middle;
    overflow: hidden; position: relative;
    white-space: nowrap;
  /*  lines added for mobile touch navigation*/
     overflow: hidden; overflow-x: scroll; position: relative; z-index: 0;
    -webkit-overflow-scrolling: touch;
    -webkit-transform: translatez(0);
    -ms-overflow-style: -ms-autohiding-scrollbar;

}
div.strip {
    position: absolute; left: 0px;
    width: auto; white-space: nowrap;
    transition: left 1s;
}
a.numberItem {
    display: inline-block; text-align: center; margin: 0px 8px;
    background-color: #fff; border-radius: 50%; width: 48px; height: 48px;
    font-size: 1.2em; line-height: 48px; text-decoration: none;
}
a.numberItem.visited { background-color: #fff; color: #01aebc; border: 2px solid #01aebc; }
a.numberItem.selected { background-color: #01aebc; color: #fff; }
div.controls { clear: both; }
div.controls > div.arrows { width: auto; margin: 0 12px; }
a, a:focus, a:active, a:link, a:visited {
    display: inline-block;
    text-decoration: none; font-weight: 600;
}



.navigation-color {
    font-size: 40px;
    color:#01AEBC;
    text-align: center;
}

.leftArrowDisable{
  color: black;
}
.rightArrowDisable{
  color:black;
}

.button {
  position: relative;
  margin: 0;
  padding-left: 14px;
  padding-right: 14px;
  padding-top: 2.8px;
  padding-bottom: 2.8px;
  background: #F55000;
  color: white;
  font-size: 14px;
}
.button::after {
  content: '';
  position: absolute;
  top: 0;
  width: 0;
  height: 0;
}
.button:hover {
  background: #EA804C;
}
/* Arrow Buttons */
/* ------------- */
.next::after,
.prev::after {
  border-style: solid;
}
/* Next Button */
/* ----------- */
.next::after {
  right: -26px;
  border-width: 13px;
  border-color: transparent transparent transparent #F55000;
}
.next:hover::after {
  border-left-color: #EA804C;
}
/* Prev Button */
/* ----------- */
.prev::after {
  left: -26px;
  border-color: transparent #F55000 transparent transparent;
  border-width: 13px;
}
.prev:hover::after {
  border-right-color: #EA804C;
}
select {
                      font-family: 'Poppins'!important;
                      color: #0F96E8;background: #fff;
	                  border:none;
                      }
.selectheadback{ background-color:transparent; font-family: 'Poppins'!important; }
.selectoptionback{ background-color:#fff !important; color:#707683; font-family: 'Poppins'!important; }
.annocom {cursor: pointer;}
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
                </div><br>
                
                <div class="container-fluid">
                  <br>
                  <div class="col-lg-12" align="right">
                                                    <?php
                                                    if ($_SESSION["utypeid"] == 5) { ?><a href="activities.php" class="btn btn-success">Activities</a>&nbsp;&nbsp;&nbsp;<a href="upload-content-activity.php?actID=0" class="btn btn-success">Add Activity</a><?php } ?>&nbsp;&nbsp;&nbsp;<input type="button" id="cancel" value="Back" class="btn btn-success" style="font-weight:bold">
                   </div><br>
                    <br><div class="pageTitlenew">Drafts</div><br><br>
                 
                    <form name="assigntaskform" id="assigntaskform">
					     <div class="row">
						 
                        <div class="col-lg-12" > 
                             <br>
							 <div id="articleDraftdata"></div>
                                        
                                        
                                         
					          
					         
							
							
							
							 
						
							 
							
							
							  
                      
                    
                     
                   
					
                         
                        </div>
                       
                        <!-- /.col-lg-12 -->
                    </div>
                       
                 </form>   
                        
                    <!-- /.row -->
                    
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
       
       <!-- Modal popup to view students -->
       <div class="modal fade" id="myModalviewstud" role="dialog">
           <div class="modal-dialog">
    
              <!-- Modal content-->
              <div class="modal-content">
                  <div class="modal-header" style="border-bottom:none">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Add Definition</h4>
                  </div>
                  <div class="modal-body">
                      
                      
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
        <script src=" https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap.min.js"></script>        
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
		<script>
		$(document).ready(function () {
			
			$('#cancel').on('click', function(e){
				e.preventDefault();
				window.history.back();
			    });
			$(window).on('load', function() { 
				   var articleDraft = 1;
				   var magazineid='';
					   $.ajax({
								type: 'POST',
								url: 'data/selectActivitydraftlist.php',
								data: {articleDraft:articleDraft},
								cache: false,
								success: function(data){
								   $("#articleDraftdata").html(data);
								   $('#example').dataTable({
										"bPaginate": true,
										"bLengthChange": false,
										"bFilter": true,
										"bInfo": true,
										"bAutoWidth": false ,
										"dom": 'Bfrtip',
										"buttons": [
											{
												text: 'Delete',
											    attr: {
												id: 'delete_records',
												class: 'btn btn-success'
											   },
											   action: function ( e, dt, node, config ) {
													var reviews = [];
													$(".rev_checkbox:checked").each(function() {
														reviews.push($(this).data('rev-id'));
													});
													if(reviews.length <=0) {
														alert("Please select records."); 
													} 
													else {  
														WRN_PROFILE_DELETE = "Are you sure you want to delete "+(reviews.length>1?"these":"this")+" row?";
														var checked = confirm(WRN_PROFILE_DELETE);
														if(checked == true) {
															var selected_values = reviews.join(",");
															$.ajax({
																type: "POST",
																url: "data/deleteAllrecords.php",
																cache:false,
																data: 'idActdraft='+selected_values,
																success: function(response) { 
																	$('#successAll').modal({
																			  backdrop: 'static',
																			  keyboard: true, 
																			 show: true
																		});
																		setTimeout(function() {$('#successAll').modal('hide');}, 2000);
																	   setTimeout(function() {
																			 window.location = 'activity-draft.php';
																		  }, 2000);
																	var ids = response.split(",");
																	for (var i=0; i < ids.length; i++ ) {	
																		$("#"+ids[i]).remove(); 
																	}	
																} 
															});
														} 
													}
												}
											}
										] 
								  });
								}
					});
			});	
			
			
			$('#mag').on('change', function () {
				  // e.preventDefault();
					var magazineid = $(this).val(); 
					var reflectionLog = '';
					   $.ajax({
								type: 'POST',
								url: 'data/selectReflectionloglist.php',
								data: {reflectionLog:reflectionLog, magazineid:magazineid},
								cache: false,
								success: function(data){
								  $("#reflectionLogdata").html(data);
								  $('#example').dataTable({
										"bPaginate": true,
										"bLengthChange": false,
										"bFilter": true,
										"bInfo": true,
										"bAutoWidth": false
								  });
								}
					 });
             });
			
			
			
			$(document).on('click', '#select_all', function() {
				$(".rev_checkbox").prop("checked", this.checked);
				$("#select_count").html($("input.rev_checkbox:checked").length+" Selected");
			});
			$(document).on('click', '.rev_checkbox', function() {
				if ($('.rev_checkbox:checked').length == $('.rev_checkbox').length) {
				$('#select_all').prop('checked', true);
				} else {
				$('#select_all').prop('checked', false);
				}
				$("#select_count").html($("input.rev_checkbox:checked").length+" Selected");
			}); 
			 
			
				
		});	
		
		
		</script>
		
		
		

    </body>
</html>
