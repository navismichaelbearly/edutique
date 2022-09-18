<?php
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: login.php");
	exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";

$postClassData = $_POST['classDetails'];
$todaysDate = date("Y-m-d h:i:sa");

foreach ($postClassData as $classDetails) {

	$getUserIdSql = "SELECT  el.user_id  FROM edu_user_school_level_class  el
	 left join edu_users as eu on eu.user_id = el.user_id
	  where el.class_id= ? and el.level_id = ? and el.school_id = ?	";

	if ($stmt = $mysqli->prepare($getUserIdSql)) {

		// Set parameters 
		$param_level_id = $classDetails['levelId'];
		$param_classId = $classDetails['classId'];
		$param_school_id = $_POST['school'];
		$stmt->bind_param("sss", $param_classId, $param_level_id,$param_school_id);
		$stmt->execute();
		$stmt->bind_result($user_id);
		/* bind variables to prepared statement */
		$stmt->store_result();

		while ($stmt->fetch()) {
			if (trim($_POST["announcemenTitle"] != '')) {
				$insertSql = "INSERT INTO edu_noti (noti_title, noti_content,noti_published_date, noti_status,user_id, start_date,end_date,added_by) 
				VALUES(?,?,?,?,?,?,?,?)";
				$stmts = $mysqli->prepare($insertSql);

				$param_noti_title = addslashes($_POST["announcemenTitle"]);
				$param_noti_content = addslashes($_POST["announcemenDetail"]);
				$param_noti_published_date = $todaysDate;
				$param_noti_status = "Active";
				$param_user_id = $user_id;
				$param_start_date =  $_POST["startDate"];
				$param_end_date =  $_POST["endDate"];
				$param_added_by = $_SESSION["id"];
				$stmts->bind_param("ssssssss", $param_noti_title, $param_noti_content, $param_noti_published_date, $param_noti_status, $param_user_id,$param_start_date,$param_end_date,$param_added_by);
				$stmts->execute();
				$stmts->close();
			}
		}
	}
}

?>
