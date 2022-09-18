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
$stmt = $mysqli->prepare("Select a.school_name, b.level, c.class_name, a.school_id, b.level_id, c.class_id  from edu_school a inner join edu_levels b on a.school_id= b.school_id inner join edu_class c on b.level_id= c.level_id inner join edu_school_subscription d on a.school_id= d.school_id where d.user_id=? and d.school_subscription_status=? group by d.user_id");
		/* Bind parameters */
		$stmt->bind_param("ss", $param_uid,$param_urstatus);
		/* Set parameters */
		$param_uid = $_SESSION["id"];
		$param_urstatus = $active;
		$stmt->execute();
		$stmt->bind_result($school_name, $level_name, $class_name, $school_id, $level_id, $class_id);
		$stmt->fetch();
		$stmt->close();

	    $number = count($_POST["users"]);
	
	for($i=0; $i<$number; $i++)
		{
		   echo $_POST["users"][$i]."<br>";
		    echo $_POST["dueon"]."<br>";echo $_POST["levelname"]."<br>";echo $_POST["classname"]."<br>";
			if(trim($_POST["users"][$i] != ''))
			{
			    $var= explode("_",$_POST["artactid"]);
				$stmt = $mysqli->prepare("INSERT into edu_user_task (article_id ,activity_id,mag_id ,published_date,due_date,assigned_to,assigned_by,school_id,level_id,class_id,task_stages ,task_status,peer_id) 
						values(?,?,?,?,?,?,?,?,?,?,?,?,?)");	
		  $stmt->bind_param("sssssssssssss", $param_article_id,$param_activity_id,$param_mag_id,$param_published_date,$param_due_date,$param_assigned_to,$param_assigned_by,$param_school_id,$param_level_id,$param_class_id,$param_task_stages,$param_task_status,$param_peer_id);  
		  $param_article_id = $var[0];	  
		  $param_activity_id = $var[1];
		  $param_mag_id = $var[2];
		  $param_published_date = $todaysDate;
		  $param_due_date = $_POST["dueon"];
		  $param_assigned_to =  $_POST["users"][$i];
		  $param_assigned_by =  $_SESSION["id"];
		  $param_school_id = $school_id;
		  $param_level_id = $_POST["levelname"];
		  $param_class_id = $_POST["classname"];
		  $param_task_stages = $unopened;
		  $param_task_status = $active;
		  $param_peer_id = '';
		  $stmt->execute();
		  $stmt->close();
			}
		}
	//echo "Data Inserted";

?>
