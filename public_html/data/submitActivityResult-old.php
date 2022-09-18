<?php
ini_set('memory_limit', '40M');
ini_set('max_execution_time', 80000);
ini_set('post_max_size', '40M');
ini_set('upload_max_filesize', '40M');
error_reporting(E_ERROR | E_PARSE);
session_start(); /*Session Start*/
/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: login.php");
	exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";
include '../inc/functions.php';



// if post of activity_type_id exists and is  equal to 8 
if (isset($_POST['activity_type_id']) ) {

	if ($_POST['activity_type_id'] == 8) {
		// get activity result array from post
		$activity_result = $_POST['activity_result'];
		// if activity result is an array, echo it
		$activity_result = json_decode($activity_result);
		// find length of activity result array
		$activity_result_length = count($activity_result);
		// loop from 1 to length of activity result array
		// get activty_html from post
		$total = $correct =  0;
		$ans_arr = array();
		for ($i = 1; $i <= $activity_result_length; $i++) {
			// from POST get sc i
			$sc = $_POST['sc' . $i];
			$check = str_replace(' ', '',  $activity_result[$i - 1]);
			if ($sc == $check) {
				$correct++;
			}
			$total++;
			// push sc i to ans_arr
			array_push($ans_arr, $sc);
		}


		//INSERT INTO `edu_activity_result`(`user_id`, `activity_id`, `total`, `correct`, `answer`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')
		$stmt = $mysqli->prepare("INSERT INTO `edu_activity_result`(`user_id`, `activity_id`, `total`, `correct`, `answer`) VALUES (?,?,?,?,?)");
		$stmt->bind_param("sssss", $param_user_id, $param_activity_id, $param_total, $param_correct, $param_answer);
		$param_user_id = $_POST['user_id'];
		$param_activity_id = $_POST['activity_id'];
		// Calculate the answers here
		$param_total = $total;
		$param_correct = $correct;
		$param_answer = json_encode($ans_arr);
		if ($stmt->execute()) {
			// $response['status'] = 1;
			// $response['message'] = 'Form data submitted successfully!';
			echo ("You got " . $correct . ' answers correct out of ' . $total);
		} else {
			// $response['status'] = 0;
			// $response['message'] = 'Something went wrong!';
		}
		$stmt->close();
		//echo json_encode($response);
	} else 	if ($_POST['activity_type_id'] == 3) {
		// get activity result array from post
		$activity_result = $_POST['activity_result'];
		// if activity result is an array, echo it
		$activity_result = json_decode($activity_result);
		// find length of activity result array
		$activity_result_length = count($activity_result);
		// loop from 1 to length of activity result array
		// get activty_html from post
		$total = $correct =  0;
		$ans_arr = array();
		for ($i = 1; $i <= $activity_result_length; $i++) {
			// from POST get sc i
			$sc = $_POST['cmp' . $i];
			$total++;
			// push sc i to ans_arr
			array_push($ans_arr, $sc);
		}


		//INSERT INTO `edu_activity_result`(`user_id`, `activity_id`, `total`, `correct`, `answer`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]')
		$stmt = $mysqli->prepare("INSERT INTO `edu_activity_result`(`user_id`, `activity_id`, `total`, `correct`, `answer`) VALUES (?,?,?,?,?)");
		$stmt->bind_param("sssss", $param_user_id, $param_activity_id, $param_total, $param_correct, $param_answer);
		$param_user_id = $_POST['user_id'];
		$param_activity_id = $_POST['activity_id'];
		// Calculate the answers here
		$param_total = $total;
		$param_correct = 0;
		$param_answer = json_encode($ans_arr);
		if ($stmt->execute()) {
			// $response['status'] = 1;
			// $response['message'] = 'Form data submitted successfully!';
			echo ("You have successfully submitted your answers.");
		} else {
			// $response['status'] = 0;
			// $response['message'] = 'Something went wrong!';
		}
		$stmt->close();
		//echo json_encode($response);
	} 
	else if ($_POST['activity_type_id'] == 7) {

		$activity_result = $_POST['comp'];
		// if activity result is an array, echo it
		//$activity_result = json_decode($activity_result);
		$stmt = $mysqli->prepare("INSERT INTO `edu_activity_result`(`user_id`, `activity_id`, `total`, `correct`, `answer`) VALUES (?,?,?,?,?)");
		$stmt->bind_param("sssss", $param_user_id, $param_activity_id, $param_total, $param_correct, $param_answer);
		$param_user_id = $_POST['user_id'];
		$param_activity_id = $_POST['activity_id'];
		// Calculate the answers here
		$param_total = 0;
		$param_correct = 0;
		$param_answer = $activity_result;
		if ($stmt->execute()) {
			// $response['status'] = 1;
			// $response['message'] = 'Form data submitted successfully!';
			echo ("You have successfully submitted your answers.");
		} else {
			// $response['status'] = 0;
			echo 'Something went wrong!';
		}
		$stmt->close();
		

	} else echo("sss");
}

?>
