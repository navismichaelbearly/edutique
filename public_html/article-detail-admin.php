<?php
session_start();
/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
/* include files */
require_once "inc/config.php";
include "inc/constants.php";

/* Select Query to check if bookmarked */
$stmt = $mysqli->prepare("SELECT bookmark FROM  edu_annotation_bookmark  WHERE art_id = ? and mag_id =? and anno_by=? and act_id=?");
/* Bind parameters */
$stmt->bind_param("ssss", $param_artid,$param_mgid,$param_anno_by, $param_actid);
/* Set parameters */
$param_artid = $_REQUEST['artID'];
$param_mgid = $_REQUEST['magID'];
$param_anno_by = $_SESSION['id'];
$param_actid = 0;
$stmt->execute();
$stmt->bind_result($bookmark);
$stmt->fetch();
$stmt->close();

$stmt = $mysqli->prepare("SELECT activity_id FROM  edu_activity  WHERE article_id = ? and mag_id =?");
/* Bind parameters */
$stmt->bind_param("ss", $param_artid,$param_mgid);
/* Set parameters */
$param_artid = $_REQUEST['artID'];
$param_mgid = $_REQUEST['magID'];
$stmt->execute();
$stmt->bind_result($activity_id11);
$stmt->fetch();
$stmt->close();

$stmt = $mysqli->prepare("SELECT reflection_ques FROM  edu_article  WHERE article_id = ? and mag_id =?");
/* Bind parameters */
$stmt->bind_param("ss", $param_artid,$param_mgid);
/* Set parameters */
$param_artid = $_REQUEST['artID'];
$param_mgid = $_REQUEST['magID'];
$stmt->execute();
$stmt->bind_result($reflection_ques);
$stmt->fetch();
$stmt->close();


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
		.modal-header {
  min-height: 16.43px;
  padding: 15px;
  border-bottom: none;
}
.addbuttonborder {
  border: 3px solid #000000 !important;
}

.modal-backdrop.in {
			  
			  opacity: .9;
}

article{
  /*background: white;*/
  /*border-radius: 4px;*/
  font-size: 13pt;
  margin: auto;
 /* padding: 30px;*/
 /* position: absolute;*/ 
  text-align: justify;
  top: 0;bottom: 0;left: 0;right: 0;
}
h1{
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
  font-size:9px;
}

.dropdown-content2 a {
  color: black;
  padding: 5px 5px;
  text-decoration: none;
  display: block;
}

/*.dropdown a:hover {background-color: #ddd;}*/

.show {display: block;}


.colorbackgreen { background-color:#86e0a3; border:5px solid #FFFFFF;cursor: pointer; padding:5px 15px; }
			.colorbackpurple {  background-color:#d9b8ff; border:5px solid #FFFFFF;cursor: pointer; padding:5px 15px;}
			.colorbackyellow {  background-color:#ffd866; border:5px solid #FFFFFF;cursor: pointer; padding:5px 15px;}
			.colorbacklightblue {  background-color:#75d7f0; border:5px solid #FFFFFF;cursor: pointer; padding:5px 15px;}
			.colorbacklightgray {  background-color:#e6e6e6; border:5px solid #FFFFFF;cursor: pointer; padding:5px 15px;}
			.colorbackpink {  background-color:#ffbdf2; border:5px solid #FFFFFF;cursor: pointer; padding:5px 15px;}
			.colorbackorange {  background-color:#fec470; border:5px solid #FFFFFF;cursor: pointer; padding:5px 15px;}
			.colorbacklblue {  background-color:#81caff; border:5px solid #FFFFFF;cursor: pointer; padding:5px 15px;}
			.colorbackred {  background-color:#ffafa4; border:5px solid #FFFFFF;cursor: pointer; padding:5px 15px;}
			.colorbackgray {  background-color:#afbccf; border:5px solid #FFFFFF;cursor: pointer; padding:5px 15px;}
.tabcolor { border:5px solid #FFFFFF}
.annocom {cursor: pointer;}

.colorbackgreen1 { display: inline-block; background-color:#86e0a3; border:5px solid #FFFFFF;cursor: pointer; padding:10px 20px; border-radius: 8px;}
			.colorbackpurple1 { display: inline-block; background-color:#d9b8ff; border:5px solid #FFFFFF;cursor: pointer; padding:10px 20px; border-radius: 8px;}
			.colorbackyellow1 { display: inline-block; background-color:#ffd866; border:5px solid #FFFFFF;cursor: pointer; padding:10px 20px; border-radius: 8px;}
			.colorbacklightblue1 { display: inline-block; background-color:#75d7f0; border:5px solid #FFFFFF;cursor: pointer; padding:10px 20px; border-radius: 8px;}
			.colorbacklightgray1 { display: inline-block; background-color:#e6e6e6; border:5px solid #FFFFFF;cursor: pointer; padding:10px 20px; border-radius: 8px;}
			.colorbackpink1 { display: inline-block; background-color:#ffbdf2; border:5px solid #FFFFFF;cursor: pointer; padding:10px 20px; border-radius: 8px;}
			.colorbackorange1 { display: inline-block; background-color:#fec470; border:5px solid #FFFFFF;cursor: pointer; padding:10px 20px; border-radius: 8px;}
			.colorbacklblue1 { display: inline-block; background-color:#81caff; border:5px solid #FFFFFF;cursor: pointer; padding:10px 20px; border-radius: 8px;}
			.colorbackred1 { display: inline-block; background-color:#ffafa4; border:5px solid #FFFFFF;cursor: pointer; padding:10px 20px; border-radius: 8px;}
			.colorbackgray1 { display: inline-block; background-color:#afbccf; border:5px solid #FFFFFF;cursor: pointer; padding:10px 20px; border-radius: 8px;}
			
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
  min-height:150px;
  margin:10px;
  padding:8px;
  border-radius: 5px;
  box-shadow: 5px 5px 2px grey;
}
.highlight {
  background-color: yellow;
}
.highlight2 {
  background-color:#d1fbeb;
}
.highlight3 {
  background-color: yellow;
}
.diselect {background-color: transparent;}
media="all and (-ms-high-contrast:none)">*::-ms-backdrop,.svg-img{width:100%;}

#SpeechSynthesis { background-color:#FFFFFF; padding:20px 10px; margin-top:20px;}


#container-wrap {
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

 #pagefullwidth{
   display :inline-block; 
 }
 #rLoud{
   display : none; 
 }
/* Landscape phone to portrait tablet  show the button */
@media (max-width: 767px) {

 #pagefullwidth{
   display : none; 
 }
 #rLoud{
   display : none; 
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
  cursor:pointer;
  }
  #myDIVsh{
  display:none;
  }
  #myDIVsh.show{
  display:block; /* P.S: Use `!important` if missing `#content` (selector specificity). */
}

.progress-label-left
{
    float: left;
    margin-right: 0.5em;
    line-height: 1em;
}
.progress-label-right
{
    float: right;
    margin-left: 0.3em;
    line-height: 1em;
}
.star-light
{
	/*color:#e9ecef;*/
	color:#b0b1b2;
}
.text-warning{
   color:#ffc107;
}
.bg-warning {
  background-color: #ffc107 !important;
}
.progress-label-left {
  float: left;
  margin-right: 0.5em;
  line-height: 1em;
}

#container-wrap p {
    font-family:Arial, Helvetica, sans-serif !important;
}
#container-wrap div {
    font-family:Arial, Helvetica, sans-serif !important;
}
#container-wrap span {
    font-family:Arial, Helvetica, sans-serif !important;
}
#container-wrap  {
    font-family:Arial, Helvetica, sans-serif !important;
}
</style>
<style id="dataArticlecss">
</style>        
		
		<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Source+Code+Pro:wght@200;600&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@200;600&display=swap" rel="stylesheet">
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
                                
                                <i class="material-icons-outlined md-16 annocom" id="pagefullwidth"  onclick="myTogglewidthfunction()">zoom_out_map</i>&nbsp;
                                <i class="material-icons-outlined md-16 annocom" id="selectText">add_comment</i>
                                <!--<i class="material-icons-outlined md-16 annocom" id="modalPop">create</i>-->&nbsp;
                                <div class="dropdown">
                                  <button onClick="myFunction()" class="dropbtn material-icons-outlined" id="modalPop2" >sticky_note_2</button>
                                  <div id="myDropdown" class="dropdown-content">
                                    <table class="tabcolor">
                                      <tr>
                                        <td ><input type="button" value="" id="colorbackgray" class="colorbackgray"></td>
                                        <td ><input type="button" value="" id="colorbackred" class="colorbackred"></td>
                                      </tr>
                                      <tr>  
                                        <td ><input type="button" value="" id="colorbacklblue" class="colorbacklblue"></td>
                                        <td ><input type="button" value="" id="colorbackorange" class="colorbackorange"></td>
                                      </tr>
                                      <tr>  
                                        <td ><input type="button" value="" id="colorbackpink" class="colorbackpink"></td>
                                        <td ><input type="button" value="" id="colorbacklightgray" class="colorbacklightgray"></td>
                                      </tr>
                                      <tr>  
                                        <td ><input type="button" value="" id="colorbacklightblue" class="colorbacklightblue"></td>
                                        <td ><input type="button" value="" id="colorbackyellow" class="colorbackyellow"> </td>
                                      </tr>
                                      <tr>  
                                         <td ><input type="button" value="" id="colorbackpurple" class="colorbackpurple"> </td>
                                          <td ><input type="button" value="" id="colorbackgreen" class="colorbackgreen"> </td>
                                      </tr>
                                </table>       
                                    
                                    
                                    
                                  </div>
                                </div>&nbsp;
                                <div class="dropdown"><?php #if(isset($_COOKIE['name'])) {echo $_COOKIE['name'];}  ?>
                                  <?php if($bookmark!=1) {?>
                                  <button onClick="myFunction2()" class="dropbtn material-icons-outlined" id="modalPop3" >star</button>
                                  <?php }else {?>
                                  <button class="dropbtn material-icons-outlined" style="color:#FF0000; cursor:default" title="Article is already Bookmarked by you"  >star</button>
                                  <?php }?>
                                  <div id="myDropdown2" class="dropdown-content2">
                                    
                                    <div id="dataBookmarkfolder"></div><br>
                                    <span id="openModalpop" style="padding:10px;" class="annocom"><span class="material-icons md-16 annocom" ><img src="images/create.png" width="22" height="22"></span>Create New Folder</span>
                                  </div>
                                </div> 
                                <?php if($_SESSION["utypeid"]== $admstdconst){ ?>
                                <span style="float:right" class="btn btn-default btn-xs buttonGray" id="askaQues">Ask a question</span> 
                                <?php }?>
                                <span style="float:right" ><a href='edit-article-content.php?artID=<?php echo $_REQUEST['artID']; ?>' style='text-decoration:none' ><i class="material-icons-outlined md-16 annocom" >create</i></a></span> 
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                </div>
                <br>
                <div class="col-lg-12" align="right"><input type="button" id="cancel" value="Back" class="btn btn-success" style="font-weight:bold"></div>
                <div class="container-fluid"><div id="dataCommentsview1" style="background-color:#99FF00"></div>
                    <!--Error-->
                    <div id="error_message" class="ui floating negative message" style="display: none">
                        <div class="header"></div>
                        <p class="message"></p>
                       
                    </div>
                 
                    <div class="row">
                        <div id="rLoud" style="float:right">
                                 <br>
                                 <?php 
								     if ($stmt = $mysqli->prepare("SELECT b.path from edu_article a inner join edu_article_audio b on a.article_id=b.article_id  where a.article_status=? and a.article_id=? and a.mag_id= ?")) {
	
	
		
									 $stmt->bind_param("sss", $param_article_status, $param_article_id, $param_mag_id);
										 // Set parameters 
									 $param_article_status = $active;
									 $param_article_id = $_REQUEST['artID'];
									 $param_mag_id = $_REQUEST['magID']; 
									 
									 $stmt->execute();
										 /* bind variables to prepared statement */
									 $stmt->bind_result($audio_path1);
									 while ($stmt->fetch()) { ?>
									  <div style="background:#FFFFFF; padding:10px; width:234px; height:72px" >
                                        <audio  preload='auto' controls >
                                             <source src='<?php echo $audio_path1;?>'>
                                        </audio>
                                        <center>Read aloud with me!</center>
                                      </div><br>
									<?php 
									} 
									 $stmt->close();
											
									}?>
                               
                                <br>
                            </div>
                        <div class="col-lg-9" >
                            <!-- <div id="test123" onMouseUp="GetSelectedText ()"> -->
							<div id="test123" ontouchend = "GetSelectedText ()" onMouseUp="GetSelectedText ()">
                            <article>
                                <div id="container-wrap" >



                                </div>
                           </article>
                           </div>
                           <?php if($reflection_ques!=''){?><br><br>
                              <a href="#" id="reflectionQues" style="color:#2994d1; text-decoration:none"><div style="border:5px solid #2994d1; padding:10px 10px"><img src="images/bulb.png" width="80" height="80"><?php echo $reflection_ques;?> </div></a><br><br>
                           <?php }?>
                           <div align="right"><?php if($activity_id11>0){?>
                           <a href="activity-detail-admin.php?artID=<?php echo $_REQUEST['artID'];?>&actID=<?php echo $activity_id11;?>&magID=<?php echo $_REQUEST['magID'];?>" class="btn btn-default btn-xl" style="margin-bottom:20px;">Go to Activity</a>&nbsp;&nbsp;<?php }?>
                           <?php if($_SESSION["utypeid"]==$admtchconst){?><span><a href="task-assign.php?art_id=<?php echo $_REQUEST['artID'];?>" class="btn btn-default btn-xl" style="margin-bottom:20px; border:1px solid #999999; padding:5px 10px">Assign/Lock</a></span><?php }?>
                           <?php if($_SESSION["utypeid"]==$admstdconst){?>
                           <span id='dataReadarticle' class="btn btn-default btn-xs"  style="background-color:#f9f9f9; color:#333333; margin-bottom:20px; border:1px solid #999999; padding:5px 10px"></span><?php }?>
                           
                           </div>
                           
                           <!----------- Review Module---------------------------------------->
                           <div class="row">
                        <div class="col-lg-12">
                                <br>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                          Review
                                          <div class="pull-right">
                                            <div class="btn-group">
                                                <?php if($_SESSION["utypeid"]==$admconst){?> 
                                                <span><a href="review-log.php" class="btn btn-default btn-xs">View Review Log</a></span>
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-4 text-center">
                                                <h1 class="text-warning mt-4 mb-4">
                                                    <b><span id="average_rating">0.0</span> / 5</b>
                                                </h1>
                                                <div class="mb-3">
                                                    <i class="material-icons-outlined star-light mr-1 main_star">star</i>
                                                    <i class="material-icons-outlined star-light star-light mr-1 main_star">star</i>
                                                    <i class="material-icons-outlined star-light star-light mr-1 main_star">star</i>
                                                    <i class="material-icons-outlined star-light mr-1 main_star">star</i>
                                                    <i class="material-icons-outlined star-light mr-1 main_star">star</i>
                                                </div>
                                                <h3><span id="total_review">0</span> Review</h3>
                                            </div>
                                            <div class="col-sm-4">
                                                <p>
                                                    <div class="progress-label-left" ><b>5</b> <i class="material-icons-outlined text-warning">star</i></div>
                        
                                                    <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                                    </div>
                                                </p>
                                                <p>
                                                    <div class="progress-label-left"><b>4</b> <i class="material-icons-outlined text-warning">star</i></div>
                                                    
                                                    <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                                    </div>               
                                                </p>
                                                <p>
                                                    <div class="progress-label-left"><b>3</b> <i class="material-icons-outlined text-warning">star</i></div>
                                                    
                                                    <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                                    </div>               
                                                </p>
                                                <p>
                                                    <div class="progress-label-left"><b>2</b> <i class="material-icons-outlined text-warning">star</i></div>
                                                    
                                                    <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                                    </div>               
                                                </p>
                                                <p>
                                                    <div class="progress-label-left"><b>1</b> <i class="material-icons-outlined text-warning">star</i></div>
                                                    
                                                    <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                                    </div>               
                                                </p>
                                            </div>
                                            <div class="col-sm-4 text-center">
                                                <h3 class="mt-4 mb-3">Write Review Here</h3>
                                                <button type="button" name="add_review" id="add_review" class="btn btn-success">Review</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-5" id="review_content"></div>
        
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                           
                           <!------------end R M-------------------------------------------------->

                                
                


                                    
                         
                        </div>
                        <!-- /.col-lg-8 -->
                        <div class="col-lg-3" id="rightsidebar">
                            <div id="dataArticleinfo"></div>
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
                            <div class="dropdown"><?php #if(isset($_COOKIE['name'])) {echo $_COOKIE['name'];}  ?>
                              <?php #if($bookmark!=1) {?>
                              <button onClick="myFunction2()" class="dropbtn material-icons-outlined" id="modalPop3" >star</button>
                              <?php #}else {?>
                              <button class="dropbtn material-icons-outlined" style="color:#FF0000; cursor:default"  >star</button>
                              <?php #}?>
                              <div id="myDropdown2" class="dropdown-content2">
                                <span style="padding:5px 0px 0px 5px" >Save to Bookmark Folder</span>
                                <div id="dataBookmarkfolder"></div><br>
                                <span id="openModalpop" style="padding:10px;"><span class="material-icons md-16 annocom" >add_box</span>Create New Folder</span>
                              </div>
                            </div>-->
                            <!--<i class="material-icons-outlined md-16 annocom" >star</i>-->
                            <br>
                            <?php 
								     if ($stmt = $mysqli->prepare("SELECT b.path from edu_article a inner join edu_article_audio b on a.article_id=b.article_id  where a.article_status=? and a.article_id=? and a.mag_id= ?")) {
	
	
		
									 $stmt->bind_param("sss", $param_article_status, $param_article_id, $param_mag_id);
										 // Set parameters 
									 $param_article_status = $active;
									 $param_article_id = $_REQUEST['artID'];
									 $param_mag_id = $_REQUEST['magID']; 
									 
									 $stmt->execute();
										 /* bind variables to prepared statement */
									 $stmt->bind_result($audio_path);
									 while ($stmt->fetch()) { ?>
                            <div style="background:#FFFFFF; padding:10px" id="rLoud1">
                            
                            <audio  preload='auto' controls >
	                             <source src='<?php echo $audio_path;?>'>
	                        </audio>
                            <center>Read aloud with me!</center>
                            </div><br>
                            <?php 
									} 
									 $stmt->close();
											
									}?>
                            
                            
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
        
       <!-- Modal popup form to add Review -->
       <div id="review_modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Submit Review</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h4 class="text-center mt-2 mb-4">
                            <i class="material-icons-outlined star-light submit_star mr-1" id="submit_star_1" data-rating="1">star</i>
                            <i class="material-icons-outlined star-light submit_star mr-1" id="submit_star_2" data-rating="2">star</i>
                            <i class="material-icons-outlined star-light submit_star mr-1" id="submit_star_3" data-rating="3">star</i>
                            <i class="material-icons-outlined star-light submit_star mr-1" id="submit_star_4" data-rating="4">star</i>
                            <i class="material-icons-outlined star-light submit_star mr-1" id="submit_star_5" data-rating="5">star</i>
                        </h4>
                        <!--<div class="form-group">
                            <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
                        </div>-->
                        <div class="form-group">
                            <textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
                        </div>
                        <div class="form-group text-center mt-4">
                            <button type="button" class="btn btn-success" id="save_review">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>       
       
       <!-- Modal popup form to change password -->
       <div class="modal fade" id="myModal" role="dialog">
           <div class="modal-dialog">
    
              <!-- Modal content-->
              <div class="modal-content">
                  <!--<div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Change Your Password</h4>
                      <p class="normaltext"><?php #echo $passwordStrengthtext;?>.</p>
                  </div>-->
                  <div class="modal-body">
                      <h4 class="modal-title">Add Comments</h4>
                      <p class="normaltext"><?php #echo $passwordStrengthtext;?></p>
                      <form role="form" action="" method="post"  >
                            <fieldset>
                                
                                <div class="form-group <?php #echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                                    <textarea class="form-control" placeholder="Comments" name="anno_comments" id="anno_comments" required ></textarea>
                                    <span id="anno_comments-info" class="info"></span>
                                </div>
                                
                                <input type="hidden" name="keytoken" value="<?php echo $keytoken;?>">  
                                <input type="hidden" name="email" value="<?php echo $email;?>">
                                <input type="hidden" name="passaction" value="reset">
                                <input type="hidden" name="topPosition" id="topPosition" value="">
                                <input type="button" id="closeModalpop" value="cancel" class="btn btn-lg btn-success btn-block">
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveAnnotationcomments"  >
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
       <div class="modal fade" id="myModaltooltip" role="dialog" >
           <div class="modal-dialog" id="removeModel">
    
              <!-- Modal content-->
              <div class="modal-content" style="padding: 5px 10px; margin-top:50px">
                  
                  <div class="modal-header" style="border-bottom:none; padding: 5px 10px;">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      
                      <!--<span onClick="myFunction3()" id="wordBanksave">Save to Word bank</span>-->
                      <div class="dropdown" >
                                  
                         <a onClick="myFunction3()"  id="modalPop4" style="color:#333333; text-decoration:none;" class="annocom">Save to Wordbank</a>
                                          
                         <div id="myDropdown3" class="dropdown-content2">
                              
                               <div id="dataWordbankfolder"></div><br>
                                <span id="openModalpopWB" style="padding:10px;" class="annocom"><span class="material-icons md-16 annocom" ><img src="images/create.png" width="22" height="22"></span>Create New Folder</span>
                        </div>
                     </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <div class="dropdown">
                                  <a onClick="myDropdownhifhlight()"  class="dropbtn annocom" id="hlt" style="color:#333333; text-decoration:none; font-size: 13px;">Highlight</a>
                                  <div id="myDropdownhifhlight" class="dropdown-content">
                                    <table class="tabcolor">
                                      <tr>
                                        <td ><input type="button" value="" id="colorbackgrayH1" class="colorbackgray"></td>
                                        <td ><input type="button" value="" id="colorbackredH1" class="colorbackred"></td>
                                      </tr>
                                      <tr>  
                                        <td ><input type="button" value="" id="colorbacklblueH1" class="colorbacklblue"></td>
                                        <td ><input type="button" value="" id="colorbackorangeH1" class="colorbackorange"></td>
                                      </tr>
                                      <tr>  
                                        <td ><input type="button" value="" id="colorbackpinkH1" class="colorbackpink"></td>
                                        <td ><input type="button" value="" id="colorbacklightgrayH1" class="colorbacklightgray"></td>
                                      </tr>
                                      <tr>  
                                        <td ><input type="button" value="" id="colorbacklightblueH1" class="colorbacklightblue"></td>
                                        <td ><input type="button" value="" id="colorbackyellowH1" class="colorbackyellow"> </td>
                                      </tr>
                                      <tr>  
                                         <td ><input type="button" value="" id="colorbackpurpleH1" class="colorbackpurple"> </td>
                                          <td ><input type="button" value="" id="colorbackgreenH1" class="colorbackgreen"> </td>
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
                      <p class="normaltext"><?php #echo $passwordStrengthtext;?>.</p>
                  </div>-->
                  <div class="modal-body">
                      <h4 class="modal-title">Your Comment</h4>
                      <p class="normaltext"><?php #echo $passwordStrengthtext;?></p>
                      <form role="form" action="" method="post"  >
                            <fieldset>
                                
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Comments" name="anno_comments" required id="dataCommentsview"   ></textarea>
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
      
       <!-- Modal popup form for reflection question display -->
       <div class="modal fade" id="myModalviewrefques" role="dialog">
           <div class="modal-dialog">
    
              <!-- Modal content-->
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <!--<h4 class="modal-title">Change Your Password</h4>
                      <p class="normaltext"><?php #echo $passwordStrengthtext;?>.</p>-->
                  </div>
                  <div class="modal-body">
                      <!--<h4 class="modal-title">Your Comment</h4>-->
                      <p class="normaltext"><?php #echo $passwordStrengthtext;?></p>
                      <form role="form" action="" method="post"  >
                            <fieldset>
                                <div class="form-group"><?php echo $reflection_ques;?>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control"  name="ref_ques" required id="ref_ques"   ></textarea>
                                    <span id="ref_ques-info" class="info"></span>
                                </div>
                                
                                <input type="button" id="saveReflectionques" value="Send" class="btn btn-lg btn-success btn-block">
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
                      
                      <form role="form" action="" method="post"  >
                            <fieldset>
                                
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Add Notes" name="anno_sticky" id="anno_sticky" required style="outline: none !important;
    border:1px solid #000000; color:#000000;" ></textarea>
                                    <span id="anno_sticky-info" class="info"></span>
                                </div>
                                
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveAnnotationsticky" style="background-color:#000000"  >
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
                      
                      <form role="form" action="" method="post"  >
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
                                        <td ><input type="button" value="" id="colorbackgray1" class="colorbackgray1"></td><td ><input type="button" value="" id="colorbackred1" class="colorbackred1"></td>
                                        <td ><input type="button" value="" id="colorbacklblue1" class="colorbacklblue1"></td>
                                        <td ><input type="button" value="" id="colorbackorange1" class="colorbackorange1"></td>
                                        <td ><input type="button" value="" id="colorbackpink1" class="colorbackpink1"></td>
                                      </tr>
                                      <tr>
                                        <td ><input type="button" value="" id="colorbacklightgray1" class="colorbacklightgray1"></td><td ><input type="button" value="" id="colorbacklightblue1" class="colorbacklightblue1"></td>
                                        <td ><input type="button" value="" id="colorbackyellow1" class="colorbackyellow1"> </td>
                                         <td ><input type="button" value="" id="colorbackpurple1" class="colorbackpurple1"> </td>
                                          <td ><input type="button" value="" id="colorbackgreen1" class="colorbackgreen1"> </td>
                                      </tr>
                                </table> 
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveFolder"  >
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
       <div class="modal fade" id="myModalWB" role="dialog" >
           <div class="modal-dialog">
    
              <!-- Modal content-->
              <div class="modal-content">
                  <div class="modal-header" style="border-bottom:none">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Create a new Wordbank folder</h4>
                  </div>
                  <div class="modal-body">
                      
                      <form role="form" action="" method="post"  >
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
                                        <td ><input type="button" value="" id="colorbackgray2" class="colorbackgray1"></td><td ><input type="button" value="" id="colorbackred2" class="colorbackred1"></td>
                                        <td ><input type="button" value="" id="colorbacklblue2" class="colorbacklblue1"></td>
                                        <td ><input type="button" value="" id="colorbackorange2" class="colorbackorange1"></td>
                                        <td ><input type="button" value="" id="colorbackpink2" class="colorbackpink1"></td>
                                      </tr>
                                      <tr>
                                        <td ><input type="button" value="" id="colorbacklightgray2" class="colorbacklightgray1"></td><td ><input type="button" value="" id="colorbacklightblue2" class="colorbacklightblue1"></td>
                                        <td ><input type="button" value="" id="colorbackyellow2" class="colorbackyellow1"> </td>
                                         <td ><input type="button" value="" id="colorbackpurple2" class="colorbackpurple1"> </td>
                                          <td ><input type="button" value="" id="colorbackgreen2" class="colorbackgreen1"> </td>
                                      </tr>
                                </table> 
                                </div>
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveWBFolder"  >
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
                      
                      <form role="form" action="" method="post"  >
                            <fieldset>
                                
                                
                                <div class="form-group">
                                     <textarea id="definition2" class="form-control"></textarea>
                                </div>
                                
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveexistWBFolder"  >
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
                      
                      <form role="form" action="" method="post"  >
                            <fieldset>
                                
                                <div class="form-group"><label>Send a Question to Teacher</label><br>
                                    <textarea class="form-control"  name="s_Ques" id="s_Ques" required style="outline: none !important;
    border:1px solid #000000; color:#000000;" rows="5" ></textarea>
                                    <span id="anno_sticky-info" class="info"></span>
                                </div>
                                
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveSendaques"   >
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
		
		$(document).ready(function () {
		    $('#cancel').on('click', function(e){
				e.preventDefault();
				window.history.back();
			    });
		    $(window).on('load', function() { 
				   var artDetail = 1;
					   var art_id = <?php echo $_REQUEST['artID'];?>; 
					   var artDetailcss ='';
					   var mag_id = <?php echo $_REQUEST['magID'];?>;
					   $.ajax({
								type: 'POST',
								url: 'data/getArticleinformatiom.php',
								data: {artDetail:artDetail, art_id:art_id, artDetailcss:artDetailcss, mag_id:mag_id},
								cache: false,
								success: function(data){
								   $("#dataArticleinfo").html(data);
								  
								}
					});
			});		
		   /*window.onclick = function(event) {
			   if (event.target.id != "removeModel") {
				  $('#myModaltooltip').modal('hide');
			   }
			}*/
		  
		    //--------------ask a question---------------------------------
			 $('#askaQues').on('click', function () { 
					varColor = '#afbccf';
					$('#myModalaskaque').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					 });
					  
				});
				
				$('#saveSendaques').on('click', function () {  
				     var sendQues = 1;
					 var ques_des = $("#s_Ques").val();
				     var art_id = <?php echo $_REQUEST['artID'];?>;
				     var act_id = <?php echo $_REQUEST['actID'];?>;
					 var mag_id = <?php echo $_REQUEST['magID'];?>;
				     $.ajax({
					     type: 'POST',
					     url: 'data/saveQuestion.php',
					     data: {sendQues:sendQues,art_id:art_id,act_id:act_id, ques_des:ques_des, mag_id:mag_id},
					     cache: false,
					     success: function(data){
						     $('#successAll').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					        });
					        setTimeout(function() {$('#successAll').modal('hide');}, 2000);
							 
							 $('#myModalaskaque').modal('hide'); 
					         //displayStickynotes(); 
					   
					    }
				     });event.preventDefault();
				});
		    //-----------read article  --------------------------------------
			function readArticlefunc() {
			  var readArticlechecked = 1;
					   var art_id = <?php echo $_REQUEST['artID'];?>;
					   var magazineID = <?php echo $_REQUEST['magID'];?>; 
					   $.ajax({
								type: 'POST',
								url: 'data/readArticle2.php',
								data: {readArticlechecked:readArticlechecked, art_id:art_id, magazineID:magazineID},
								cache: false,
								success: function(data){
								   $("#dataReadarticle").html(data);
								  
								}
					});event.preventDefault();
			}
			$(window).on('load', function() { 
				   
					readArticlefunc();
					
			});
			$(document).on("click", "#readArticle", function(){ // onclic function
				   
					 var readArticlenew = 1
				     var art_id = <?php echo $_REQUEST['artID'];?>;
					 var mag_id = <?php echo $_REQUEST['magID'];?>;
				      $.ajax({
					     type: 'POST',
					     url: 'data/readArticle.php',
					     data: {readArticlenew:readArticlenew,art_id:art_id, mag_id:mag_id},
					     cache: false,
					     success: function(data){
					        $('#successAll').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					        });
					        setTimeout(function() {$('#successAll').modal('hide');}, 2000);
					        readArticlefunc();
					   
					    }
				     });event.preventDefault();
             });
			//-----------get article detail --------------------------------------
			$(window).on('load', function() { 
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
								   $("#container-wrap").html(data);
								  
								}
					})
					
					var artDetail = '';
					   var art_id = <?php echo $_REQUEST['artID'];?>;
					   var artDetailcss =1;
					   var mag_id = <?php echo $_REQUEST['magID'];?>;
					   $.ajax({
								type: 'POST',
								url: 'data/getArticleadmin.php',
								data: {artDetail:artDetail, art_id:art_id, artDetailcss:artDetailcss, mag_id:mag_id},
								cache: false,
								success: function(data){
								   $("#dataArticlecss").html(data);
								  
								}
					})
			});
			
			//-------------------sticky notes annotations-------------------------
			    var varColor;
			    $('#colorbackgray').on('click', function () { 
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
				$('#modalcClose').on('click', function () { 
				   $('#colorbackgray').modal('hide');
				});
				$('#colorbackred').on('click', function () { 
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
				$('#colorbacklblue').on('click', function () { 
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
				$('#colorbackorange').on('click', function () { 
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
				$('#colorbackpink').on('click', function () { 
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
				$('#colorbacklightgray').on('click', function () { 
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
				$('#colorbacklightblue').on('click', function () { 
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
				$('#colorbackyellow').on('click', function () { 
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
				$('#colorbackpurple').on('click', function () { 
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
				$('#colorbackgreen').on('click', function () { 
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
			    $('#modalPop').on('click', function () { 
					$('#myModal').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					 });
					 $('#myModaltooltip').modal('hide');
					 
				});
				
				function displayStickynotes(){
				     var annoColor = '';
					 var anno_sticky = '';
				     var art_id = <?php echo $_REQUEST['artID'];?>;
				     var act_id = <?php echo $_REQUEST['actID'];?>;
				     var sticky_id ='';
				     var sticky_id_view = '';
					 var mag_id = <?php echo $_REQUEST['magID'];?>;
				   $.ajax({
									type: 'POST',
									url: 'data/saveAnnotationsticky.php',
									data: {anno_sticky:anno_sticky,art_id:art_id,act_id:act_id, sticky_id:sticky_id, sticky_id_view:sticky_id_view, annoColor:annoColor, mag_id:mag_id},
									cache: false,
									success: function(data){
									   
									   $("#dataStickyview").html(data);
									   
									   
									}
						 });event.preventDefault();
				}
				
				$('#saveAnnotationsticky').on('click', function () {  
				     var annoColor = varColor;
					 var anno_sticky = $("#anno_sticky").val();
				     var art_id = <?php echo $_REQUEST['artID'];?>;
				     var act_id = <?php echo $_REQUEST['actID'];?>;
				     var sticky_id ='';
				     var sticky_id_view = '';
					 var mag_id = <?php echo $_REQUEST['magID'];?>;
				     $.ajax({
					     type: 'POST',
					     url: 'data/saveAnnotationsticky.php',
					     data: {anno_sticky:anno_sticky,art_id:art_id,act_id:act_id, sticky_id:sticky_id, sticky_id_view:sticky_id_view, annoColor:annoColor, mag_id:mag_id},
					     cache: false,
					     success: function(data){
						     $('#successAll').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					        });
					        setTimeout(function() {$('#successAll').modal('hide');}, 2000);
							 $('#anno_sticky').val('');
					         // window.location='article-detail.php?artID=<?php #echo $_REQUEST['artID'];?>';
					         //$("#dataStickyview").html(data); 
							 $('#myModalcolor').modal('hide'); 
					         displayStickynotes(); 
					   
					    }
				     });event.preventDefault();
				});
				
				$(window).on('load', function() { 
				  
				   displayStickynotes();
				});
				
				 $(document).on("click", "#stickyDel", function(e){ // onclic function
				   e.preventDefault();
				   var annoColor = '';
					 var anno_sticky = '';
				     var art_id = <?php echo $_REQUEST['artID'];?>;
				     var act_id = <?php echo $_REQUEST['actID'];?>;
				     var sticky_id =$(this).data('id');
				     var sticky_id_view = '';
					 var mag_id ='';
				   var result = confirm("Are you sure you want to delete the Sticky Note?");
                   if (result) {
				      $.ajax({
					     type: 'POST',
					     url: 'data/saveAnnotationsticky.php',
					     data: {anno_sticky:anno_sticky,art_id:art_id,act_id:act_id, sticky_id:sticky_id, sticky_id_view:sticky_id_view, annoColor:annoColor},
					     cache: false,
					     success: function(data){
						    $('#successAll').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					        });
					        setTimeout(function() {$('#successAll').modal('hide');}, 2000);
					        displayStickynotes();
					   
					    }
				     });
				  }
               });   
				
				$('#closeModalpop').on('click', function () { 
				   $('#myModal').modal('hide');
				});
				
				//---------------comments Annotations-------------------------
				function displayComment(){

			      var anno_comments = '';
				   var art_id = <?php echo $_REQUEST['artID'];?>;
				   var act_id = <?php echo $_REQUEST['actID'];?>;
				   var com_id ='';
				   var com_id_view = '';
				    var highlightText = '';
					var windowsize = $(window).width();
					 var mag_id = <?php echo $_REQUEST['magID'];?>;
				   $.ajax({
									type: 'POST',
									url: 'data/saveAnnotationcomments.php',
									data: {anno_comments:anno_comments,art_id:art_id,act_id:act_id, com_id:com_id, com_id_view:com_id_view, selText:selText, highlightText:highlightText,mag_id:mag_id,windowsize:windowsize},
									cache: false,
									success: function(data){
									   $("#dataComments").html(data);
									    //highlight(data.trimStart());
										//highlightCommentviewfunc();
									   
									}
						 });event.preventDefault();
				}
				
				 function highlightCommentviewfunc() {
              
					   var art_id = <?php echo $_REQUEST['artID'];?>;
				       var act_id = <?php echo $_REQUEST['actID'];?>; 
					  // var selText ='';
					   var highlightCommenttext = 1;
					   var mag_id = <?php echo $_REQUEST['magID'];?>;
				      $.ajax({
					     type: 'POST',
				         url: 'data/viewHighlightannotations.php',
					     data: {highlightCommenttext:highlightCommenttext,art_id:art_id, act_id:act_id,mag_id:mag_id},
					     cache: false,
					     success: function(data){ 
						  var valNew=data.split('***');

						for(i=0;i<valNew.length;i++){
							highlight(valNew[i].trimStart());
						}
					      

														 //highlight2(data.trimStart());
					   
					    }
				     });
                }
			
				$(document).on("click", "#modalPopviewcomment", function(){ 
				   $('#myModalviewcomment').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					 });
				   var anno_comments = '';
				   var art_id = '';
				   var act_id = '';
				   var com_id ='';
				    var highlightText = '';
					var mag_id='';
				   var com_id_view = $(this).data('id');
				      $.ajax({
					     type: 'POST',
					     url: 'data/saveAnnotationcomments.php',
					     data: {anno_comments:anno_comments,art_id:art_id,act_id:act_id, com_id:com_id, com_id_view:com_id_view, selText:selText, highlightText:highlightText,mag_id:mag_id},
					     cache: false,
					     success: function(data){ var ret = data.replace('</div>','');
					         $("#dataCommentsview").html(ret);  
					   
					    }
				     });
					 
					
				});
				$('#closeModalpop2').on('click', function () { 
				   $('#myModalviewcomment').modal('hide');
				   
				});
				
				$(document).on("click", "#modalPopviewcomment", function(){ 
				  
				   var anno_comments = '';
				   var art_id = '';
				   var act_id = '';
				   var com_id ='';
				   var com_id_view = $(this).data('id');
				    var highlightText = 1;
					var mag_id='';
				      $.ajax({
					     type: 'POST',
					     url: 'data/saveAnnotationcomments.php',
					     data: {anno_comments:anno_comments,art_id:art_id,act_id:act_id, com_id:com_id, com_id_view:com_id_view, selText:selText, highlightText:highlightText,mag_id:mag_id},
					     cache: false,
					     success: function(data){
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
				$('#saveAnnotationcomments').on('click', function () { 
			           var anno_comments = $("#anno_comments").val();
					   
					   var art_id = <?php echo $_REQUEST['artID'];?>;
					   var act_id = <?php echo $_REQUEST['actID'];?>;
					   var com_id ='';
					   var com_id_view = '';
					    var highlightText = '';
						 var mag_id = <?php echo $_REQUEST['magID'];?>;
					   if (anno_comments == "") {
					     $("#anno_comments-info").html("Please enter the comment.");
					     $("#anno_comments").addClass("input-error");
					     return false;
			           }else{
						   $.ajax({
									type: 'POST',
									url: 'data/saveAnnotationcomments.php',
									data: {anno_comments:anno_comments,art_id:art_id,act_id:act_id, com_id:com_id, com_id_view:com_id_view, selText:selText, highlightText:highlightText,mag_id:mag_id,top:$('#topPosition').val()},
									cache: false,
									success: function(data){
									   $('#successAll').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
										});
										setTimeout(function() {$('#successAll').modal('hide');}, 2000);
									   $('#anno_comments').val('');
									   $('#myModal').modal('hide');
									   window.location='article-detail-admin.php?artID=<?php echo $_REQUEST['artID'];?>&actID=<?php echo $_REQUEST['actID'];?>&magID=<?php echo $_REQUEST['magID'];?>';
									   displayComment();
									   
									}
						 });event.preventDefault();
					 }	 
				});	
				
			    $(document).on("click", "#comDel", function(e){ // onclic function
				   e.preventDefault();
				   var anno_comments = '';
				   var art_id = '';
				   var act_id = '';
				   var com_id = $(this).data('id');
				   var com_id_view = '';
				   var highlightText = '';
				   var mag_id='';
				   var result = confirm("Are you sure you want to delete the comment?");
                   if (result) {
				      $.ajax({
					     type: 'POST',
					     url: 'data/saveAnnotationcomments.php',
					     data: {anno_comments:anno_comments,art_id:art_id,act_id:act_id, com_id:com_id, com_id_view:com_id_view, selText:selText, highlightText:highlightText,mag_id:mag_id},
					     cache: false,
					     success: function(data){
					        $('#successAll').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					        });
					        setTimeout(function() {$('#successAll').modal('hide');}, 2000);
					        window.location='article-detail-admin.php?artID=<?php echo $_REQUEST['artID'];?>&actID=<?php echo $_REQUEST['actID'];?>&magID=<?php echo $_REQUEST['magID'];?>';
							
							 displayComment();
					   
					    }
				     });
				  }
               });
			   
			   //--------------------------------------book marks------------------------------------------------
			   
			   $('#openModalpop').on('click', function () { 
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
					   var bmFolder =0;
					   var idColorbookmark ='';
					    var magazineID = <?php echo $_REQUEST['magID'];?>;
					   $.ajax({
								type: 'POST',
								url: 'data/bookMarkannotations.php',
								data: {book_mark_type:book_mark_type, bookMark:bookMark ,annoColor:annoColor,art_id:art_id, act_id:act_id, bmFolder:bmFolder, idColorbookmark:idColorbookmark,magazineID:magazineID},
								cache: false,
								success: function(data){
								   $("#dataBookmarktype").html(data);
								  
								}
					})
			        
		    });
			
			var varColor1;
			
			$('#colorbackgray1').on('click', function () { 
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
			$('#colorbackred1').on('click', function () { 
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
			$('#colorbacklblue1').on('click', function () { 
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
			$('#colorbackorange1').on('click', function () { 
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
			$('#colorbackpink1').on('click', function () { 
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
			$('#colorbacklightgray1').on('click', function () { 
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
			$('#colorbacklightblue1').on('click', function () { 
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
			$('#colorbackyellow1').on('click', function () { 
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
			$('#colorbackpurple1').on('click', function () { 
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
			$('#colorbackgreen1').on('click', function () { 
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
			
			
			$('#saveFolder').on('click', function () {  // onclic function
			   var annoColor = varColor1; 
					 var book_mark_type = $("#bookMarktype").val(); 
					 var art_id = <?php echo $_REQUEST['artID'];?>;
				     var act_id = <?php echo $_REQUEST['actID'];?>;
                   var bmFolder =0;
				   var bookMark = '';
				   var idColorbookmark ='';
				    var magazineID = <?php echo $_REQUEST['magID'];?>;
				   $.ajax({
					type: 'POST',
					url: 'data/bookMarkannotations.php',
					data: {book_mark_type:book_mark_type, annoColor:annoColor, art_id:art_id, act_id:act_id, bmFolder:bmFolder, bookMark:bookMark, idColorbookmark:idColorbookmark,magazineID:magazineID},
					cache: false,
					success: function(data){
					  $('#myModalBK').modal('hide');
					  // alert('Bookmark added to the New Folder successfully');
					  // window.location='article-detail.php?artID=<?php echo $_REQUEST['artID'];?>&magID=<?php echo $_REQUEST['magID'];?>';
					  $("#dataBookmarkfolderexists").html(data);
					}
				  });event.preventDefault();
			  	  
           });
		   
		   $('#modalPop3').on('click', function () { // onload jQuery Ajax Calls in PHP Script
					   var bookMark = '';
					   var annoColor = '';
					   var book_mark_type = '';
					   var art_id = 0;
				       var act_id = 0;
					   var bmFolder =1;
					   var idColorbookmark ='';
					    var magazineID = <?php echo $_REQUEST['magID'];?>;
					   $.ajax({
								type: 'POST',
								url: 'data/bookMarkannotations.php',
								data: {book_mark_type:book_mark_type, bookMark:bookMark ,annoColor:annoColor,art_id:art_id, act_id:act_id, bmFolder:bmFolder, idColorbookmark:idColorbookmark,magazineID:magazineID},
								cache: false,
								success: function(data){
								   $("#dataBookmarkfolder").html(data);
								  
								}
					});
			        
		    });
			
			$(document).on("click", "#saveTofolder", function(e){ // onclic function
				   e.preventDefault();
				       var bookMark = '';
					   var annoColor = '';
					   var book_mark_type = '';
					   var art_id = <?php echo $_REQUEST['artID'];?>;
				       var act_id = <?php echo $_REQUEST['actID'];?>;
					   var bmFolder ='';
					   var idColorbookmark = $(this).data('id');					   
					   var magazineID = <?php echo $_REQUEST['magID'];?>;
				      $.ajax({
					     type: 'POST',
				         url: 'data/bookMarkannotations.php',
					     data: {book_mark_type:book_mark_type, bookMark:bookMark ,annoColor:annoColor,art_id:art_id, act_id:act_id, bmFolder:bmFolder, idColorbookmark:idColorbookmark,magazineID:magazineID},
					     cache: false,
					     success: function(data){
					        $('#successAll').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					        });
					        setTimeout(function() {$('#successAll').modal('hide');}, 2000);
							setTimeout(function(){
                                 window.location='article-detail-admin.php?artID=<?php echo $_REQUEST['artID'];?>&actID=<?php echo $_REQUEST['actID'];?>&magID=<?php echo $_REQUEST['magID'];?>';
                             }, 2000);
					      
					   
					    }
				     });
				  
             });
//--------------------------------------word bank------------------------------------------------
             $('#openModalpopWB').on('click', function () { 
				   $('#myModalWB').modal({
                                      backdrop: 'static',
                                      keyboard: true, 
                                     show: true
					});
			  });
			  $(window).on('load', function() {
			  <?php if(isset($_REQUEST['idColorwordbank11']) && $_REQUEST['idColorwordbank11']!=""){ ?>
			     $('#myModalsaveexistWB').modal({
                                      backdrop: 'static',
                                      keyboard: true, 
                                     show: true
					});
			        var idColorwordbank11 = '<?php echo $_REQUEST['idColorwordbank11'];?>';
				   
				   
				   $('#saveexistWBFolder').on('click', function () { 
			         
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
					   var wbFolder =0;
					   var idColorwordbank ='';
					   var definition = '';
					   var pageT = '';
					    var magazineID = <?php echo $_REQUEST['magID'];?>;
					   $.ajax({
								type: 'POST',
								url: 'data/addWordbank.php',
								data: {word_bank_type:word_bank_type, wordBank:wordBank ,annoColor:annoColor,art_id:art_id, act_id:act_id, wbFolder:wbFolder, idColorwordbank:idColorwordbank,magazineID:magazineID, selText:selText,definition:definition, pageT:pageT},
								cache: false,
								success: function(data){
								   $("#dataWordbanktype").html(data);
								  
								}
					})
			        
		    }); 
			  
			  var varColor2;
			
			$('#colorbackgray2').on('click', function () { 
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
			$('#colorbackred2').on('click', function () { 
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
			$('#colorbacklblue2').on('click', function () { 
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
			$('#colorbackorange2').on('click', function () { 
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
			$('#colorbackpink2').on('click', function () { 
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
			$('#colorbacklightgray2').on('click', function () { 
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
			$('#colorbacklightblue2').on('click', function () { 
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
			$('#colorbackyellow2').on('click', function () { 
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
			$('#colorbackpurple2').on('click', function () { 
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
			$('#colorbackgreen2').on('click', function () { 
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
			 
			  $('#saveWBFolder').on('click', function () {  // onclic function
			   var annoColor = varColor2; 
					 var word_bank_type = $("#wordBanktype").val(); 
					 var art_id = <?php echo $_REQUEST['artID'];?>;
				     var act_id = <?php echo $_REQUEST['actID'];?>;
                   var wbFolder =0;
				   var wordBank = '';
				   var idColorwordbank ='';
				    var magazineID = <?php echo $_REQUEST['magID'];?>;
					var definition = '';
					var pageT = 'art';
				   $.ajax({
					type: 'POST',
					url: 'data/addWordbank.php',
					data: {word_bank_type:word_bank_type, wordBank:wordBank ,annoColor:annoColor,art_id:art_id, act_id:act_id, wbFolder:wbFolder, idColorwordbank:idColorwordbank,magazineID:magazineID, selText:selText,definition:definition, pageT:pageT},
					cache: false,
					success: function(data){
					  $('#myModalWB').modal('hide');
					  // alert('Bookmark added to the New Folder successfully');
					  // window.location='article-detail.php?artID=<?php echo $_REQUEST['artID'];?>&magID=<?php echo $_REQUEST['magID'];?>';
					  $("#dataWordbankfolderexists").html(data);
					}
				  });event.preventDefault();
			  	  
           });
			  			 
			 $('#modalPop4').on('click', function () { // onload jQuery Ajax Calls in PHP Script
					   var wordBank = '';
					   var annoColor = '';
					   var word_bank_type = '';
					   var art_id = 0;
				       var act_id = 0;
					   var wbFolder =1;
					   var idColorwordbank ='';
					    var magazineID = <?php echo $_REQUEST['magID'];?>;
						var definition = '';
					   var pageT = '';
					   $.ajax({
								type: 'POST',
								url: 'data/addWordbank.php',
								data: {word_bank_type:word_bank_type, wordBank:wordBank ,annoColor:annoColor,art_id:art_id, act_id:act_id, wbFolder:wbFolder, idColorwordbank:idColorwordbank,magazineID:magazineID, selText:selText,definition:definition, pageT:pageT},
								cache: false,
								success: function(data){
								   $("#dataWordbankfolder").html(data);
								  
								}
					});
			        
		    });
			
			$(document).on("click", "#saveTowbfolder", function(e){ // onclic function 
			       
				      $('#myModalsaveexistWB').modal({
                                      backdrop: 'static',
                                      keyboard: true, 
                                     show: true
					});
			        var idColorwordbank11 = $(this).data('id');
				   
				   
				   $('#saveexistWBFolder').on('click', function () { 
			         
					 saveexistingFolder(idColorwordbank11);
				       
			       });
				  
             });
			 
			 function saveexistingFolder(idColorwordbank11){
			           var wordBank = '';
					   var annoColor = '';
					   var word_bank_type = '';
					   var art_id = <?php echo $_REQUEST['artID'];?>;
				       var act_id = <?php echo $_REQUEST['actID'];?>;
					   var wbFolder ='';
					   var idColorwordbank = idColorwordbank11; 				   
					   var magazineID = <?php echo $_REQUEST['magID'];?>;
					   var definition = $("#definition2").val(); 
					   <?php if(isset($_REQUEST['selectedText']) && $_REQUEST['selectedText']!=""){ ?>
					   var selText = '<?php echo $_REQUEST['selectedText'];?>';
					   <?php }?>
					   var pageT = '';
				      $.ajax({
					     type: 'POST',
				         url: 'data/addWordbank.php',
					     data: {word_bank_type:word_bank_type, wordBank:wordBank ,annoColor:annoColor,art_id:art_id, act_id:act_id, wbFolder:wbFolder, idColorwordbank:idColorwordbank, magazineID:magazineID, selText:selText,definition:definition, pageT:pageT},
					     cache: false,
					     success: function(data){
					         $('#successAll').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					        });
					        setTimeout(function() {$('#successAll').modal('hide');}, 2000);
							setTimeout(function(){
                                  window.location='article-detail-admin.php?artID=<?php echo $_REQUEST['artID'];?>&actID=<?php echo $_REQUEST['actID'];?>&magID=<?php echo $_REQUEST['magID'];?>';
                             }, 2000);
					       
					   
					    }
				     });event.preventDefault();
			 }
 //------------------------highlight text ------------------------------------------------------
               function highlightTextviewfunc() {
               var textHighlight = '';
					   var art_id = <?php echo $_REQUEST['artID'];?>;
				       var act_id = <?php echo $_REQUEST['actID'];?>; 
					  // var selText ='';
					   var highlightTextview =1;
					   var mag_id = <?php echo $_REQUEST['magID'];?>;
				      $.ajax({
					     type: 'POST',
				         url: 'data/textHighlightannotations.php',
					     data: {selText:selText,textHighlight:textHighlight,art_id:art_id, act_id:act_id, highlightTextview:highlightTextview,mag_id:mag_id},
					     cache: false,
					     success: function(data){
						 var valNew=data.split('***'); 
						 var alternateTitle = valNew.filter(function(val,idx) {
							  if(idx%2==0)
								return val;
							}); 
						 var alternateColor = valNew.filter(function(val,idx) {
							  if(idx%2==1)
								return val;
							});	
						 for(i=0;i<alternateTitle.length;i++){ //alert(valNew[i])
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
			 
			 function highlightColorbutton(clr){
			   var textHighlight = 1; 
				var art_id = <?php echo $_REQUEST['artID'];?>;
								   var act_id = <?php echo $_REQUEST['actID'];?>;
								   var highlightTextview ='';
								   var mag_id = <?php echo $_REQUEST['magID'];?>;				
							   $.ajax({
								type: 'POST',
								url: 'data/textHighlightannotations.php',
								data: {selText:selText,textHighlight:textHighlight,art_id:art_id, act_id:act_id, highlightTextview:highlightTextview,mag_id:mag_id,clr:clr},
								cache: false,
								success: function(data){
								   //alert('Bookmark added to the New Folder successfully');
								   $('#myModaltooltip').modal('hide');
								   highlightTextviewfunc();
								}
							  })
			 }
			 var varColorhlt;
			$('#colorbackgrayH1').on('click', function () { 
				varColorhlt = '#afbccf';				
			  //$('#myModaltooltip').modal('hide');
			  highlightColorbutton(varColorhlt)
								 
			});
			$('#colorbackredH1').on('click', function () { 
				varColorhlt = '#ffafa4';				
			  //$('#myModaltooltip').modal('hide');
			  highlightColorbutton(varColorhlt)
								 
			});
			$('#colorbacklblueH1').on('click', function () { 
				varColorhlt = '#81caff';				
			  //$('#myModaltooltip').modal('hide');
			  highlightColorbutton(varColorhlt)
								 
			});
			$('#colorbackorangeH1').on('click', function () { 
				varColorhlt = '#fec470';				
			  //$('#myModaltooltip').modal('hide');
			  highlightColorbutton(varColorhlt)
								 
			});
			$('#colorbackpinkH1').on('click', function () { 
				varColorhlt = '#ffbdf2';				
			  //$('#myModaltooltip').modal('hide');
			  highlightColorbutton(varColorhlt)
								 
			});
			$('#colorbacklightgrayH1').on('click', function () { 
				varColorhlt = '#e6e6e6';				
			  //$('#myModaltooltip').modal('hide');
			  highlightColorbutton(varColorhlt)
								 
			});
			$('#colorbacklightblueH1').on('click', function () { 
				varColorhlt = '#75d7f0';				
			  //$('#myModaltooltip').modal('hide');
			  highlightColorbutton(varColorhlt)
								 
			});
			$('#colorbackyellowH1').on('click', function () { 
				varColorhlt = '#ffd866';				
			  //$('#myModaltooltip').modal('hide');
			  highlightColorbutton(varColorhlt)
								 
			});
			$('#colorbackpurpleH1').on('click', function () { 
				varColorhlt = '#d9b8ff';				
			  //$('#myModaltooltip').modal('hide');
			  highlightColorbutton(varColorhlt)
								 
			});
			$('#colorbackgreenH1').on('click', function () { 
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
			function GetSelectedText () {
           // var selText = "";
            if (window.getSelection) {  // all browsers, except IE before version 9
                if (document.activeElement && 
                        (document.activeElement.tagName.toLowerCase () == "textarea" || 
                         document.activeElement.tagName.toLowerCase () == "input")) 
                {
                    var text = document.activeElement.value;
                    selText = text.substring (document.activeElement.selectionStart, 
                                              document.activeElement.selectionEnd);
                }
                else {
                    var selRange = window.getSelection ();
                    selText = selRange.toString ();
                }
            }
            else {
				
                if (document.selection.createRange) {       // Internet Explorer
                    var range = document.selection.createRange ();
                    selText = range.text;
                }
            }
			var r=window.getSelection().getRangeAt(0).getBoundingClientRect();
            var relative=document.body.parentNode.getBoundingClientRect();
            var top =((r.bottom -relative.top) - 60);
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
		
		$(document).ready(function () {
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
   innerHTML = innerHTML.substring(0,index) + "<span class='highlight' id='spanHigh'>" + innerHTML.substring(index,index+text1.length) + "</span>" + innerHTML.substring(index + text1.length);
   pageContainer.innerHTML = innerHTML;
   //document.getElementById('spanHigh').scrollIntoView();
  
  }
}

function highlight3(text1) { 
		 
  var pageContainer = document.getElementById("test123");  
  var innerHTML = pageContainer.innerHTML;
  var index = innerHTML.indexOf(text1);
 
  if (index >= 0) { 
   innerHTML = innerHTML.substring(0,index) + "<span class='highlight3' id='spanHigh3'>" + innerHTML.substring(index,index+text1.length) + "</span>" + innerHTML.substring(index + text1.length);
   pageContainer.innerHTML = innerHTML;
   document.getElementById('spanHigh3').scrollIntoView();
  
  }
}

function highlight2(text1, text2) { 
		
  var pageContainer = document.getElementById("test123");  
  var innerHTML = pageContainer.innerHTML;
  var index = innerHTML.indexOf(text1);
 
  if (index >= 0) { 
  innerHTML = innerHTML.substring(0,index) + "<span  id='spanHigh2' style='background-color:"+text2+"'>" + innerHTML.substring(index,index+text1.length) + "</span>" + innerHTML.substring(index + text1.length);
   pageContainer.innerHTML = innerHTML;
  // document.getElementById('spanHigh2').scrollIntoView();
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
	document.getElementById("rLoud").style.display = "none";
	document.getElementById("rLoud1").style.display = "block";
	
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
	document.getElementById("rLoud").style.display = "block";
	document.getElementById("rLoud1").style.display = "none";
  }
}

$(document).ready(function() {
        $(document).on("click", "#showmenu", function(e){
       // $('#showmenu').click(function() {
                $('.menuShow').slideToggle("fast");
        });
		
		
		
		$('#reflectionQues').on('click', function () { // onload jQuery Ajax Calls in PHP Script
		         $('#myModalviewrefques').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					 });
					  
			        
		    });
			
			$('#saveReflectionques').on('click', function () { // onload jQuery Ajax Calls in PHP Script
		        
					   var reflection_ques = '<?php echo $reflection_ques;?>';
					   var ref_ques_response = $('#ref_ques').val();
				   	  var art_id = <?php echo $_REQUEST['artID'];?>;
			          var act_id = <?php echo $_REQUEST['actID'];?>;
				      var magazineID = <?php echo $_REQUEST['magID'];?>;
					   $.ajax({
								type: 'POST',
								url: 'data/saveReflection.php',
								data: {reflection_ques:reflection_ques, ref_ques_response:ref_ques_response ,art_id:art_id,act_id:act_id,magazineID:magazineID},
								cache: false,
								success: function(data){
								   $('#myModalviewrefques').modal('hide');
									$('#successAll').modal({
												  backdrop: 'static',
												  keyboard: true, 
												 show: true
									});
									setTimeout(function() {$('#successAll').modal('hide');}, 2000);
								  
								}
					});
			        
		    });
			
			
    });
	

$(document).ready(function(){

			var rating_data = 0;
		
			$('#add_review').click(function(){
		
				$('#review_modal').modal('show');
		
			});
		
			$(document).on('mouseenter', '.submit_star', function(){
		
				var rating = $(this).data('rating');
		
				reset_background();
		
				for(var count = 1; count <= rating; count++)
				{
		
					$('#submit_star_'+count).addClass('text-warning');
		
				}
		
			});
		
			function reset_background()
			{
				for(var count = 1; count <= 5; count++)
				{
		
					$('#submit_star_'+count).addClass('star-light');
		
					$('#submit_star_'+count).removeClass('text-warning');
		
				}
			}
		
			$(document).on('mouseleave', '.submit_star', function(){
		
				reset_background();
		
				for(var count = 1; count <= rating_data; count++)
				{
		
					$('#submit_star_'+count).removeClass('star-light');
		
					$('#submit_star_'+count).addClass('text-warning');
				}
		
			});
		
			$(document).on('click', '.submit_star', function(){
		
				rating_data = $(this).data('rating');
		
			});
		
			$('#save_review').click(function(){
		
				//var user_name = $('#user_name').val();
		
				var user_review = $('#user_review').val();
				var art_id = <?php echo $_REQUEST['artID'];?>;
			    var act_id = <?php echo $_REQUEST['actID'];?>;
				var magazineID = <?php echo $_REQUEST['magID'];?>;
		
				if( user_review == '')
				{
					alert("Please Fill Both Field");
					return false;
				}
				else
				{
					$.ajax({
						url:"data/submit_rating.php",
						method:"POST",
						data:{rating_data:rating_data, user_review:user_review,art_id:art_id,act_id:act_id,magazineID:magazineID},
						success:function(data)
						{
							$('#review_modal').modal('hide');
		                    $('#successAll').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					        });
					        setTimeout(function() {$('#successAll').modal('hide');}, 2000);
							load_rating_data();
		
							//alert(data);
						}
					})
				}
		
			});
		
			load_rating_data();
		
			function load_rating_data()
			{   
			    var art_id = <?php echo $_REQUEST['artID'];?>;
			    var act_id = <?php echo $_REQUEST['actID'];?>;
				var magazineID = <?php echo $_REQUEST['magID'];?>;
				$.ajax({
					url:"data/submit_rating.php",
					method:"POST",
					data:{action:'load_data',art_id:art_id,act_id:act_id,magazineID:magazineID},
					dataType:"JSON",
					success:function(data)
					{
						$('#average_rating').text(data.average_rating);
						$('#total_review').text(data.total_review);
		
						var count_star = 0;
		
						$('.main_star').each(function(){
							count_star++;
							if(Math.ceil(data.average_rating) >= count_star)
							{
								$(this).addClass('text-warning');
								$(this).addClass('star-light');
							}
						});
		
						$('#total_five_star_review').text(data.five_star_review);
		
						$('#total_four_star_review').text(data.four_star_review);
		
						$('#total_three_star_review').text(data.three_star_review);
		
						$('#total_two_star_review').text(data.two_star_review);
		
						$('#total_one_star_review').text(data.one_star_review);
		
						$('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');
		
						$('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');
		
						$('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');
		
						$('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');
		
						$('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');
		
						if(data.review_data.length > 0)
						{
							var html = '';
		
							for(var count = 0; count < data.review_data.length; count++)
							{
								html += '<div class="row mb-3">';
		
								/*html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name+'</h3></div></div>';*/
		
								html += '<div class="col-sm-12">';
		
								html += '<div class="panel panel-default">';
		
								html += '<div class="panel-heading"><b>'+data.review_data[count].user_name+'</b></div>';
		
								html += '<div class="panel-body">';
		
								for(var star = 1; star <= 5; star++)
								{
									var class_name = '';
		
									if(data.review_data[count].rating >= star)
									{
										class_name = 'text-warning';
									}
									else
									{
										class_name = 'star-light';
									}
		
									html += '<i class="material-icons-outlined '+class_name+' mr-1">star</i>';
								}
		
								html += '<br />';
		
								html += data.review_data[count].user_review;
		
								html += '</div>';
		
								html += '<div class="panel-footer text-right">On '+data.review_data[count].datetime+'</div>';
		
								html += '</div>';
		
								html += '</div>';
		
								html += '</div>';
							}
		
							$('#review_content').html(html);
						}
					}
				})
			}
		
		});	

        </script>

    </body>
</html>

