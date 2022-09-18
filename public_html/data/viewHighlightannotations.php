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
$art_id = $_POST['art_id'];
$act_id = $_POST['act_id'];
$highlightCommenttext= $_POST['highlightCommenttext'];
$mag_id = $_POST['mag_id'];
//$topStyle = !empty($_POST['top'])?$_POST['top']:'';





if($highlightCommenttext != '')
{
 	
	

$stmt = $mysqli->prepare("SELECT highlighted_text FROM  edu_annotation_comments where art_id=? and act_id=? and mag_id=? and anno_by=?");
/* Bind parameters */
$stmt->bind_param("ssss", $param_art_id, $param_act_id, $param_mag_id, $param_anno_by);
$param_art_id = $art_id;
$param_act_id = $act_id;
$param_mag_id = $mag_id;
$param_anno_by = $_SESSION['id'];
$stmt->execute();
$stmt->bind_result($highlighted_text);

while ($stmt->fetch()) {
//$highlighted_text1= preg_replace('/\s+/', '', $highlighted_text);
echo $highlighted_text."***";
}
$stmt->close();				
}

?>
