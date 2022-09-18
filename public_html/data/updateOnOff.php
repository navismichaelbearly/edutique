<?php
require_once "../inc/config.php";
include "../inc/constants.php";

session_start();


//print_r post data
// print_r($_POST);
// exit();

// get post data
$rad1 = $_POST['rad1'];
$rad2 = $_POST['rad2'];
$rad3 = $_POST['rad3'];
$rad4 = $_POST['rad4'];
$rad5 = $_POST['rad5'];
$rad6 = $_POST['rad6'];
$no_of_attempts = $_POST['no_of_attempts'];
$show_school = $_POST['show_school'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

// select id from edu_onoff where school_id = $show_school
$sql = "SELECT id FROM edu_onoff WHERE school_id = $show_school";
$result = $mysqli->query($sql);
// get count of id
$count = $result->num_rows;
// if count is 0 then insert else update
if ($count != 0) {
	$sql = "UPDATE edu_onoff SET lock_enable = $rad1, content_aid = $rad2, receive_questions = $rad3, unlimited_attempts = $rad4, hide_suggested_answers = $rad5, peer_review = $rad6, attempts = $no_of_attempts, start_date = '$start_date', end_date = '$end_date' WHERE school_id = $show_school";
} else {
	$sql = "INSERT INTO edu_onoff (`school_id`, `lock_enable`, `content_aid`, `receive_questions`, `unlimited_attempts`, `hide_suggested_answers`, `peer_review`, `attempts`,`start_date`, `end_date`) VALUES ($show_school, $rad1, $rad2, $rad3, $rad4, $rad5, $rad6, $no_of_attempts,  '$start_date', '$end_date')";
}
// execute query
$stmt = $mysqli->prepare($sql);
if ($stmt->execute()) {
	echo "New record created successfully";
} else {
	echo "Error: " . $stmt . "<br>" . $mysqli->error;
}
//$stmt->close();
