<?php
session_start();
/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: login.php");
	exit;
}

/* include files */
require_once "inc/config.php";
include "inc/constants.php";

/* Select Query to check if bookmarked */
$stmt = $mysqli->prepare("SELECT bookmark FROM  edu_annotation_bookmark  WHERE art_id = ? and mag_id =? and anno_by=? and act_id=?");
/* Bind parameters */
$stmt->bind_param("ssss", $param_artid, $param_mgid, $param_anno_by, $param_actid);
/* Set parameters */
$param_artid = $_REQUEST['artID'];
$param_mgid = $_REQUEST['magID'];
$param_anno_by = $_SESSION['id'];
$param_actid = $_REQUEST['actID'];
$stmt->execute();
$stmt->bind_result($bookmark);
$stmt->fetch();
$stmt->close();



if ($stmt = $mysqli->prepare("SELECT a.audio_path from edu_activity a  where a.activity_status=?  and a.activity_id=? and a.mag_id= ? and a.activity_id= ?")) {



	$stmt->bind_param("ssss", $param_article_status, $param_article_id, $param_mag_id, $param_activity_id);
	// Set parameters 
	$param_article_status = $active;
	$param_article_id = $_REQUEST['artID'];
	$param_mag_id = $_REQUEST['magID'];
	$param_activity_id = $_REQUEST['actID'];

	$stmt->execute();
	/* bind variables to prepared statement */
	$stmt->bind_result($audio_path);
	$stmt->fetch();
	$stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
	<meta name="viewport" content="initial-scale=1.0,minimum-scale=.2,maximum-scale=1.0,user-scalable=no">
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

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

	<link href='lib/main.css' rel='stylesheet' />
	<link href='css/audioplayer.css' rel='stylesheet' />
	<!--<script src="TextTip.js"></script>
	    <link rel="stylesheet" href="TextTip.css">-->
	<!--<link rel="stylesheet" href="assets1/css/main11.css?version=1" />
        <link rel="stylesheet" href="assets1/css/html5sticky.css?version=1" />-->
	<style>
		input .inp {
			border: none;
			border-bottom: 1px solid #000000;

			outline: none;
			margin: 10px 0px;
			background: transparent;
		}

		/** add min height of 50 px to textarea */
		textarea.inp {
			min-height: 80px;
			/*min-width: 600px;*/
			min-width: 100%;
			/* add top bottom margin of 10 px*/
			margin: 10px 0px;
		}

		[placeholder]:focus::-webkit-input-placeholder {
			transition: text-indent 0.4s 0.4s ease;
			text-indent: -100%;
			opacity: 1;
		}

		.modal-backdrop.in {

			opacity: .9;
		}

		article {
			/*background: white;*/
			/*border-radius: 4px;*/
			font-size: 13pt;
			margin: auto;
			/* padding: 30px;*/
			/* position: absolute;*/
			text-align: justify;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
		}

		h1 {
			font-size: 17pt;
			text-align: center;
			text-decoration-line: underline;
			text-decoration-color: yellow;
		}

		.dropbtn {
			background-color: transparent;
			padding: 0px;
			font-size: 16px;
			border: none;
			cursor: pointer;
		}



		.dropdown {
			position: relative;
			display: inline-block;
		}


		.dropdown-content {
			display: none;
			position: absolute;
			background-color: #fff;
			min-width: 70px;
			overflow: auto;
			/*box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);*/
			z-index: 1;
		}

		.dropdown-content a {
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
		}

		.dropdown-content2 {
			display: none;
			position: absolute;
			background-color: #fff;
			min-width: 150px;
			overflow: auto;
			/*box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);*/
			z-index: 1;
			font-size: 9px;
		}

		.dropdown-content2 a {
			color: black;
			padding: 5px 5px;
			text-decoration: none;
			display: block;
		}

		/*.dropdown a:hover {background-color: #ddd;}*/

		.show {
			display: block;
		}

		.colorbackgreen {
			background-color: #86e0a3;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 5px 15px;
		}

		.colorbackpurple {
			background-color: #d9b8ff;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 5px 15px;
		}

		.colorbackyellow {
			background-color: #ffd866;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 5px 15px;
		}

		.colorbacklightblue {
			background-color: #75d7f0;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 5px 15px;
		}

		.colorbacklightgray {
			background-color: #e6e6e6;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 5px 15px;
		}

		.colorbackpink {
			background-color: #ffbdf2;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 5px 15px;
		}

		.colorbackorange {
			background-color: #fec470;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 5px 15px;
		}

		.colorbacklblue {
			background-color: #81caff;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 5px 15px;
		}

		.colorbackred {
			background-color: #ffafa4;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 5px 15px;
		}

		.colorbackgray {
			background-color: #afbccf;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 5px 15px;
		}

		.tabcolor {
			border: 5px solid #FFFFFF
		}

		.annocom {
			cursor: pointer;
		}

		.colorbackgreen1 {
			display: inline-block;
			background-color: #86e0a3;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 20px;
			border-radius: 8px;
		}

		.colorbackpurple1 {
			display: inline-block;
			background-color: #d9b8ff;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 20px;
			border-radius: 8px;
		}

		.colorbackyellow1 {
			display: inline-block;
			background-color: #ffd866;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 20px;
			border-radius: 8px;
		}

		.colorbacklightblue1 {
			display: inline-block;
			background-color: #75d7f0;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 20px;
			border-radius: 8px;
		}

		.colorbacklightgray1 {
			display: inline-block;
			background-color: #e6e6e6;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 20px;
			border-radius: 8px;
		}

		.colorbackpink1 {
			display: inline-block;
			background-color: #ffbdf2;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 20px;
			border-radius: 8px;
		}

		.colorbackorange1 {
			display: inline-block;
			background-color: #fec470;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 20px;
			border-radius: 8px;
		}

		.colorbacklblue1 {
			display: inline-block;
			background-color: #81caff;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 20px;
			border-radius: 8px;
		}

		.colorbackred1 {
			display: inline-block;
			background-color: #ffafa4;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 20px;
			border-radius: 8px;
		}

		.colorbackgray1 {
			display: inline-block;
			background-color: #afbccf;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 20px;
			border-radius: 8px;
		}

		.addbuttonborder {
			border: 3px solid #474948 !important;
		}


		/* The sticky note itself */
		.sticky-content {
			/*background: linear-gradient(
    180deg,
    rgba(187, 235, 255, 1) 0%,
    rgba(187, 235, 255, 1) 12%,
    rgba(170, 220, 241, 1) 75%,
    rgba(195, 229, 244, 1) 100%
  );*/
			width: 100%;
			height: 100%;
			font-size: 12px;
			min-height: 150px;
			margin: 10px;
			padding: 8px;
			border-radius: 5px;
			box-shadow: 5px 5px 2px grey;
		}

		.highlight {
			background-color: yellow;
		}

		.highlight3 {
			background-color: yellow;
		}

		.highlight2 {
			background-color: #d1fbeb;
		}

		.diselect {
			background-color: transparent;
		}

		media="all and (-ms-high-contrast:none)">*::-ms-backdrop,
		.svg-img {
			width: 100%;
		}

		#SpeechSynthesis {
			background-color: #FFFFFF;
			padding: 20px 10px;
			margin-top: 20px;
		}


		#container-wrap {
			margin: 0;
			font-family: "Barlow", sans-serif;
			padding: 1em;
			font-size: 100%;
		}
		
		#container-wrap2 {
			margin: 0;
			font-family: "Barlow", sans-serif;
			padding: 1em;
			font-size: 100%;
		}



		/* text highlight  */
		.tooltip {
			position: relative;
			display: inline-block;
			border-bottom: 1px dotted black;
		}

		.tooltip .tooltiptext {
			visibility: hidden;
			width: 120px;
			background-color: #555;
			color: #fff;
			text-align: center;
			border-radius: 6px;
			padding: 5px 0;
			position: absolute;
			z-index: 1;
			bottom: 125%;
			left: 50%;
			margin-left: -60px;
			opacity: 0;
			transition: opacity 0.3s;
		}

		.tooltip .tooltiptext::after {
			content: "";
			position: absolute;
			top: 100%;
			left: 50%;
			margin-left: -5px;
			border-width: 5px;
			border-style: solid;
			border-color: #555 transparent transparent transparent;
		}

		.tooltip:hover .tooltiptext {
			visibility: visible;
			opacity: 1;
		}

		/* text highlight end */

		#pagefullwidth {
			display: inline-block;
		}

		#rLoud {
			display: none;
		}

		/* Landscape phone to portrait tablet  show the button */
		@media (max-width: 767px) {

			#pagefullwidth {
				display: none;
			}

			#rLoud {
				display: none;
			}
		}

		.buttonGray {
			background-color: #cfd2d8;
			border: none;
			color: #454648;
			padding: 5px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 12px;
			cursor: pointer;
		}

		#myDIVsh {
			display: none;
		}

		#myDIVsh.show {
			display: block;
			/* P.S: Use `!important` if missing `#content` (selector specificity). */
		}

		#container-wrap p {
			font-family: Arial, Helvetica, sans-serif !important;
		}

		#container-wrap div {
			font-family: Arial, Helvetica, sans-serif !important;
		}

		#container-wrap span {
			font-family: Arial, Helvetica, sans-serif !important;
		}

		#container-wrap {
			font-family: Arial, Helvetica, sans-serif !important;
		}
		
		#container-wrap2 p {
			font-family: Arial, Helvetica, sans-serif !important;
		}

		#container-wrap2 div {
			font-family: Arial, Helvetica, sans-serif !important;
		}

		#container-wrap2 span {
			font-family: Arial, Helvetica, sans-serif !important;
		}

		#container-wrap2 {
			font-family: Arial, Helvetica, sans-serif !important;
		}
	</style>
	<style id="dataActivitycss">
	</style>

	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Source+Code+Pro:wght@200;600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@200;600&display=swap" rel="stylesheet">
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
			<div id="testback"></div>
			<div class="row">
				<div class="col-lg-12 searchbar toppad">
					<div class="sidebar-search">
						<!--<div class="input-group custom-search-form">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Global Search" style="border:none; box-shadow:none">                                    
                                </div>-->

						<i class="material-icons-outlined md-16 annocom" id="pagefullwidth" onClick="myTogglewidthfunction()">zoom_out_map</i>&nbsp;
						<i class="material-icons-outlined md-16 annocom" id="selectText">add_comment</i>
						<!--<i class="material-icons-outlined md-16 annocom" id="modalPop">create</i>-->&nbsp;
						<div class="dropdown">
							<button onClick="myFunction()" class="dropbtn material-icons-outlined" id="modalPop2">sticky_note_2</button>
							<div id="myDropdown" class="dropdown-content">
								<table class="tabcolor">
									<tr>
										<td><input type="button" value="" id="colorbackgray" class="colorbackgray"></td>
										<td><input type="button" value="" id="colorbackred" class="colorbackred"></td>
									</tr>
									<tr>
										<td><input type="button" value="" id="colorbacklblue" class="colorbacklblue"></td>
										<td><input type="button" value="" id="colorbackorange" class="colorbackorange"></td>
									</tr>
									<tr>
										<td><input type="button" value="" id="colorbackpink" class="colorbackpink"></td>
										<td><input type="button" value="" id="colorbacklightgray" class="colorbacklightgray"></td>
									</tr>
									<tr>
										<td><input type="button" value="" id="colorbacklightblue" class="colorbacklightblue"></td>
										<td><input type="button" value="" id="colorbackyellow" class="colorbackyellow"> </td>
									</tr>
									<tr>
										<td><input type="button" value="" id="colorbackpurple" class="colorbackpurple"> </td>
										<td><input type="button" value="" id="colorbackgreen" class="colorbackgreen"> </td>
									</tr>
								</table>



							</div>
						</div>&nbsp;
						<div class="dropdown"><?php #if(isset($_COOKIE['name'])) {echo $_COOKIE['name'];}  
												?>
							<?php if ($bookmark != 1) { ?>
								<button onClick="myFunction2()" class="dropbtn material-icons-outlined" id="modalPop3">star</button>
							<?php } else { ?>
								<button class="dropbtn material-icons-outlined" style="color:#FF0000; cursor:default" title="Article is already Bookmarked by you">star</button>
							<?php } ?>
							<div id="myDropdown2" class="dropdown-content2">
								<span style="padding:5px 0px 0px 5px">Save to Bookmark Folder</span>
								<div id="dataBookmarkfolder"></div><br>
								<span id="openModalpop" style="padding:10px;" class="annocom"><span class="material-icons md-16 annocom"><img src="images/create.png" width="22" height="22"></span>Create New Folder</span>
							</div>
						</div>
						<?php if ($_SESSION["utypeid"] == $admstdconst) { ?>
							<span style="float:right" class="btn btn-default btn-xs buttonGray" id="askaQues">Ask a question</span>
						<?php } ?>
					</div>
				</div>
				<!-- /.col-lg-12 -->
			</div>
            <br>
            <div class="col-lg-12" align="right"><input type="button" id="cancel" value="Back" class="btn btn-success" style="font-weight:bold"></div>
			<div class="container-fluid">
				<div id="dataCommentsview1" style="background-color:#99FF00"></div>
				<!--Error-->
				<div id="error_message" class="ui floating negative message" style="display: none">
					<div class="header"></div>
					<p class="message"></p>
				</div>

				<div class="row">
					<div class="col-lg-9" id="test123" onMouseUp="GetSelectedText ()">
						<!-- <div id="rLoud">
							<br>
							<div style="background:#FFFFFF; padding:10px">
								<audio preload='auto' controls>
									<source src='<?php echo $audio_path; ?>'>
								</audio>
								<center>Read aloud with me!</center>
							</div>
							<br>
						</div> -->
                        <div id="container-wrap2" class="container row col-lg-12" style="font-size:14px  !important; font-family:Arial, Helvetica, sans-serif !important">
								</div>
						<form id="activitySubmit">
							<article>
                                
								<div id="container-wrap" class="container row col-lg-12" style="font-size:14px  !important; font-family:Arial, Helvetica, sans-serif !important">
								</div>
							</article>
							<div align="right">
                                    <button type="button" id="showArticle" class="btn btn-default btn-xl" style="margin-bottom:20px;">Show Text</button>&nbsp;&nbsp;
                                    <button type="button" id="showArticle2" class="btn btn-default btn-xl" style="margin-bottom:20px;">Hide Text</button>&nbsp;&nbsp;
								<?php if ($_SESSION["utypeid"] == $admtchconst || $_SESSION["utypeid"] == $admprogtchconst) { ?><span><a href="task-assign.php" class="btn btn-default btn-xl" style="margin-bottom:20px; border:1px solid #999999; padding:5px 10px">Assign/Lock</a></span><?php } ?>
								<?php if ($_SESSION["utypeid"] == $admstdconst) { ?>
									<input type="submit" value="Submit" class="btn btn-default btn-xs" style="margin-right:15px; margin-bottom:10px; padding:5px 20px; ">
								<?php } ?>

							</div>
						</form>
						<div id="dataActSubmited"></div>


					</div>
					<!-- /.col-lg-8 -->
					<div class="col-lg-3" id="rightsidebar">
						<!--<br><br>
                            <i class="material-icons-outlined md-16 annocom" id="selectText">create</i>
                            <i class="material-icons-outlined md-16 annocom" id="modalPop">create</i>&nbsp;
                            <div class="dropdown">
                              <button onClick="myFunction()" class="dropbtn material-icons-outlined" id="modalPop2" >sticky_note_2</button>
                              <div id="myDropdown" class="dropdown-content">
                                <table class="tabcolor">
                                      <tr><td class="colorbackviolet"><a id="colorbackviolet" >&nbsp;</a></td><td class="colorbackyellow"><a id="colorbackyellow">&nbsp;</a></td></tr>
                                      <tr><td class="colorbacklblue"><a id="colorbacklblue">&nbsp;</a></td><td class="colorbackorange"><a id="colorbackorange">&nbsp;</a></td></tr>
                                      <tr><td class="colorbackgreen"><a id="colorbackgreen">&nbsp;</a></td><td class="colorbackpink"><a id="colorbackpink">&nbsp;</a></td></tr>
                                </table>      
                                
                                
                                
                              </div>
                            </div>&nbsp;
                            <div class="dropdown"><?php #if(isset($_COOKIE['name'])) {echo $_COOKIE['name'];}  
													?>
                              <?php #if($bookmark!=1) {
								?>
                              <button onClick="myFunction2()" class="dropbtn material-icons-outlined" id="modalPop3" >star</button>
                              <?php #}else {
								?>
                              <button class="dropbtn material-icons-outlined" style="color:#FF0000; cursor:default"  >star</button>
                              <?php #}
								?>
                              <div id="myDropdown2" class="dropdown-content2">
                                <span style="padding:5px 0px 0px 5px" >Save to Bookmark Folder</span>
                                <div id="dataBookmarkfolder"></div><br>
                                <span id="openModalpop" style="padding:10px;"><span class="material-icons md-16 annocom" >add_box</span>Create New Folder</span>
                              </div>
                            </div>-->
						<!--<i class="material-icons-outlined md-16 annocom" >star</i>-->
						<br>
						<?php
						if ($stmt = $mysqli->prepare("select path from edu_activity_audio where activity_id = ? ")) {



							$stmt->bind_param("s", $param_article_id);
							// Set parameters 
							$param_article_status = $active;
							$param_article_id = $_REQUEST['actID'];

							$stmt->execute();
							/* bind variables to prepared statement */
							$stmt->bind_result($audio_path);
							// fetch assoc array
							// create an array
							$audio_path_array = array();
							while ($stmt->fetch()) {
								$audio_path_array[] = $audio_path;
							}
							$stmt->fetch();
							$stmt->close();
						}
						?>

						<?php
						// foreach $audio_path loop 
						foreach ($audio_path_array as $value) {
						?>
							<div style="background:#FFFFFF; padding:10px" id="rLoud1">
								<audio preload='auto' controls>
									<source src='<?php echo $value; ?>'>
								</audio>
								<center>Read aloud with me!</center>
							</div>
						<?php } ?>

						<div id="dataComments"></div><br>

						<div id="dataStickyview"></div>
						<!--<div id="main">
                                   <a href="#" id="addnote"><img src="assets1/img/add.png" alt="Add Sticky Note" title="Add a new sticky note"></a>
                                   <a href="#" id="removenotes"><img src="assets1/img/remove.png" alt="Remove all sticky notes" title="Remove all sticky notes"></a>
                                   <div class="clear">&nbsp;</div>
                               </div>-->


					</div>
					<!-- /.col-lg-4 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->





	<!-- Modal popup form to change password -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<!--<div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Change Your Password</h4>
                      <p class="normaltext"><?php #echo $passwordStrengthtext;
											?>.</p>
                  </div>-->
				<div class="modal-body">
					<h4 class="modal-title">Add Comments</h4>
					<p class="normaltext"><?php #echo $passwordStrengthtext;
											?></p>
					<form role="form" action="" method="post">
						<fieldset>

							<div class="form-group <?php #echo (!empty($new_password_err)) ? 'has-error' : ''; 
													?>">
								<textarea class="form-control" placeholder="Comments" name="anno_comments" id="anno_comments" required></textarea>
								<span id="anno_comments-info" class="info"></span>
							</div>

							<input type="hidden" name="keytoken" value="<?php echo $keytoken; ?>">
							<input type="hidden" name="email" value="<?php echo $email; ?>">
							<input type="hidden" name="passaction" value="reset">
							<input type="hidden" name="topPosition" id="topPosition" value="">
							<input type="button" id="closeModalpop" value="cancel" class="btn btn-lg btn-success btn-block">
							<input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveAnnotationcomments">
						</fieldset>
					</form>
				</div>
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>


	<!-- Modal popup form for toottip -->
	<div class="modal fade" id="myModaltooltip" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content" style="padding: 5px 10px; margin-top:50px">

				<div class="modal-header" style="border-bottom:none; padding: 5px 10px;">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<!--<span onClick="myFunction3()" id="wordBanksave">Save to Word bank</span>-->
					<div class="dropdown">

						<a onClick="myFunction3()" id="modalPop4" style="color:#333333; text-decoration:none;" class="annocom">Save to Wordbank</a>

						<div id="myDropdown3" class="dropdown-content2">

							<div id="dataWordbankfolder"></div><br>
							<span id="openModalpopWB" style="padding:10px;" class="annocom"><span class="material-icons md-16 annocom"><img src="images/create.png" width="22" height="22"></span>Create New Folder</span>
						</div>
					</div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<div class="dropdown">
						<a onClick="myDropdownhifhlight()" class="dropbtn annocom" id="hlt" style="color:#333333; text-decoration:none; font-size: 13px;">Highlight</a>
						<div id="myDropdownhifhlight" class="dropdown-content">
							<table class="tabcolor">
								<tr>
									<td><input type="button" value="" id="colorbackgrayH1" class="colorbackgray"></td>
									<td><input type="button" value="" id="colorbackredH1" class="colorbackred"></td>
								</tr>
								<tr>
									<td><input type="button" value="" id="colorbacklblueH1" class="colorbacklblue"></td>
									<td><input type="button" value="" id="colorbackorangeH1" class="colorbackorange"></td>
								</tr>
								<tr>
									<td><input type="button" value="" id="colorbackpinkH1" class="colorbackpink"></td>
									<td><input type="button" value="" id="colorbacklightgrayH1" class="colorbacklightgray"></td>
								</tr>
								<tr>
									<td><input type="button" value="" id="colorbacklightblueH1" class="colorbacklightblue"></td>
									<td><input type="button" value="" id="colorbackyellowH1" class="colorbackyellow"> </td>
								</tr>
								<tr>
									<td><input type="button" value="" id="colorbackpurpleH1" class="colorbackpurple"> </td>
									<td><input type="button" value="" id="colorbackgreenH1" class="colorbackgreen"> </td>
								</tr>
							</table>



						</div>
					</div>
					<!--<span id="hihLighttext" class="annocom">Highlight</span>-->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="modalPop" class="annocom">Comment</span>

				</div>
				<!--<div class="modal-body">
                      
                 </div>-->
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>




	<!-- Modal popup form to change password -->
	<div class="modal fade" id="myModalviewcomment" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<!--<div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Change Your Password</h4>
                      <p class="normaltext"><?php #echo $passwordStrengthtext;
											?>.</p>
                  </div>-->
				<div class="modal-body">
					<h4 class="modal-title">Your Comment</h4>
					<p class="normaltext"><?php #echo $passwordStrengthtext;
											?></p>
					<form role="form" action="" method="post">
						<fieldset>

							<div class="form-group <?php #echo (!empty($new_password_err)) ? 'has-error' : ''; 
													?>">
								<textarea class="form-control" placeholder="Comments" name="anno_comments" id="dataCommentsview" required></textarea>
								<span id="anno_comments-info" class="info"></span>
							</div>

							<input type="button" id="closeModalpop2" value="cancel" class="btn btn-lg btn-success btn-block">
						</fieldset>
					</form>
				</div>
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>

	<!-- Modal popup form to change password -->
	<div class="modal fade" id="myModalcolor" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content" id="modal-content">


				<div class="modal-header" style="border-bottom:none">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div class="modal-body">

					<form role="form" action="" method="post">
						<fieldset>

							<div class="form-group">
								<textarea class="form-control" placeholder="Add Notes" name="anno_sticky" id="anno_sticky" required style="outline: none !important;
    border:1px solid #000000;"></textarea>
								<span id="anno_sticky-info" class="info"></span>
							</div>

							<input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveAnnotationsticky" style="background-color:#000000">
						</fieldset>
					</form>
				</div>
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>


	<!-- Modal popup form to create new bookmark folder -->
	<div class="modal fade" id="myModalBK" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header" style="border-bottom:none">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Create a new Bookmark folder</h4>
				</div>
				<div class="modal-body">

					<form role="form" action="" method="post">
						<fieldset>
							<label>Folder Name</label>
							<div class="form-group">
								<span id="dataBookmarktype"></span>
								<span id="dataBookmarkfolderexists"></span>

							</div>
							<label>Folder Colour</label>
							<div class="form-group">
								<table class="tabcolor">
									<tr>
										<td><input type="button" value="" id="colorbackgray1" class="colorbackgray1"></td>
										<td><input type="button" value="" id="colorbackred1" class="colorbackred1"></td>
										<td><input type="button" value="" id="colorbacklblue1" class="colorbacklblue1"></td>
										<td><input type="button" value="" id="colorbackorange1" class="colorbackorange1"></td>
										<td><input type="button" value="" id="colorbackpink1" class="colorbackpink1"></td>
									</tr>
									<tr>
										<td><input type="button" value="" id="colorbacklightgray1" class="colorbacklightgray1"></td>
										<td><input type="button" value="" id="colorbacklightblue1" class="colorbacklightblue1"></td>
										<td><input type="button" value="" id="colorbackyellow1" class="colorbackyellow1"> </td>
										<td><input type="button" value="" id="colorbackpurple1" class="colorbackpurple1"> </td>
										<td><input type="button" value="" id="colorbackgreen1" class="colorbackgreen1"> </td>
									</tr>
								</table>
							</div>
							<input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveFolder">
						</fieldset>
					</form>
				</div>
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>

	<!-- Modal popup form to create wordbank new folder -->
	<div class="modal fade" id="myModalWB" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header" style="border-bottom:none">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Create a new Wordbank folder</h4>
				</div>
				<div class="modal-body">

					<form role="form" action="" method="post">
						<fieldset>
							<label>Folder Name</label>
							<div class="form-group">
								<span id="dataWordbanktype"></span>
								<span id="dataWordbankfolderexists"></span>

							</div>

							<label>Folder Colour</label>
							<div class="form-group">
								<table class="tabcolor">
									<tr>
										<td><input type="button" value="" id="colorbackgray2" class="colorbackgray1"></td>
										<td><input type="button" value="" id="colorbackred2" class="colorbackred1"></td>
										<td><input type="button" value="" id="colorbacklblue2" class="colorbacklblue1"></td>
										<td><input type="button" value="" id="colorbackorange2" class="colorbackorange1"></td>
										<td><input type="button" value="" id="colorbackpink2" class="colorbackpink1"></td>
									</tr>
									<tr>
										<td><input type="button" value="" id="colorbacklightgray2" class="colorbacklightgray1"></td>
										<td><input type="button" value="" id="colorbacklightblue2" class="colorbacklightblue1"></td>
										<td><input type="button" value="" id="colorbackyellow2" class="colorbackyellow1"> </td>
										<td><input type="button" value="" id="colorbackpurple2" class="colorbackpurple1"> </td>
										<td><input type="button" value="" id="colorbackgreen2" class="colorbackgreen1"> </td>
									</tr>
								</table>
							</div>
							<input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveWBFolder">
						</fieldset>
					</form>
				</div>
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>

	<!-- Modal popup form to create wordbank new folder -->
	<div class="modal fade" id="myModalsaveexistWB" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header" style="border-bottom:none">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Definition</h4>
				</div>
				<div class="modal-body">

					<form role="form" action="" method="post">
						<fieldset>


							<div class="form-group">
								<textarea id="definition2" class="form-control"></textarea>
							</div>

							<input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveexistWBFolder">
						</fieldset>
					</form>
				</div>
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>
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
	<!-- Modal popup form for ask a queston -->
	<div class="modal fade" id="myModalaskaque" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content" id="modal-content">


				<div class="modal-header" style="border-bottom:none">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div class="modal-body">

					<form role="form" action="" method="post">
						<fieldset>

							<div class="form-group"><label>Send a Question to Teacher</label><br>
								<textarea class="form-control" name="s_Ques" id="s_Ques" required style="outline: none !important;
    border:1px solid #000000; color:#000000;" rows="5"></textarea>
								<span id="anno_sticky-info" class="info"></span>
							</div>

							<input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveSendaques">
						</fieldset>
					</form>
				</div>
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>
	<!-- jQuery -->


	<div class="modal fade" id="successAll1" role="dialog" align="center">
		<div class="modal-dialog" style="margin-top:150px;">

			<!-- Modal content-->
			<div class="modal-content1">

				<div class="modal-body1">

					<img src="images/tick-icon.png" width="100" height="100" style="width:100px; height:100px;">
					<div>
						<h2 style="color:#f9f9f9" id="successMessage"></h2>
					</div>
					<div>
						<h2 style="color:#f9f9f9; background-color:darkgreen" id="successclose">Click Here to Exit</h2>
					</div>

				</div>
				<!--<div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                         </div>-->
			</div>

		</div>
	</div>

	<input type="hidden" id="activity_result" value="">
	<input type="hidden" id="activity_type_id" value="">


	<script src="js/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->





	<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script-->

	<!-- <script>!window.jQuery && document.write(unescape('%3Cscript src="assets1/js/jquery1.6.2.js"%3E%3C/script%3E'))</script>-->

	<!--script src="assets1/js/respond.min.js"></script>
    <script src="assets1/js/modernizr.custom.23610.js"></script>
    <script src="assets1/js/html5sticky.js"></script>
    <script src="assets1/js/prettyDate.js"></script>
	<script src="magfile/compatibility.min.js"></script>
        <script src="magfile/theViewer.min.js"></script>
        <script>
              try{
                 theViewer.defaultViewer = new theViewer.Viewer({});
              }catch(e){}
        </script-->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/metisMenu.min.js"></script>
	<script src="js/startmin.js"></script>
	<script src='lib/main.js'></script>
	<script src="js/audioplayer.js"></script>
	<!--Scripts-->
	<!--Required for Annotator.js-->
	<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script-->

	<script>
		$(function() {
			$('audio').audioPlayer();
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
		    $('#cancel').on('click', function(e){
				e.preventDefault();
				window.history.back();
			    });
			//--------------ask a question---------------------------------

			$(document).on("click", "#successclose", function() {
				$('#successAll1').modal('hide');
				window.location.reload();
			});


			$('#askaQues').on('click', function() {
				varColor = '#afbccf';
				$('#myModalaskaque').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});

			});

			$('#saveSendaques').on('click', function() {
				var sendQues = 1;
				var ques_des = $("#s_Ques").val();
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var mag_id = <?php echo $_REQUEST['magID']; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/saveQuestion.php',
					data: {
						sendQues: sendQues,
						art_id: art_id,
						act_id: act_id,
						ques_des: ques_des,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						$('#successAll').modal({
							backdrop: 'static',
							keyboard: true,
							show: true
						});
						setTimeout(function() {
							$('#successAll').modal('hide');
						}, 2000);

						$('#myModalaskaque').modal('hide');
						//displayStickynotes(); 

					}
				});
				event.preventDefault();
			});
			//-----------save activity  --------------------------------------

			$(document).on("submit", "#activitySubmit", function(e) { // onclic function
				e.preventDefault();

				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var mag_id = <?php echo $_REQUEST['magID']; ?>;

				// fetch formdata in var
				var formData = new FormData($(this)[0]);
				//console.log(formData)
				// print formdata elements in console
				for (var pair of formData.entries()) {
					console.log(pair[0] + ', ' + pair[1]);
				}

				var activity_result = $('#activity_result').val();
				var activity_type_id = $('#activity_type_id').val();
				var user_id = <?php echo $_SESSION["id"]; ?>;

				// add activity_result to formdata
				formData.append('activity_result', activity_result);
				formData.append('activity_type_id', activity_type_id);
				formData.append('user_id', user_id);
				formData.append('activity_id', act_id);


				// ajax call to submitResult.php
				$.ajax({
					url: "data/submitActivityResult.php",
					type: "POST",
					data: formData,
					async: false,
					cache: false,
					contentType: false,
					processData: false,
					success: function(data) {
						// if success, call the function submitResult()
						//submitResult();
						console.log(data);
						// add data to div with id successMessage

						$('#successMessage').text(data);
						//$('#submitResult')[0].reset();
						setTimeout(function() {
							$('#successAll1').modal('hide');
						}, 10000);
						setTimeout(function() {
							//window.location = 'activities.php';
							// reload same page
							window.location.reload();
						}, 10000);

					}
				});
				$('#successAll1').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});


				//$('#submitResult')[0].reset();

				// var actperformed = 1;
				// var ansQ11 = $("#ansQ11").val();
				// var ansQ12 = $("#ansQ12").val();
				// var ansQ21 = $("#ansQ21").val();
				// var ansQ22 = $("#ansQ22").val();
				// var ansQ31 = $("#ansQ31").val();
				// var ansQ32 = $("#ansQ32").val();
				// var ansQ41 = $("#ansQ41").val();
				// var ansQ42 = $("#ansQ42").val();
				// var ansQ51 = $("#ansQ51").val();
				// var ansQ52 = $("#ansQ52").val();
				// $.ajax({
				// 	type: 'POST',
				// 	url: 'data/saveActivityperformed.php',
				// 	data: {
				// 		act_id: act_id,
				// 		art_id: art_id,
				// 		mag_id: mag_id,
				// 		actperformed: actperformed,
				// 		ansQ11: ansQ11,
				// 		ansQ12: ansQ12,
				// 		ansQ21: ansQ21,
				// 		ansQ22: ansQ22,
				// 		ansQ31: ansQ31,
				// 		ansQ32: ansQ32,
				// 		ansQ41: ansQ41,
				// 		ansQ42: ansQ42,
				// 		ansQ51: ansQ51,
				// 		ansQ52: ansQ52
				// 	},
				// 	cache: false,
				// 	success: function(data) {
				// 		$("#dataActSubmited").html(data);


				// 	}
				// });
				//event.preventDefault();



			});
			//-----------get activity detail --------------------------------------
			$(window).on('load', function() {
				var actDetail = 1;
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var actDetailcss = '';
				var mag_id = <?php echo $_REQUEST['magID']; ?>;

				$.ajax({
					type: 'POST',
					url: 'data/getActivityadmin.php',
					data: {
						actDetail: actDetail,
						act_id: act_id,
						actDetailcss: actDetailcss,
						mag_id: mag_id,
						art_id: art_id
					},
					cache: false,
					success: function(data) {
						// remove Scrambled: all instances from data
						data = data.replace(/Scrambled:/g, '');
						var data1 = `<form>` + data + `</form>`;
						$("#container-wrap").html(data);

					}
				})

				var actDetail = '';
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var actDetailcss = 1;
				var mag_id = <?php echo $_REQUEST['magID']; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/getActivityadmin.php',
					data: {
						actDetail: actDetail,
						act_id: act_id,
						actDetailcss: actDetailcss,
						mag_id: mag_id,
						art_id: art_id
					},
					cache: false,
					success: function(data) {
						$("#dataActivitycss").html(data);

					}
				});


				var actDetail = '';
				var actDetailcss = '';
				$.ajax({
					type: 'POST',
					url: 'data/getActivityadmin.php',
					data: {
						getdetails: '1',
						actDetail: actDetail,
						act_id: act_id,
						actDetailcss: actDetailcss,
						mag_id: mag_id,
						art_id: art_id
					},
					cache: false,
					success: function(data) {
						//$("#dataActivitycss").html(data);
						// fetch data as JSON
						var data = JSON.parse(data);
						//console.log(data);
						console.log(data.activity_content);
						console.log(data.activity_html);
						console.log(data.activity_type_id);
						// set data to the input with id activity_type_id
						$("#activity_type_id").val(data.activity_type_id);
						console.log(data.activity_result);
						// set data to the input with id activity_result
						$("#activity_result").val(data.activity_result);
					}
				})
			});

			//-------------------sticky notes annotations-------------------------
			var varColor;
			$('#colorbackgray').on('click', function() {
				varColor = '#afbccf';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#afbccf',
				});
				$('#anno_sticky').css({
					'background-color': '#afbccf',
				});
				stickyNotessave(varColor);
			});
			$('#modalcClose').on('click', function() {
				$('#colorbackgray').modal('hide');
			});
			$('#colorbackred').on('click', function() {
				varColor = '#ffafa4';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#ffafa4',
				});
				$('#anno_sticky').css({
					'background-color': '#ffafa4',
				});
				stickyNotessave(varColor);
			});
			$('#colorbacklblue').on('click', function() {
				varColor = '#81caff';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#81caff',
				});
				$('#anno_sticky').css({
					'background-color': '#81caff',
				});
				stickyNotessave(varColor);
			});
			$('#colorbackorange').on('click', function() {
				varColor = '#fec470';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#fec470',
				});
				$('#anno_sticky').css({
					'background-color': '#fec470',
				});
				stickyNotessave(varColor);
			});
			$('#colorbackpink').on('click', function() {
				varColor = '#ffbdf2';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#ffbdf2',
				});
				$('#anno_sticky').css({
					'background-color': '#ffbdf2',
				});
				stickyNotessave(varColor);
			});
			$('#colorbacklightgray').on('click', function() {
				varColor = '#e6e6e6';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#e6e6e6',
				});
				$('#anno_sticky').css({
					'background-color': '#e6e6e6',
				});
				stickyNotessave(varColor);
			});
			$('#colorbacklightblue').on('click', function() {
				varColor = '#75d7f0';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#75d7f0',
				});
				$('#anno_sticky').css({
					'background-color': '#75d7f0',
				});
				stickyNotessave(varColor);
			});
			$('#colorbackyellow').on('click', function() {
				varColor = '#ffd866';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#ffd866',
				});
				$('#anno_sticky').css({
					'background-color': '#ffd866',
				});
				stickyNotessave(varColor);
			});
			$('#colorbackpurple').on('click', function() {
				varColor = '#d9b8ff';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#d9b8ff',
				});
				$('#anno_sticky').css({
					'background-color': '#d9b8ff',
				});
				stickyNotessave(varColor);
			});
			$('#colorbackgreen').on('click', function() {
				varColor = '#86e0a3';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#86e0a3',
				});
				$('#anno_sticky').css({
					'background-color': '#86e0a3',
				});
				stickyNotessave(varColor);
			});
			$('#modalPop').on('click', function() {
				$('#myModal').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#myModaltooltip').modal('hide');

			});

			function displayStickynotes() {
				var annoColor = '';
				var anno_sticky = '';
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var sticky_id = '';
				var sticky_id_view = '';
				var mag_id = <?php echo $_REQUEST['magID']; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/saveAnnotationsticky.php',
					data: {
						anno_sticky: anno_sticky,
						art_id: art_id,
						act_id: act_id,
						sticky_id: sticky_id,
						sticky_id_view: sticky_id_view,
						annoColor: annoColor,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {

						$("#dataStickyview").html(data);


					}
				});
				event.preventDefault();
			}

			$('#saveAnnotationsticky').on('click', function() {
				var annoColor = varColor;
				var anno_sticky = $("#anno_sticky").val();
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var sticky_id = '';
				var sticky_id_view = '';
				var mag_id = <?php echo $_REQUEST['magID']; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/saveAnnotationsticky.php',
					data: {
						anno_sticky: anno_sticky,
						art_id: art_id,
						act_id: act_id,
						sticky_id: sticky_id,
						sticky_id_view: sticky_id_view,
						annoColor: annoColor,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						$('#successAll').modal({
							backdrop: 'static',
							keyboard: true,
							show: true
						});
						setTimeout(function() {
							$('#successAll').modal('hide');
						}, 2000);
						$('#anno_sticky').val('');
						// window.location='article-detail.php?artID=<?php #echo $_REQUEST['artID'];
																		?>';
						//$("#dataStickyview").html(data); 
						$('#myModalcolor').modal('hide');
						displayStickynotes();

					}
				});
				event.preventDefault();
			});

			$(window).on('load', function() {

				displayStickynotes();
			});

			$(document).on("click", "#stickyDel", function(e) { // onclic function
				e.preventDefault();
				var annoColor = '';
				var anno_sticky = '';
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var sticky_id = $(this).data('id');
				var sticky_id_view = '';
				var mag_id = '';
				var result = confirm("Are you sure you want to delete the Sticky Note?");
				if (result) {
					$.ajax({
						type: 'POST',
						url: 'data/saveAnnotationsticky.php',
						data: {
							anno_sticky: anno_sticky,
							art_id: art_id,
							act_id: act_id,
							sticky_id: sticky_id,
							sticky_id_view: sticky_id_view,
							annoColor: annoColor
						},
						cache: false,
						success: function(data) {
							//alert('Sticky Note deleted successfully');
							$('#successAll').modal({
								backdrop: 'static',
								keyboard: true,
								show: true
							});
							setTimeout(function() {
								$('#successAll').modal('hide');
							}, 2000);
							displayStickynotes();

						}
					});
				}
			});

			$('#closeModalpop').on('click', function() {
				$('#myModal').modal('hide');
			});

			//---------------comments Annotations-------------------------
			function displayComment() {
				var anno_comments = '';
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var com_id = '';
				var com_id_view = '';
				var highlightText = '';
				var windowsize = $(window).width();
				var mag_id = <?php echo $_REQUEST['magID']; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/saveAnnotationcomments.php',
					data: {
						anno_comments: anno_comments,
						art_id: art_id,
						act_id: act_id,
						com_id: com_id,
						com_id_view: com_id_view,
						selText: selText,
						highlightText: highlightText,
						mag_id: mag_id,
						windowsize: windowsize
					},
					cache: false,
					success: function(data) {
						$("#dataComments").html(data);


					}
				})
			}

			function highlightCommentviewfunc() {

				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				// var selText ='';
				var highlightCommenttext = 1;
				var mag_id = <?php echo $_REQUEST['magID']; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/viewHighlightannotations.php',
					data: {
						highlightCommenttext: highlightCommenttext,
						art_id: art_id,
						act_id: act_id,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						var valNew = data.split('***');

						for (i = 0; i < valNew.length; i++) {
							highlight(valNew[i].trimStart());
						}


						//highlight2(data.trimStart());

					}
				});
			}

			$(document).on("click", "#modalPopviewcomment", function() {
				$('#myModalviewcomment').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				var anno_comments = '';
				var art_id = '';
				var act_id = '';
				var com_id = '';
				var highlightText = '';
				var mag_id = '';
				var com_id_view = $(this).data('id');
				$.ajax({
					type: 'POST',
					url: 'data/saveAnnotationcomments.php',
					data: {
						anno_comments: anno_comments,
						art_id: art_id,
						act_id: act_id,
						com_id: com_id,
						com_id_view: com_id_view,
						selText: selText,
						highlightText: highlightText,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						var ret = data.replace('</div>', '');
						$("#dataCommentsview").html(ret);

					}
				});


			});
			$('#closeModalpop2').on('click', function() {
				$('#myModalviewcomment').modal('hide');

			});

			$(document).on("click", "#modalPopviewcomment", function() {

				var anno_comments = '';
				var art_id = '';
				var act_id = '';
				var com_id = '';
				var com_id_view = $(this).data('id');
				var highlightText = 1;
				var mag_id = '';
				$.ajax({
					type: 'POST',
					url: 'data/saveAnnotationcomments.php',
					data: {
						anno_comments: anno_comments,
						art_id: art_id,
						act_id: act_id,
						com_id: com_id,
						com_id_view: com_id_view,
						selText: selText,
						highlightText: highlightText,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						$('#spanHigh3').removeClass('highlight3').addClass('diselect');
						$("#spanHigh3").attr("id", "newId");
						highlight3(data.trimStart());
					}
				});


			});
			$(window).on('load', function() {
				highlightCommentviewfunc();
				displayComment();
			});
			$('#saveAnnotationcomments').on('click', function() {
				var anno_comments = $("#anno_comments").val();

				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var com_id = '';
				var com_id_view = '';
				var highlightText = '';
				var mag_id = <?php echo $_REQUEST['magID']; ?>;
				if (anno_comments == "") {
					$("#anno_comments-info").html("Please enter the comment.");
					$("#anno_comments").addClass("input-error");
					return false;
				} else {
					$.ajax({
						type: 'POST',
						url: 'data/saveAnnotationcomments.php',
						data: {
							anno_comments: anno_comments,
							art_id: art_id,
							act_id: act_id,
							com_id: com_id,
							com_id_view: com_id_view,
							selText: selText,
							highlightText: highlightText,
							mag_id: mag_id,
							top: $('#topPosition').val()
						},
						cache: false,
						success: function(data) {
							$('#successAll').modal({
								backdrop: 'static',
								keyboard: true,
								show: true
							});
							setTimeout(function() {
								$('#successAll').modal('hide');
							}, 2000);
							$('#anno_comments').val('');
							$('#myModal').modal('hide');
							window.location = 'activity-detail-admin.php?artID=<?php echo $_REQUEST['artID']; ?>&actID=<?php echo $_REQUEST['actID']; ?>&magID=<?php echo $_REQUEST['magID']; ?>';
							displayComment();

						}
					});
					event.preventDefault();
				}
			});

			$(document).on("click", "#comDel", function(e) { // onclic function
				e.preventDefault();
				var anno_comments = '';
				var art_id = '';
				var act_id = '';
				var com_id = $(this).data('id');
				var com_id_view = '';
				var highlightText = '';
				var mag_id = '';
				var result = confirm("Are you sure you want to delete the comment?");
				if (result) {
					$.ajax({
						type: 'POST',
						url: 'data/saveAnnotationcomments.php',
						data: {
							anno_comments: anno_comments,
							art_id: art_id,
							act_id: act_id,
							com_id: com_id,
							com_id_view: com_id_view,
							selText: selText,
							highlightText: highlightText,
							mag_id: mag_id
						},
						cache: false,
						success: function(data) {
							$('#successAll').modal({
								backdrop: 'static',
								keyboard: true,
								show: true
							});
							setTimeout(function() {
								$('#successAll').modal('hide');
							}, 2000);
							window.location = 'activity-detail-admin.php?artID=<?php echo $_REQUEST['artID']; ?>&actID=<?php echo $_REQUEST['actID']; ?>&magID=<?php echo $_REQUEST['magID']; ?>';
							displayComment();

						}
					});
				}
			});

			//--------------------------------------book marks------------------------------------------------

			$('#openModalpop').on('click', function() {
				$('#myModalBK').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
			});



			$(window).on('load', function() { // onload jQuery Ajax Calls in PHP Script
				var bookMark = 1;
				var annoColor = '';
				var book_mark_type = '';
				var art_id = 0;
				var act_id = 0;
				var bmFolder = 0;
				var idColorbookmark = '';
				var magazineID = <?php echo $_REQUEST['magID']; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/bookMarkannotations.php',
					data: {
						book_mark_type: book_mark_type,
						bookMark: bookMark,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						bmFolder: bmFolder,
						idColorbookmark: idColorbookmark,
						magazineID: magazineID
					},
					cache: false,
					success: function(data) {
						$("#dataBookmarktype").html(data);

					}
				})

			});

			var varColor1;

			$('#colorbackgray1').on('click', function() {
				varColor1 = '#afbccf';
				$("#colorbackgreen1").removeClass("addbuttonborder");
				$("#colorbackpurple1").removeClass("addbuttonborder");
				$("#colorbackyellow1").removeClass("addbuttonborder");
				$("#colorbacklightblue1").removeClass("addbuttonborder");
				$("#colorbacklightgray1").removeClass("addbuttonborder");
				$("#colorbackpink1").removeClass("addbuttonborder");
				$("#colorbackorange1").removeClass("addbuttonborder");
				$("#colorbacklblue1").removeClass("addbuttonborder");
				$("#colorbackred1").removeClass("addbuttonborder");
				$("#colorbackgray1").addClass("addbuttonborder");
			});
			$('#colorbackred1').on('click', function() {
				varColor1 = '#ffafa4';
				$("#colorbackgreen1").removeClass("addbuttonborder");
				$("#colorbackpurple1").removeClass("addbuttonborder");
				$("#colorbackyellow1").removeClass("addbuttonborder");
				$("#colorbacklightblue1").removeClass("addbuttonborder");
				$("#colorbacklightgray1").removeClass("addbuttonborder");
				$("#colorbackpink1").removeClass("addbuttonborder");
				$("#colorbackorange1").removeClass("addbuttonborder");
				$("#colorbacklblue1").removeClass("addbuttonborder");
				$("#colorbackred1").addClass("addbuttonborder");
				$("#colorbackgray1").removeClass("addbuttonborder");
			});
			$('#colorbacklblue1').on('click', function() {
				varColor1 = '#81caff';
				$("#colorbackgreen1").removeClass("addbuttonborder");
				$("#colorbackpurple1").removeClass("addbuttonborder");
				$("#colorbackyellow1").removeClass("addbuttonborder");
				$("#colorbacklightblue1").removeClass("addbuttonborder");
				$("#colorbacklightgray1").removeClass("addbuttonborder");
				$("#colorbackpink1").removeClass("addbuttonborder");
				$("#colorbackorange1").removeClass("addbuttonborder");
				$("#colorbacklblue1").addClass("addbuttonborder");
				$("#colorbackred1").removeClass("addbuttonborder");
				$("#colorbackgray1").removeClass("addbuttonborder");
			});
			$('#colorbackorange1').on('click', function() {
				varColor1 = '#fec470';
				$("#colorbackgreen1").removeClass("addbuttonborder");
				$("#colorbackpurple1").removeClass("addbuttonborder");
				$("#colorbackyellow1").removeClass("addbuttonborder");
				$("#colorbacklightblue1").removeClass("addbuttonborder");
				$("#colorbacklightgray1").removeClass("addbuttonborder");
				$("#colorbackpink1").removeClass("addbuttonborder");
				$("#colorbackorange1").addClass("addbuttonborder");
				$("#colorbacklblue1").removeClass("addbuttonborder");
				$("#colorbackred1").removeClass("addbuttonborder");
				$("#colorbackgray1").removeClass("addbuttonborder");
			});
			$('#colorbackpink1').on('click', function() {
				varColor1 = '#ffbdf2';
				$("#colorbackgreen1").removeClass("addbuttonborder");
				$("#colorbackpurple1").removeClass("addbuttonborder");
				$("#colorbackyellow1").removeClass("addbuttonborder");
				$("#colorbacklightblue1").removeClass("addbuttonborder");
				$("#colorbacklightgray1").removeClass("addbuttonborder");
				$("#colorbackpink1").addClass("addbuttonborder");
				$("#colorbackorange1").removeClass("addbuttonborder");
				$("#colorbacklblue1").removeClass("addbuttonborder");
				$("#colorbackred1").removeClass("addbuttonborder");
				$("#colorbackgray1").removeClass("addbuttonborder");
			});
			$('#colorbacklightgray1').on('click', function() {
				varColor1 = '#e6e6e6';
				$("#colorbackgreen1").removeClass("addbuttonborder");
				$("#colorbackpurple1").removeClass("addbuttonborder");
				$("#colorbackyellow1").removeClass("addbuttonborder");
				$("#colorbacklightblue1").removeClass("addbuttonborder");
				$("#colorbacklightgray1").addClass("addbuttonborder");
				$("#colorbackpink1").removeClass("addbuttonborder");
				$("#colorbackorange1").removeClass("addbuttonborder");
				$("#colorbacklblue1").removeClass("addbuttonborder");
				$("#colorbackred1").removeClass("addbuttonborder");
				$("#colorbackgray1").removeClass("addbuttonborder");
			});
			$('#colorbacklightblue1').on('click', function() {
				varColor1 = '#75d7f0';
				$("#colorbackgreen1").removeClass("addbuttonborder");
				$("#colorbackpurple1").removeClass("addbuttonborder");
				$("#colorbackyellow1").removeClass("addbuttonborder");
				$("#colorbacklightblue1").addClass("addbuttonborder");
				$("#colorbacklightgray1").removeClass("addbuttonborder");
				$("#colorbackpink1").removeClass("addbuttonborder");
				$("#colorbackorange1").removeClass("addbuttonborder");
				$("#colorbacklblue1").removeClass("addbuttonborder");
				$("#colorbackred1").removeClass("addbuttonborder");
				$("#colorbackgray1").removeClass("addbuttonborder");
			});
			$('#colorbackyellow1').on('click', function() {
				varColor1 = '#ffd866';
				$("#colorbackgreen1").removeClass("addbuttonborder");
				$("#colorbackpurple1").removeClass("addbuttonborder");
				$("#colorbackyellow1").addClass("addbuttonborder");
				$("#colorbacklightblue1").removeClass("addbuttonborder");
				$("#colorbacklightgray1").removeClass("addbuttonborder");
				$("#colorbackpink1").removeClass("addbuttonborder");
				$("#colorbackorange1").removeClass("addbuttonborder");
				$("#colorbacklblue1").removeClass("addbuttonborder");
				$("#colorbackred1").removeClass("addbuttonborder");
				$("#colorbackgray1").removeClass("addbuttonborder");
			});
			$('#colorbackpurple1').on('click', function() {
				varColor1 = '#d9b8ff';
				$("#colorbackgreen1").removeClass("addbuttonborder");
				$("#colorbackpurple1").addClass("addbuttonborder");
				$("#colorbackyellow1").removeClass("addbuttonborder");
				$("#colorbacklightblue1").removeClass("addbuttonborder");
				$("#colorbacklightgray1").removeClass("addbuttonborder");
				$("#colorbackpink1").removeClass("addbuttonborder");
				$("#colorbackorange1").removeClass("addbuttonborder");
				$("#colorbacklblue1").removeClass("addbuttonborder");
				$("#colorbackred1").removeClass("addbuttonborder");
				$("#colorbackgray1").removeClass("addbuttonborder");
			});
			$('#colorbackgreen1').on('click', function() {
				varColor1 = '#86e0a3';
				$("#colorbackgreen1").addClass("addbuttonborder");
				$("#colorbackpurple1").removeClass("addbuttonborder");
				$("#colorbackyellow1").removeClass("addbuttonborder");
				$("#colorbacklightblue1").removeClass("addbuttonborder");
				$("#colorbacklightgray1").removeClass("addbuttonborder");
				$("#colorbackpink1").removeClass("addbuttonborder");
				$("#colorbackorange1").removeClass("addbuttonborder");
				$("#colorbacklblue1").removeClass("addbuttonborder");
				$("#colorbackred1").removeClass("addbuttonborder");
				$("#colorbackgray1").removeClass("addbuttonborder");
			});


			$('#saveFolder').on('click', function() { // onclic function
				var annoColor = varColor1;
				var book_mark_type = $("#bookMarktype").val();
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var bmFolder = 0;
				var bookMark = '';
				var idColorbookmark = '';
				var magazineID = <?php echo $_REQUEST['magID']; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/bookMarkannotations.php',
					data: {
						book_mark_type: book_mark_type,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						bmFolder: bmFolder,
						bookMark: bookMark,
						idColorbookmark: idColorbookmark,
						magazineID: magazineID
					},
					cache: false,
					success: function(data) {
						$('#myModalBK').modal('hide');
						// alert('Bookmark added to the New Folder successfully');
						// window.location='article-detail.php?artID=<?php echo $_REQUEST['artID']; ?>&magID=<?php echo $_REQUEST['magID']; ?>';
						$("#dataBookmarkfolderexists").html(data);
					}
				});
				event.preventDefault();

			});

			$('#modalPop3').on('click', function() { // onload jQuery Ajax Calls in PHP Script
				var bookMark = '';
				var annoColor = '';
				var book_mark_type = '';
				var art_id = 0;
				var act_id = 0;
				var bmFolder = 1;
				var idColorbookmark = '';
				var magazineID = <?php echo $_REQUEST['magID']; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/bookMarkannotations.php',
					data: {
						book_mark_type: book_mark_type,
						bookMark: bookMark,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						bmFolder: bmFolder,
						idColorbookmark: idColorbookmark,
						magazineID: magazineID
					},
					cache: false,
					success: function(data) {
						$("#dataBookmarkfolder").html(data);

					}
				});

			});

			$(document).on("click", "#saveTofolder", function(e) { // onclic function
				e.preventDefault();
				var bookMark = '';
				var annoColor = '';
				var book_mark_type = '';
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var bmFolder = '';
				var idColorbookmark = $(this).data('id');
				var magazineID = <?php echo $_REQUEST['magID']; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/bookMarkannotations.php',
					data: {
						book_mark_type: book_mark_type,
						bookMark: bookMark,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						bmFolder: bmFolder,
						idColorbookmark: idColorbookmark,
						magazineID: magazineID
					},
					cache: false,
					success: function(data) {
						$('#successAll').modal({
							backdrop: 'static',
							keyboard: true,
							show: true
						});
						setTimeout(function() {
							$('#successAll').modal('hide');
						}, 2000);
						setTimeout(function() {
							window.location = 'activity-detail-admin.php?artID=<?php echo $_REQUEST['artID']; ?>&actID=<?php echo $_REQUEST['actID']; ?>&magID=<?php echo $_REQUEST['magID']; ?>';
						}, 2000);


					}
				});

			});
			//--------------------------------------word bank------------------------------------------------
			$('#openModalpopWB').on('click', function() {
				$('#myModalWB').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
			});
			$(window).on('load', function() {
				<?php if (isset($_REQUEST['idColorwordbank11']) && $_REQUEST['idColorwordbank11'] != "") { ?>
					$('#myModalsaveexistWB').modal({
						backdrop: 'static',
						keyboard: true,
						show: true
					});
					var idColorwordbank11 = '<?php echo $_REQUEST['idColorwordbank11']; ?>';


					$('#saveexistWBFolder').on('click', function() {

						saveexistingFolder(idColorwordbank11);

					});

				<?php } ?>
			});
			$(window).on('load', function() { // onload jQuery Ajax Calls in PHP Script
				var wordBank = 1;
				var annoColor = '';
				var word_bank_type = '';
				var art_id = 0;
				var act_id = 0;
				var wbFolder = 0;
				var idColorwordbank = '';
				var magazineID = <?php echo $_REQUEST['magID']; ?>;
				var definition = '';
				var pageT = '';
				$.ajax({
					type: 'POST',
					url: 'data/addWordbank.php',
					data: {
						word_bank_type: word_bank_type,
						wordBank: wordBank,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						wbFolder: wbFolder,
						idColorwordbank: idColorwordbank,
						magazineID: magazineID,
						selText: selText,
						definition: definition,
						pageT: pageT
					},
					cache: false,
					success: function(data) {
						$("#dataWordbanktype").html(data);

					}
				})

			});

			var varColor2;

			$('#colorbackgray2').on('click', function() {
				varColor2 = '#afbccf';
				$("#colorbackgreen2").removeClass("addbuttonborder");
				$("#colorbackpurple2").removeClass("addbuttonborder");
				$("#colorbackyellow2").removeClass("addbuttonborder");
				$("#colorbacklightblue2").removeClass("addbuttonborder");
				$("#colorbacklightgray2").removeClass("addbuttonborder");
				$("#colorbackpink2").removeClass("addbuttonborder");
				$("#colorbackorange2").removeClass("addbuttonborder");
				$("#colorbacklblue2").removeClass("addbuttonborder");
				$("#colorbackred2").removeClass("addbuttonborder");
				$("#colorbackgray2").addClass("addbuttonborder");
			});
			$('#colorbackred2').on('click', function() {
				varColor2 = '#ffafa4';
				$("#colorbackgreen2").removeClass("addbuttonborder");
				$("#colorbackpurple2").removeClass("addbuttonborder");
				$("#colorbackyellow2").removeClass("addbuttonborder");
				$("#colorbacklightblue2").removeClass("addbuttonborder");
				$("#colorbacklightgray2").removeClass("addbuttonborder");
				$("#colorbackpink2").removeClass("addbuttonborder");
				$("#colorbackorange2").removeClass("addbuttonborder");
				$("#colorbacklblue2").removeClass("addbuttonborder");
				$("#colorbackred2").addClass("addbuttonborder");
				$("#colorbackgray2").removeClass("addbuttonborder");
			});
			$('#colorbacklblue2').on('click', function() {
				varColor2 = '#81caff';
				$("#colorbackgreen2").removeClass("addbuttonborder");
				$("#colorbackpurple2").removeClass("addbuttonborder");
				$("#colorbackyellow2").removeClass("addbuttonborder");
				$("#colorbacklightblue2").removeClass("addbuttonborder");
				$("#colorbacklightgray2").removeClass("addbuttonborder");
				$("#colorbackpink2").removeClass("addbuttonborder");
				$("#colorbackorange2").removeClass("addbuttonborder");
				$("#colorbacklblue2").addClass("addbuttonborder");
				$("#colorbackred2").removeClass("addbuttonborder");
				$("#colorbackgray2").removeClass("addbuttonborder");
			});
			$('#colorbackorange2').on('click', function() {
				varColor2 = '#fec470';
				$("#colorbackgreen2").removeClass("addbuttonborder");
				$("#colorbackpurple2").removeClass("addbuttonborder");
				$("#colorbackyellow2").removeClass("addbuttonborder");
				$("#colorbacklightblue2").removeClass("addbuttonborder");
				$("#colorbacklightgray2").removeClass("addbuttonborder");
				$("#colorbackpink2").removeClass("addbuttonborder");
				$("#colorbackorange2").addClass("addbuttonborder");
				$("#colorbacklblue2").removeClass("addbuttonborder");
				$("#colorbackred2").removeClass("addbuttonborder");
				$("#colorbackgray2").removeClass("addbuttonborder");
			});
			$('#colorbackpink2').on('click', function() {
				varColor2 = '#ffbdf2';
				$("#colorbackgreen2").removeClass("addbuttonborder");
				$("#colorbackpurple2").removeClass("addbuttonborder");
				$("#colorbackyellow2").removeClass("addbuttonborder");
				$("#colorbacklightblue2").removeClass("addbuttonborder");
				$("#colorbacklightgray2").removeClass("addbuttonborder");
				$("#colorbackpink2").addClass("addbuttonborder");
				$("#colorbackorange2").removeClass("addbuttonborder");
				$("#colorbacklblue2").removeClass("addbuttonborder");
				$("#colorbackred2").removeClass("addbuttonborder");
				$("#colorbackgray2").removeClass("addbuttonborder");
			});
			$('#colorbacklightgray2').on('click', function() {
				varColor2 = '#e6e6e6';
				$("#colorbackgreen2").removeClass("addbuttonborder");
				$("#colorbackpurple2").removeClass("addbuttonborder");
				$("#colorbackyellow2").removeClass("addbuttonborder");
				$("#colorbacklightblue2").removeClass("addbuttonborder");
				$("#colorbacklightgray2").addClass("addbuttonborder");
				$("#colorbackpink2").removeClass("addbuttonborder");
				$("#colorbackorange2").removeClass("addbuttonborder");
				$("#colorbacklblue2").removeClass("addbuttonborder");
				$("#colorbackred2").removeClass("addbuttonborder");
				$("#colorbackgray2").removeClass("addbuttonborder");
			});
			$('#colorbacklightblue2').on('click', function() {
				varColor2 = '#75d7f0';
				$("#colorbackgreen2").removeClass("addbuttonborder");
				$("#colorbackpurple2").removeClass("addbuttonborder");
				$("#colorbackyellow2").removeClass("addbuttonborder");
				$("#colorbacklightblue2").addClass("addbuttonborder");
				$("#colorbacklightgray2").removeClass("addbuttonborder");
				$("#colorbackpink2").removeClass("addbuttonborder");
				$("#colorbackorange2").removeClass("addbuttonborder");
				$("#colorbacklblue2").removeClass("addbuttonborder");
				$("#colorbackred2").removeClass("addbuttonborder");
				$("#colorbackgray2").removeClass("addbuttonborder");
			});
			$('#colorbackyellow2').on('click', function() {
				varColor2 = '#ffd866';
				$("#colorbackgreen2").removeClass("addbuttonborder");
				$("#colorbackpurple2").removeClass("addbuttonborder");
				$("#colorbackyellow2").addClass("addbuttonborder");
				$("#colorbacklightblue2").removeClass("addbuttonborder");
				$("#colorbacklightgray2").removeClass("addbuttonborder");
				$("#colorbackpink2").removeClass("addbuttonborder");
				$("#colorbackorange2").removeClass("addbuttonborder");
				$("#colorbacklblue2").removeClass("addbuttonborder");
				$("#colorbackred2").removeClass("addbuttonborder");
				$("#colorbackgray2").removeClass("addbuttonborder");
			});
			$('#colorbackpurple2').on('click', function() {
				varColor2 = '#d9b8ff';
				$("#colorbackgreen2").removeClass("addbuttonborder");
				$("#colorbackpurple2").addClass("addbuttonborder");
				$("#colorbackyellow2").removeClass("addbuttonborder");
				$("#colorbacklightblue2").removeClass("addbuttonborder");
				$("#colorbacklightgray2").removeClass("addbuttonborder");
				$("#colorbackpink2").removeClass("addbuttonborder");
				$("#colorbackorange2").removeClass("addbuttonborder");
				$("#colorbacklblue2").removeClass("addbuttonborder");
				$("#colorbackred2").removeClass("addbuttonborder");
				$("#colorbackgray2").removeClass("addbuttonborder");
			});
			$('#colorbackgreen2').on('click', function() {
				varColor2 = '#86e0a3';
				$("#colorbackgreen2").addClass("addbuttonborder");
				$("#colorbackpurple2").removeClass("addbuttonborder");
				$("#colorbackyellow2").removeClass("addbuttonborder");
				$("#colorbacklightblue2").removeClass("addbuttonborder");
				$("#colorbacklightgray2").removeClass("addbuttonborder");
				$("#colorbackpink2").removeClass("addbuttonborder");
				$("#colorbackorange2").removeClass("addbuttonborder");
				$("#colorbacklblue2").removeClass("addbuttonborder");
				$("#colorbackred2").removeClass("addbuttonborder");
				$("#colorbackgray2").removeClass("addbuttonborder");
			});

			$('#saveWBFolder').on('click', function() { // onclic function
				var annoColor = varColor2;
				var word_bank_type = $("#wordBanktype").val();
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var wbFolder = 0;
				var wordBank = '';
				var idColorwordbank = '';
				var magazineID = <?php echo $_REQUEST['magID']; ?>;
				var definition = '';
				var pageT = 'act';
				$.ajax({
					type: 'POST',
					url: 'data/addWordbank.php',
					data: {
						word_bank_type: word_bank_type,
						wordBank: wordBank,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						wbFolder: wbFolder,
						idColorwordbank: idColorwordbank,
						magazineID: magazineID,
						selText: selText,
						definition: definition,
						pageT: pageT
					},
					cache: false,
					success: function(data) {
						$('#myModalWB').modal('hide');
						// alert('Bookmark added to the New Folder successfully');
						// window.location='article-detail.php?artID=<?php echo $_REQUEST['artID']; ?>&magID=<?php echo $_REQUEST['magID']; ?>';
						$("#dataWordbankfolderexists").html(data);
					}
				});
				event.preventDefault();

			});

			$('#modalPop4').on('click', function() { // onload jQuery Ajax Calls in PHP Script
				var wordBank = '';
				var annoColor = '';
				var word_bank_type = '';
				var art_id = 0;
				var act_id = 0;
				var wbFolder = 1;
				var idColorwordbank = '';
				var magazineID = <?php echo $_REQUEST['magID']; ?>;
				var definition = '';
				var pageT = '';
				$.ajax({
					type: 'POST',
					url: 'data/addWordbank.php',
					data: {
						word_bank_type: word_bank_type,
						wordBank: wordBank,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						wbFolder: wbFolder,
						idColorwordbank: idColorwordbank,
						magazineID: magazineID,
						selText: selText,
						definition: definition,
						pageT: pageT
					},
					cache: false,
					success: function(data) {
						$("#dataWordbankfolder").html(data);

					}
				});

			});

			$(document).on("click", "#saveTowbfolder", function(e) { // onclic function 

				$('#myModalsaveexistWB').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				var idColorwordbank11 = $(this).data('id');


				$('#saveexistWBFolder').on('click', function() {

					saveexistingFolder(idColorwordbank11);

				});

			});

			function saveexistingFolder(idColorwordbank11) {
				var wordBank = '';
				var annoColor = '';
				var word_bank_type = '';
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var wbFolder = '';
				var idColorwordbank = idColorwordbank11;
				var magazineID = <?php echo $_REQUEST['magID']; ?>;
				var definition = $("#definition2").val();
				var pageT = '';
				<?php if (isset($_REQUEST['selectedText']) && $_REQUEST['selectedText'] != "") { ?>
					var selText = '<?php echo $_REQUEST['selectedText']; ?>';
				<?php } ?>
				$.ajax({
					type: 'POST',
					url: 'data/addWordbank.php',
					data: {
						word_bank_type: word_bank_type,
						wordBank: wordBank,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						wbFolder: wbFolder,
						idColorwordbank: idColorwordbank,
						magazineID: magazineID,
						selText: selText,
						definition: definition,
						pageT: pageT
					},
					cache: false,
					success: function(data) {
						$('#successAll').modal({
							backdrop: 'static',
							keyboard: true,
							show: true
						});
						setTimeout(function() {
							$('#successAll').modal('hide');
						}, 2000);
						setTimeout(function() {
							window.location = 'activity-detail-admin.php?artID=<?php echo $_REQUEST['artID']; ?>&actID=<?php echo $_REQUEST['actID']; ?>&magID=<?php echo $_REQUEST['magID']; ?>';
						}, 2000);


					}
				});
				event.preventDefault();
			}
			// $(document).on("click", "#saveexistWBFolder", function(e){ // onclic function	 

			//------------------------highlight text ------------------------------------------------------
			function highlightTextviewfunc() {
				var textHighlight = '';
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				// var selText ='';
				var highlightTextview = 1;
				var mag_id = <?php echo $_REQUEST['magID']; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/textHighlightannotations.php',
					data: {
						selText: selText,
						textHighlight: textHighlight,
						art_id: art_id,
						act_id: act_id,
						highlightTextview: highlightTextview,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						var valNew = data.split('***');
						var alternateTitle = valNew.filter(function(val, idx) {
							if (idx % 2 == 0)
								return val;
						});
						var alternateColor = valNew.filter(function(val, idx) {
							if (idx % 2 == 1)
								return val;
						});
						for (i = 0; i < alternateTitle.length; i++) { //alert(valNew[i])
							/* if(valNew[i].charAt(0)!='#'){ 
							  a1.push(valNew[i]); 
							  a1[i] = valNew[i]; 
							}else {
							   a2.push(valNew[i]);
							   a2[i] = valNew[i]; 
							}*/


							highlight2(alternateTitle[i], alternateColor[i]);
						}



						//highlight2(data.trimStart());

					}
				});
			}
			$(window).on('load', function() { // onclic function

				highlightTextviewfunc();

			});

			function highlightColorbutton(clr) {
				var textHighlight = 1;
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var act_id = <?php echo $_REQUEST['actID']; ?>;
				var highlightTextview = '';
				var mag_id = <?php echo $_REQUEST['magID']; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/textHighlightannotations.php',
					data: {
						selText: selText,
						textHighlight: textHighlight,
						art_id: art_id,
						act_id: act_id,
						highlightTextview: highlightTextview,
						mag_id: mag_id,
						clr: clr
					},
					cache: false,
					success: function(data) {
						//alert('Bookmark added to the New Folder successfully');
						$('#myModaltooltip').modal('hide');
						highlightTextviewfunc();
					}
				})
			}

			var varColorhlt;
			$('#colorbackgrayH1').on('click', function() {
				varColorhlt = '#afbccf';
				//$('#myModaltooltip').modal('hide'); 
				highlightColorbutton(varColorhlt);


			});
			$('#colorbackredH1').on('click', function() {
				varColorhlt = '#ffafa4';
				//$('#myModaltooltip').modal('hide');
				highlightColorbutton(varColorhlt)

			});
			$('#colorbacklblueH1').on('click', function() {
				varColorhlt = '#81caff';
				//$('#myModaltooltip').modal('hide');
				highlightColorbutton(varColorhlt)

			});
			$('#colorbackorangeH1').on('click', function() {
				varColorhlt = '#fec470';
				//$('#myModaltooltip').modal('hide');
				highlightColorbutton(varColorhlt)

			});
			$('#colorbackpinkH1').on('click', function() {
				varColorhlt = '#ffbdf2';
				//$('#myModaltooltip').modal('hide');
				highlightColorbutton(varColorhlt)

			});
			$('#colorbacklightgrayH1').on('click', function() {
				varColorhlt = '#e6e6e6';
				//$('#myModaltooltip').modal('hide');
				highlightColorbutton(varColorhlt)

			});
			$('#colorbacklightblueH1').on('click', function() {
				varColorhlt = '#75d7f0';
				//$('#myModaltooltip').modal('hide');
				highlightColorbutton(varColorhlt)

			});
			$('#colorbackyellowH1').on('click', function() {
				varColorhlt = '#ffd866';
				//$('#myModaltooltip').modal('hide');
				highlightColorbutton(varColorhlt)

			});
			$('#colorbackpurpleH1').on('click', function() {
				varColorhlt = '#d9b8ff';
				//$('#myModaltooltip').modal('hide');
				highlightColorbutton(varColorhlt)

			});
			$('#colorbackgreenH1').on('click', function() {
				varColorhlt = '#86e0a3';
				//$('#myModaltooltip').modal('hide');
				highlightColorbutton(varColorhlt)

			});



		});


		/* When the user clicks on the button, 
		toggle between hiding and showing the dropdown content */
		function myFunction() {
			document.getElementById("myDropdown").classList.toggle("show");
		}

		function myFunction2() {
			document.getElementById("myDropdown2").classList.toggle("show");
		}

		function myFunction3() {
			document.getElementById("myDropdown3").classList.toggle("show");
		}

		function myDropdownhifhlight() {
			document.getElementById("myDropdownhifhlight").classList.toggle("show");
		}

		// Close the dropdown if the user clicks outside of it
		window.onclick = function(event) {
			if (!event.target.matches('.dropbtn')) {
				var dropdowns = document.getElementsByClassName("dropdown-content");
				var i;
				for (i = 0; i < dropdowns.length; i++) {
					var openDropdown = dropdowns[i];
					if (openDropdown.classList.contains('show')) {
						openDropdown.classList.remove('show');
					}
				}
			}
		}

		var selText = "";

		function GetSelectedText() {
			// var selText = "";
			if (window.getSelection) { // all browsers, except IE before version 9
				if (document.activeElement &&
					(document.activeElement.tagName.toLowerCase() == "textarea" ||
						document.activeElement.tagName.toLowerCase() == "input")) {
					var text = document.activeElement.value;
					selText = text.substring(document.activeElement.selectionStart,
						document.activeElement.selectionEnd);
				} else {
					var selRange = window.getSelection();
					selText = selRange.toString();
				}
			} else {
				if (document.selection.createRange) { // Internet Explorer
					var range = document.selection.createRange();
					selText = range.text;
				}
			}
			var r = window.getSelection().getRangeAt(0).getBoundingClientRect();
			var relative = document.body.parentNode.getBoundingClientRect();
			var top = ((r.bottom - relative.top) - 60);
			$('#topPosition').val(top);
			if (selText !== "") {
				//$("#selectText").hide();
				// $("#modalPop").show();

				$('#myModaltooltip').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
			}

		}

		$(document).ready(function() {
			// $("#modalPop").hide();
			$('#selectText').click(function() {
				if (selText == "") {
					alert('Select Text to add comments');
				} else {
					// $("#selectText").hide();
				}
			});
			/* $(window).on('load', function() { alert('s')
			 $(window).scrollTop($("*:contains('Are you a Lib Dem or Tory'):last").offset().top);
			 });*/
		});

		function highlight(text1) {

			var pageContainer = document.getElementById("test123");
			var innerHTML = pageContainer.innerHTML;
			var index = innerHTML.indexOf(text1);

			if (index >= 0) {
				innerHTML = innerHTML.substring(0, index) + "<span class='highlight' id='spanHigh'>" + innerHTML.substring(index, index + text1.length) + "</span>" + innerHTML.substring(index + text1.length);
				pageContainer.innerHTML = innerHTML;
				// document.getElementById('spanHigh').scrollIntoView();
				/*setTimeout(function(){
    $('#spanHigh').removeClass('highlight');
},5000);*/
			}
		}

		function highlight3(text1) {

			var pageContainer = document.getElementById("test123");
			var innerHTML = pageContainer.innerHTML;
			var index = innerHTML.indexOf(text1);

			if (index >= 0) {
				innerHTML = innerHTML.substring(0, index) + "<span class='highlight3' id='spanHigh3'>" + innerHTML.substring(index, index + text1.length) + "</span>" + innerHTML.substring(index + text1.length);
				pageContainer.innerHTML = innerHTML;
				document.getElementById('spanHigh3').scrollIntoView();

			}
		}

		function highlight2(text1, text2) {

			var pageContainer = document.getElementById("test123");
			var innerHTML = pageContainer.innerHTML;
			var index = innerHTML.indexOf(text1);

			if (index >= 0) {
				innerHTML = innerHTML.substring(0, index) + "<span  id='spanHigh2' style='background-color:" + text2 + "'>" + innerHTML.substring(index, index + text1.length) + "</span>" + innerHTML.substring(index + text1.length);
				pageContainer.innerHTML = innerHTML;
				// document.getElementById('spanHigh').scrollIntoView();
				/*setTimeout(function(){
    $('#spanHigh').removeClass('highlight');
},5000);*/
			}
		}

		//------------------------toggle full width-----------------------------
		function myTogglewidthfunction() {
			var x = document.getElementById("mySidebar");;
			if (x.style.display === "none") {
				x.style.display = "block";
				x.style.width = "250px";
				document.getElementById("page-wrapper").style.marginLeft = "250px";
				var element = document.getElementById("test123");
				var elementSide = document.getElementById("rightsidebar");
				element.classList.remove("col-lg-12");
				element.classList.add("col-lg-9");
				elementSide.classList.add("col-lg-3");
				elementSide.style.display = "block";
				document.getElementById("rLoud").style.display = "block";

			} else {
				x.style.display = "none";
				x.style.width = "0";
				document.getElementById("page-wrapper").style.marginLeft = "0";
				var element = document.getElementById("test123");
				var elementSide = document.getElementById("rightsidebar");
				element.classList.add("col-lg-12");
				element.classList.remove("col-lg-9");
				elementSide.classList.remove("col-lg-3");
				elementSide.style.display = "none";
				document.getElementById("rLoud").style.display = "none";
			}
		}
		$(document).ready(function() {
		    $('#showArticle2').hide();
			$(document).on("click", "#showmenu", function(e) {
				// $('#showmenu').click(function() {
				$('.menuShow').slideToggle("fast");
			});
			
			//-----------get article detail --------------------------------------
			//$("#showArticle").on("click", function () { 
			$(document).on("click", "#showArticle", function() {
			     var $test = $('#container-wrap2');
				$test.show("slow");
								   
				
				 
				   var artDetail = 1;
					   var art_id = <?php echo $_REQUEST['artID'];?>; 
					   var artDetailcss ='';
					   var mag_id = <?php echo $_REQUEST['magID'];?>;
					   $.ajax({
								type: 'POST',
								url: 'data/getArticleadmin.php',
								data: {artDetail:artDetail, art_id:art_id, artDetailcss:artDetailcss, mag_id:mag_id},
								cache: false,
								success: function(data){
								   $("#container-wrap2").html(data);
								   $('#showArticle').hide();
								   $('#showArticle2').show();
								}
					});
					
					
					
			});
			
			$(document).on("click", "#showArticle2", function() {
			     var $test = $('#container-wrap2');
				$test.hide("slow");
								   $('#showArticle').show();
								   $('#showArticle2').hide(); 
				
				 
					
					
					
			});
		});
	</script>

</body>

</html>