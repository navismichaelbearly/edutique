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
$sendQues = $_POST['sendQues'];
$art_id = $_POST['art_id'];
$act_id = $_POST['act_id'];
$ques_des = $_POST['ques_des'];
$mag_id = $_POST['mag_id'];

if($sendQues != '')
{
 
      $stmt = $mysqli->prepare("Select b.school_id, b.level_id, b.class_id  from edu_users a  inner join edu_user_school_level_class b on a.user_id= b.user_id where b.user_id=?");
		/* Bind parameters */
		$stmt->bind_param("s", $param_uid);
		/* Set parameters */
		$param_uid = $_SESSION["id"];
		$stmt->execute();
		$stmt->bind_result($school_id, $level_id, $class_id);
		$stmt->fetch();
		$stmt->close();
		
		$stmt = $mysqli->prepare("Select c.user_id from edu_users a inner join edu_utype b on a.user_type_id=b.user_type_id inner join edu_user_school_level_class c on a.user_id= c.user_id where c.school_id=? and c.level_id=? and c.class_id=? and b.utype_id=? ");
		/* Bind parameters */
		$stmt->bind_param("ssss", $param_school_id,$param_level_id,$param_class_id,$param_utype_id);
		/* Set parameters */
		$param_school_id = $school_id;
		$param_level_id =$level_id;
		$param_class_id =$class_id;
		$param_utype_id=2;
		$stmt->execute();
		$stmt->bind_result($user_idt);
		$stmt->fetch();
		$stmt->close();
	
	  $stmt = $mysqli->prepare("INSERT into edu_question_portal (content,status,qp_to,qp_by,publish_date,art_id, act_id,parent_qp_id,mag_id,qp_answered) 
	            	values(?,?,?,?,?,?,?,?,?,?)");	
	  $stmt->bind_param("ssssssssss", $param_content,$param_status,$param_qp_to,$param_qp_by,$param_publish_date,$param_art_id,$param_act_id,$param_parent_qp_id,$param_mag_id,$param_qp_answered);  
	  $param_content = $ques_des;	
	  $param_status = $active;	  
	  $param_qp_to = $user_idt;
	  $param_qp_by = $_SESSION['id'];
	  $param_publish_date = $todaysDate;
	  $param_art_id = $art_id;
	  $param_act_id = $act_id;
	  $param_mag_id = $mag_id;
	  $param_parent_qp_id = 0;
	  $param_qp_answered = '';
	  $stmt->execute();
	  $stmt->close();
 
				
}



?>
