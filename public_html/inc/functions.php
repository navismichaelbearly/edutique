<?php
include "constants.php";
/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	header("location: ".$sysURLlocal."login.php");
    exit;
}
 
function sqlLoginsert($messagelog){
    require_once "config.php"; 
    include "constants.php";
    /* Attempt to connect to MySQL database */
    $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	$stmt2 = $mysqli->prepare("INSERT INTO edu_log (log_entry, log_entry_date, log_entry_status, user_id) VALUES (?, ?, ?, ?)");
	$stmt2->bind_param("ssss", $param_log_entry, $param_log_entry_date, $param_log_entry_status, $param_user_id);
    $param_log_entry = $messagelog;
	$param_log_entry_date = $todaysDate;
	$param_log_entry_status = $active;
	$param_user_id = $_SESSION["id"];
	return $stmt2->execute(); 
}




?>
