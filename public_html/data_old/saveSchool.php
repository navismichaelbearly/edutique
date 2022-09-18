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

$addSCH = !empty($_POST['addSCH'])?$_POST['addSCH']:0;
$editSCH = !empty($_POST['editSCH'])?$_POST['editSCH']:0;
// If form is submitted 
if($addSCH == 1){
	if(isset($_POST['school_name']) || isset($_POST['countryID']) || isset($_POST['postal_code']) || isset($_POST['school_address']) )
	{ 
		// Get the submitted form data 
		$school_name = $_POST['school_name']; 
		$countryID = $_POST['countryID']; 
		$postal_code = $_POST['postal_code']; 
		$school_address = $_POST['school_address']; 
		// Check whether submitted data is not empty 
		if(!empty($school_name) )
		{ 
		   $stmt = $mysqli->prepare("INSERT into edu_school (school_name,country_id,school_address,school_created_date,postal_code, school_status, school_created_by) 
									values(?,?,?,?,?,?,?)");
							$stmt->bind_param("sssssss", $param_school_name, $param_country_id,$param_school_address,$param_school_created_date,$param_postal_code,$param_school_status,$param_created_by);
							$param_school_name = $school_name;
							$param_country_id= $countryID;
							$param_school_address =$school_address;
							$param_school_created_date =$todaysDate;
							$param_postal_code = $postal_code;
							$param_school_status =	$active;
							$param_created_by = $admintitle;	
							  if($stmt->execute()){
							   
							  }
							  
							  $stmt->close(); 
			
			
		} 
	}	  
}

if($editSCH == 1){
	if(isset($_POST['school_nameE']) || isset($_POST['countryIDE']) || isset($_POST['postal_codeE']) || isset($_POST['school_addressE']) )
	{ 
		// Get the submitted form data 
		$school_name = $_POST['school_nameE']; 
		$countryID = $_POST['countryIDE']; 
		$postal_code = $_POST['postal_codeE']; 
		$school_address = $_POST['school_addressE']; 
		// Check whether submitted data is not empty 
		if(!empty($school_name) )
		{ 
		   $stmt = $mysqli->prepare("UPDATE edu_school SET school_name=?, country_id=?, school_address=?, postal_code=? where school_id=?");
							$stmt->bind_param("sssss", $param_school_name, $param_country_id,$param_school_address,$param_postal_code,$param_school_id);
							$param_school_name = $school_name;
							$param_country_id= $countryID;
							$param_school_address =$school_address;
							$param_postal_code = $postal_code;
							$param_school_id = $_POST['schoolID'];
							  if($stmt->execute()){
							   
							  }
							  
							  $stmt->close(); 
			
			
		} 
	}	  
}


?>