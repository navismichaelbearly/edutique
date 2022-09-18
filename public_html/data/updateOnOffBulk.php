<?php
require_once "../inc/config.php";
include "../inc/constants.php";

session_start();

// get post data
$rad1 = $_POST['rad01'];
$rad2 = $_POST['rad02'];
$rad3 = $_POST['rad03'];
$rad4 = $_POST['rad04'];
$rad5 = $_POST['rad05'];
$rad6 = $_POST['rad06'];
$rad7 = $_POST['rad07'];
$rad8 = $_POST['rad08'];
$show_school = $_POST['show_school1'];
$start_date = $_POST['start_date1'];
$end_date = $_POST['end_date1'];



 $stmt = $mysqli->prepare("SELECT id FROM edu_onoff_bulk WHERE school_id = ?");
		   /* Bind parameters */
		   $stmt->bind_param("s", $param_id);
		   /* Set parameters */
		   $param_username = show_school;
		   $stmt->execute();
		   $stmt->store_result();
		   $total_rows = $stmt->num_rows;
		   $stmt->bind_result($onoffid);
		   $stmt->fetch();


// if count is 0 then insert else update
if ($total_rows != 0) { 
    $sql = "UPDATE edu_onoff_bulk SET dashboard = ?, todolist = ?, calendar = ?, bookmarks = ?, wordbank = ?, resources = ?, progress = ?, logs= ?, start_date = ?, end_date = ? WHERE school_id = ?";
	
} else { 
    $sql = "INSERT INTO edu_onoff_bulk (dashboard, todolist, calendar, bookmarks, wordbank, resources, progress, logs,start_date, end_date,school_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
	
}
// execute query
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sssssssssss", $rad1,$rad2,$rad3,$rad4,$rad5,$rad6,$rad7,$rad8, $start_date,$end_date,$show_school);
if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt . "<br>" . $mysqli->error;
	
}
//$stmt->close();
