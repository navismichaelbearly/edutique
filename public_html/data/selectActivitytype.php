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


if($_POST['acttypeVar'] != '')
{
  if ($stmt = $mysqli->prepare("SELECT activity_type,activity_type_id from edu_activity_type where activity_type_status=?")) {
	
	
		
	 $stmt->bind_param("s", $param_status);
		 // Set parameters 
	 $param_status = $active;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($activity_type,$activity_type_id);
	 $sr =1;
	 echo "<select id='actType' name='actType' multiple>";
	 while ($stmt->fetch()) {
	     
	     echo  "<option value='".$activity_type."'>".$activity_type."</option>";
		
		 $sr++;
	 }
     echo "</select>";   	
	}
}




?>