<?php
session_start(); /*Session Start*/
/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
}


/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";
include '../inc/functions.php';

/* posted variables from Ajax call */
$textHighlight = $_POST['textHighlight'];
$art_id = $_POST['art_id'];
$act_id = $_POST['act_id'];
$selText = $_POST['selText'];
$highlightTextview = $_POST['highlightTextview'];
$mag_id = $_POST['mag_id'];
if($textHighlight != '')
{
 

	
	  $stmt = $mysqli->prepare("INSERT into edu_annotation_text_highlight (status,anno_by,published_date,art_id, act_id, highlighted_text,mag_id,highlight_color ) 
	            	values(?,?,?,?,?,?,?,?)");	
	  $stmt->bind_param("ssssssss", $param_status,$param_anno_by,$param_published_date,$param_art_id,$param_act_id,$param_highlighted_text,$param_mag_id,$param_highlight_color);  
	  
	  $param_status = $active;	  
	  $param_anno_by = $_SESSION['id'];
	  $param_published_date = $todaysDate;
	  $param_art_id = $art_id;
	  $param_act_id = $act_id;
	  $param_highlighted_text = $selText;
	  $param_mag_id = $mag_id;
	  $param_highlight_color = $_POST['clr'];
	  $stmt->execute();
	  $stmt->close();
 
				
}
else{
     
}

if($highlightTextview != '')
{
 	
	

$stmt = $mysqli->prepare("SELECT highlighted_text, highlight_color FROM  edu_annotation_text_highlight where anno_by=? and status=?");
$stmt->bind_param("ss", $param_anno_by,$param_status);  
$param_anno_by = $_SESSION['id'];	  
$param_status = $active;	  
$stmt->execute();
$stmt->bind_result($highlighted_text, $highlight_color);
$sr =1;
while ($stmt->fetch()) {
	//$highlighted_text1= preg_replace('/\s+/', '', $highlighted_text);
	echo $highlighted_text."***".$highlight_color."***";
	
	
	$sr++;
 }
$stmt->close();				
}
?>
