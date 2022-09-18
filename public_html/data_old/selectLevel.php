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


if($_POST['schoolNames'] != '')
{

	$stmt = $mysqli->prepare("SELECT school_id FROM edu_school where school_status=? and school_name=?");
	/* Bind parameters */
	$stmt->bind_param("ss", $param_school_status,$param_school_name);
	/* Set parameters */
	
	$param_school_status = $active;
	$param_school_name = $_POST['schoolNames'];
	$stmt->execute();
	$stmt->bind_result($school_id);
	$stmt->fetch();
	$stmt->close();
	
	if ($stmt = $mysqli->prepare("SELECT level_id,level FROM edu_levels where level_status=? and school_id=?")) {
		
		$stmt->bind_param("ss", $param_status,$param_school_id);
		// Set parameters 
		$param_status = $active;
		$param_school_id=$school_id;
													 
		$stmt->execute();
		/* bind variables to prepared statement */
		$stmt->bind_result($level_id, $level);
		$sr =1;
		/* fetch values */
		echo " <option style='font-family:Arial, Helvetica, sans-serif !important;'>Select Level</option>";
		while ($stmt->fetch()) {
																
			echo " <option style='font-family:Arial, Helvetica, sans-serif !important;' value='".$level_id."'>".$level."</option>";
		}
	}	
}




?>