<?php
require_once "../inc/config.php";
include "../inc/constants.php";

session_start();

/*$query = "
UPDATE login_details 
SET is_type = '".$_POST["is_type"]."' 
WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";

$statement = $connect->prepare($query);

$statement->execute();*/

$stmt = $mysqli->prepare("UPDATE edu_login_details 
SET is_type = ?
WHERE login_details_id = ?");	
	  $stmt->bind_param("ss", $param_is_type,$param_login_details_id);    
	  $param_is_type = $_POST["is_type"];
	  $param_login_details_id =$_SESSION["login_details_id"];
	  $stmt->execute();
	  $stmt->close();

?>