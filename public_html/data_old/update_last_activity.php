<?php

//update_last_activity.php

require_once "../inc/config.php";
include "../inc/constants.php";

session_start();

/*$query = "
UPDATE login_details 
SET last_activity = now() 
WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";

$statement = $connect->prepare($query);

$statement->execute();*/

$stmt = $mysqli->prepare("UPDATE edu_login_details 
SET last_activity = ? 
WHERE login_details_id = ?");	
	  $stmt->bind_param("ss", $param_last_activity,$param_login_details_id);    
	  $param_last_activity = now() ;
	  $param_login_details_id =$_SESSION["login_details_id"];
	  $stmt->execute();
	  $stmt->close();

?>

