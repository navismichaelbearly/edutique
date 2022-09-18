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

    
	$number = count($_POST["levelname"]);
	
	for($i=0; $i<$number; $i++)
		{
			if(trim($_POST["levelname"][$i] != ''))
			{
				$stmt = $mysqli->prepare("INSERT INTO edu_noti (noti_title, noti_content,noti_published_date, noti_status,user_id) 
			  VALUES(?, ?,?,?,?)");	
		  $stmt->bind_param("sssss", $param_noti_title,$param_noti_content,$param_noti_published_date,$param_noti_status,$param_school_id);
		  //$param_faq_type = $_POST["faqfor"][$i];	  
		  $param_noti_title = $_POST["announcemenTitle"];
					 $param_noti_content = $_POST["announcemenDetail"];
					 $param_noti_published_date = $todaysDate;
					 $param_noti_status = $active;
				    $param_school_id = 23;
				    $param_level_id = $_POST['levelname'][$i];
		  $stmt->execute();
		  $stmt->close();
			}
		}
	//echo "Data Inserted";
	
	

?>
