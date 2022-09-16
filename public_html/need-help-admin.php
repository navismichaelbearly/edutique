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
		       select {
                      font-family: 'Poppins'!important;
                      color: #0F96E8;background: #fff;
	                  border:none;
                      }
              .selectheadback{ background-color:transparent; font-family: 'Poppins'!important; }

              .selectoptionback{ background-color:#fff !important; color:#707683; font-family: 'Poppins'!important; }
			 
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
						 <br>
                         <div class="col-lg-12" align="right"><input type="button" id="cancel" value="Back" class="btn btn-success" style="font-weight:bold"></div>
                        <div class="col-lg-9" >&nbsp;
						    
							<div class="pageTitlenew">Frequently Asked Questions</div><br>
					       
					          <div class="row">
                                   <div class="col-lg-6"  >
					                    <a href="educator-faq.php" class="btn btn-lg btn-success btn-block stptbuttontoppad">For Educators</a>
                                   </div>
                                   <div class="col-lg-6"  >     
					                   <a href="student-faq.php" class="btn btn-lg btn-success btn-block stptbuttontoppad">For Students</a>
                                   </div>
                                   <div class="col-lg-6"  >
					                    <a href="parent-faq.php" class="btn btn-lg btn-success btn-block stptbuttontoppad">For Parents</a>
                                   </div>
                                   <div class="col-lg-6"  >     
					                   <a href="addFAQ.php" class="btn btn-lg btn-success btn-block stptbuttontoppad" style=" color:#888889;border:2px dashed #888889; background-color:#f5f6f8">+ Add New</a>
                                   </div>
                              </div>
							</div>
                        <div class="col-lg-3"  >
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                     
                     <div class="row">
                                <br><br>
                                <div class="col-lg-10">                                   
                                      <div class="pageTitlenew">Message Log </div>
                                      <div align="right">
                                          <span class='normaltext'>Show:</span>
                                          <span> 
                                               <select id="selectMessagelog" name="selectCountry" class="selectheadback" >
                                                                <!--<option value=" ">Country</option>-->                                                            
                                                                <option  style='font-family:Arial, Helvetica, sans-serif !important;'  value="All" >All</option>
                                                                <option style='font-family:Arial, Helvetica, sans-serif !important;' value="Resolved">Resolved</option>
                                                                <option style='font-family:Arial, Helvetica, sans-serif !important;' value="Unresolved">Unresolved</option>
                                              </select>
                                          </span>
                                      </div>
                                        
                                      <div id="dataMessagelog"></div>
                                </div>
                                
                                
                                <div class="col-lg-2 buttontoppad">
                                       
                                </div>
                    </div>
                    <div class="row">              
                                <br><br>
                                <div class="col-lg-10" >                                   
                                      <div class="pageTitlenew">Tech Support Log </div>
                                      <div align="right">
                                          <span class='normaltext'>Show:</span>
                                          <span> 
                                               <select id="selectTechsup" name="selectCountry" class="selectheadback" >
                                                                <!--<option value=" ">Country</option>-->                                                            
                                                                <option style='font-family:Arial, Helvetica, sans-serif !important;' value="All">All</option>
                                                                <option style='font-family:Arial, Helvetica, sans-serif !important;' value="Resolved">Resolved</option>
                                                                <option style='font-family:Arial, Helvetica, sans-serif !important;' value="Unresolved">Unresolved</option>
                                              </select>
                                          </span>
                                      </div>
                                        
                                      <div id="dataTechsuplog"></div>
                                </div>
                                <div class="col-lg-2 buttontoppad">
                                       
                                </div>
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
        <script src=" https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
		<script>
		$(document).ready(function () {
		           $('#cancel').on('click', function(e){
				e.preventDefault();
				window.history.back();
			    });
                  $(window).on('load', function() { // onload jQuery Ajax Calls in PHP Script
						var messagelog = 'messagelog';
						var mesageVal ='All';
						var techsuplog = '';
					   $.ajax({
								type: 'POST',
								url: 'data/messageLoglist.php',
								data: {messagelog:messagelog,techsuplog:techsuplog,mesageVal:mesageVal},
								cache: false,
								success: function(data){
								   $("#dataMessagelog").html(data);
								    $('#example').dataTable({
										"bPaginate": true,
										"bLengthChange": false,
										"bFilter": false,
										"bInfo": true,
										"bAutoWidth": false,
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
																data: 'idMesslog='+selected_values,
																success: function(response) { 
																	$('#successAll').modal({
																			  backdrop: 'static',
																			  keyboard: true, 
																			 show: true
																		});
																		setTimeout(function() {$('#successAll').modal('hide');}, 2000);
																	   setTimeout(function() {
																			 window.location = 'need-help-admin.php';
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
					 
					 var techsuplog = 'techsuplog';
						var mesageVal ='All';
						var messagelog = '';
					   $.ajax({
								type: 'POST',
								url: 'data/messageLoglist.php',
								data: {messagelog:messagelog,techsuplog:techsuplog,mesageVal:mesageVal},
								cache: false,
								success: function(data){
								   $("#dataTechsuplog").html(data);
								   $('#example1').dataTable({
										"bPaginate": true,
										"bLengthChange": false,
										"bFilter": false,
										"bInfo": true,
										"bAutoWidth": false,
										"dom": 'Bfrtip',
										"buttons": [
											{
												text: 'Delete',
											    attr: {
												id: 'delete_recordstech',
												class: 'btn btn-success'
											   },
											   action: function ( e, dt, node, config ) {
													var reviewstech = [];
													$(".rev_checkboxtech:checked").each(function() {
														reviewstech.push($(this).data('rev-idtech'));
													});
													if(reviewstech.length <=0) {
														alert("Please select records."); 
													} 
													else {  
														WRN_PROFILE_DELETE = "Are you sure you want to delete "+(reviewstech.length>1?"these":"this")+" row?";
														var checkedtech = confirm(WRN_PROFILE_DELETE);
														if(checkedtech == true) {
															var selected_valuestech = reviewstech.join(",");
															$.ajax({
																type: "POST",
																url: "data/deleteAllrecords.php",
																cache:false,
																data: 'idMesslogtech='+selected_valuestech,
																success: function(response) { 
																	$('#successAll').modal({
																			  backdrop: 'static',
																			  keyboard: true, 
																			 show: true
																		});
																		setTimeout(function() {$('#successAll').modal('hide');}, 2000);
																	   setTimeout(function() {
																			 window.location = 'need-help-admin.php';
																		  }, 2000);
																	var idstech = response.split(",");
																	for (var i=0; i < idstech.length; i++ ) {	
																		$("#"+idstech[i]).remove(); 
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
				 
				 $('#selectMessagelog').on('change', function () {
                    var techsuplog = '';
					var messagelog = 'messagelog'; 
					var mesageVal = $(this).val();
					   $.ajax({
								type: 'POST',
								url: 'data/messageLoglist.php',
								data: {messagelog:messagelog,techsuplog:techsuplog,mesageVal:mesageVal},
								cache: false,
								success: function(data){
								   $("#dataMessagelog").html(data);
								   $('#example').dataTable({
										"bPaginate": true,
										"bLengthChange": false,
										"bFilter": false,
										"bInfo": true,
										"bAutoWidth": false,
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
																data: 'idMesslog='+selected_values,
																success: function(response) { 
																	$('#successAll').modal({
																			  backdrop: 'static',
																			  keyboard: true, 
																			 show: true
																		});
																		setTimeout(function() {$('#successAll').modal('hide');}, 2000);
																	   setTimeout(function() {
																			 window.location = 'need-help-admin.php';
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
				   
				   $('#selectTechsup').on('change', function () {
                    var techsuplog = 'techsuplog';
					var messagelog = ''; 
					var mesageVal = $(this).val();
					   $.ajax({
								type: 'POST',
								url: 'data/messageLoglist.php',
								data: {messagelog:messagelog,techsuplog:techsuplog,mesageVal:mesageVal},
								cache: false,
								success: function(data){
								   $("#dataTechsuplog").html(data);
								   $('#example1').dataTable({
										"bPaginate": true,
										"bLengthChange": false,
										"bFilter": false,
										"bInfo": true,
										"bAutoWidth": false,
										"dom": 'Bfrtip',
										"buttons": [
											{
												text: 'Delete',
											    attr: {
												id: 'delete_recordstech',
												class: 'btn btn-success'
											   },
											   action: function ( e, dt, node, config ) {
													var reviewstech = [];
													$(".rev_checkboxtech:checked").each(function() {
														reviewstech.push($(this).data('rev-idtech'));
													});
													if(reviewstech.length <=0) {
														alert("Please select records."); 
													} 
													else {  
														WRN_PROFILE_DELETE = "Are you sure you want to delete "+(reviewstech.length>1?"these":"this")+" row?";
														var checkedtech = confirm(WRN_PROFILE_DELETE);
														if(checkedtech == true) {
															var selected_valuestech = reviewstech.join(",");
															$.ajax({
																type: "POST",
																url: "data/deleteAllrecords.php",
																cache:false,
																data: 'idMesslogtech='+selected_valuestech,
																success: function(response) { 
																	$('#successAll').modal({
																			  backdrop: 'static',
																			  keyboard: true, 
																			 show: true
																		});
																		setTimeout(function() {$('#successAll').modal('hide');}, 2000);
																	   setTimeout(function() {
																			 window.location = 'need-help-admin.php';
																		  }, 2000);
																	var idstech = response.split(",");
																	for (var i=0; i < idstech.length; i++ ) {	
																		$("#"+idstech[i]).remove(); 
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
				   
				   $(document).on("change", "#messStatuschange", function(){
				   //$('#messStatuschange').on('change', function () { 
					var messagelog = '<?php echo $nontech;?>'; 
					var mesageStatusval = $(this).val();
					   $.ajax({
								type: 'POST',
								url: 'data/updateMestechlogstatus.php',
								data: {messagelog:messagelog,mesageStatusval:mesageStatusval},
								cache: false,
								success: function(data){
								   window.location='need-help-admin.php';
								}
					 });
                   });
				   
				   $(document).on("change", "#techStatuschange", function(){
				   //$('#messStatuschange').on('change', function () { 
					var messagelog = '<?php echo $tech;?>'; 
					var techStatusval = $(this).val();
					   $.ajax({
								type: 'POST',
								url: 'data/updateMestechlogstatus.php',
								data: {messagelog:messagelog,techStatusval:techStatusval},
								cache: false,
								success: function(data){
								   window.location='need-help-admin.php';
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
					
					$(document).on('click', '#select_alltech', function() {
						$(".rev_checkboxtech").prop("checked", this.checked);
						$("#select_counttech").html($("input.rev_checkboxtech:checked").length+" Selected");
					});
					$(document).on('click', '.rev_checkboxtech', function() {
						if ($('.rev_checkboxtech:checked').length == $('.rev_checkboxtech').length) {
						$('#select_alltech').prop('checked', true);
						} else {
						$('#select_alltech').prop('checked', false);
						}
						$("#select_counttech").html($("input.rev_checkboxtech:checked").length+" Selected");
					}); 
			  
		});
		</script>
		
		
		

    </body>
</html>
