<?php
error_reporting(-1);
ini_set('display_errors', true);
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";

if(isset($_POST["ref_ques_response"]))
{

	$stmt = $mysqli->prepare("SELECT school_id,level_id,class_id FROM  edu_user_school_level_class  WHERE user_id = ? ");
	/* Bind parameters */
	$stmt->bind_param("s", $param_user_id);
	/* Set parameters */
	$param_user_id = $_SESSION["id"];
	$stmt->execute();
	$stmt->bind_result($school_id,$level_id,$class_id);
	$stmt->fetch();
	$stmt->close();
	
	$stmt = $mysqli->prepare("SELECT a.user_id FROM  edu_user_school_level_class a inner join edu_users b on a.user_id=b.user_id  WHERE school_id =? and level_id=? and class_id=? and user_type_id=?");
	/* Bind parameters */
	$stmt->bind_param("ssss", $param_school_id,$param_level_id,$param_class_id,$param_user_type_id);
	/* Set parameters */
	$param_school_id = $school_id;
	$param_level_id =$level_id;
	$param_class_id = $class_id;
	$param_user_type_id = 2;
	$stmt->execute();
	$stmt->bind_result($user_id);
	$stmt->fetch();
	$stmt->close();

	$insertSql = "
	INSERT INTO edu_reflection 
	(ques, response, mag_id, art_id, act_id,stud_id,teach_id, school_id, level_id,class_id,submitted_on ) 
	VALUES (?, ?, ?, ?,?,?,?,?,?,?,?)
	";

	$stmts = $mysqli->prepare($insertSql);
    $stmts->bind_param("sssssssssss", $param_ques, $param_response, $param_mag_id, $param_art_id, $param_act_id, $param_stud_id, $param_teach_id, $param_school_id, $param_level_id, $param_class_id, $param_submitted_on);
	
				$param_ques = $_POST["reflection_ques"];
				$param_response = $_POST["ref_ques_response"];
				$param_mag_id = $_POST["magazineID"];
				$param_art_id = $_POST["art_id"];
				$param_act_id = $_POST["act_id"];
				$param_stud_id = $_SESSION["id"];
				$param_teach_id = $user_id;
				$param_school_id = $school_id;
				$param_level_id =$level_id;
				$param_class_id = $class_id;
				$param_submitted_on = $todaysDate;
				$stmts->execute();
				$stmts->close();

	//echo "Your Review & Rating Successfully Submitted";

}



?>