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



if($_POST['essayVar'] != '')
{
  if ($stmt = $mysqli->prepare("SELECT essay_type from edu_essay_type where essay_type_status=?")) {
	
	
		
	 $stmt->bind_param("s", $param_status);
		 // Set parameters 
	 $param_status = $active;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($essay_type);
	 $sr =1;
	 echo  "<select id='essayType' name='essayType' multiple>
                                                            ";
	 while ($stmt->fetch()) {
	    
	     echo  "<option value='".$essay_type."'>".$essay_type."</option>";
                                                            
		
		 $sr++;
	 }
     echo "</select>";   	
	}
}




?>