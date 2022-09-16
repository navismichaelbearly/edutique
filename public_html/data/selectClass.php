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


if($_POST['schoolLevel'] != '')
{

	
	
	if ($stmt = $mysqli->prepare("SELECT class_id,class_name FROM edu_class where class_status=? and level_id=?")) {
    
												   $stmt->bind_param("ss", $param_status,$param_level_id);
												 // Set parameters 
												 $param_status = $active;
												 $param_level_id = $_POST['schoolLevel'];
												 
												 $stmt->execute();
												 /* bind variables to prepared statement */
												 $stmt->bind_result($class_id, $class_name);
												 $sr =1;
												 /* fetch values */
												echo "  <option>Select Class</option>";
												 while ($stmt->fetch()) {
													  		
													  echo " <option value='".$class_id."'>".$class_name."</option>";
												}
											 }		
}




?>