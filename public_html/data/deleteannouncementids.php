<?php
	//submit_rating.php

error_reporting(-1);
ini_set('display_errors', true);
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";
// echo post data

	if(isset($_POST['id'])) {
		$id = trim($_POST['id']);
		echo $id;
		//$count = count($id);
        //$placeholders = implode(',', array_fill(0, $count, '?'));
		//$sql = "DELETE FROM edu_noti WHERE noti_id in ($id)";

		// fetch notifications where id in ($id)
		$stmt = $mysqli->prepare("SELECT * FROM edu_noti WHERE noti_id in (?) limit 1");
		$stmt->bind_param("s", $id);
		$stmt->execute();
		// save result in $ val

		$result = $stmt->get_result();
		$val = [];
		while ($data = $result->fetch_assoc()) {
			$val[] = $data;	
		}
		$stmt->close();

		// select all noti_id where noti_content = $result[0]['noti_content']
		$stmt = $mysqli->prepare("SELECT noti_id FROM edu_noti WHERE noti_content = ?");
		$stmt->bind_param("s", $val[0]['noti_content']);
		$stmt->execute();
		$result = $stmt->get_result();
		$val = [];
		while ($data = $result->fetch_assoc()) {
			$val[] = $data;	
		}
		$stmt->close();

		// delete all noti_id where noti_id = result
		// for each result, delete all noti_id where noti_id = result
		// con array val to string
	

		foreach ($val as $key => $value) {
			$stmt = $mysqli->prepare("DELETE FROM edu_noti WHERE noti_id = ?");
			$stmt->bind_param("s", $value['noti_id']);
			$stmt->execute();
			$stmt->close();
			//echo $value['noti_id'];
		}
		//}
	}
?>
