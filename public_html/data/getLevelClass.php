<?php
	require_once "../inc/config.php";
	include "../inc/constants.php";
	$id = $_POST['level_id']; 
	$sid = $_POST['school_id']; 
	if(!is_numeric($sid)){
		$schoolStmt = $mysqli->prepare("SELECT school_id FROM edu_school where school_name=?");
		$schoolStmt->bind_param("s", $sid);
		$schoolStmt->execute();
		$schoolStmt->bind_result($school_id); 
		$schoolStmt->fetch();
		$schoolStmt->close();
		$sid = $school_id;
	}
	if(!is_numeric($id)){
		$schoolStmt = $mysqli->prepare("SELECT level_id FROM edu_levels where level=?");
		$schoolStmt->bind_param("s", $id);
		$schoolStmt->execute();
		$schoolStmt->bind_result($level_id); 
		$schoolStmt->fetch();
		$schoolStmt->close();
		$id = $level_id;
	}
	
	$leverArr = [];
	$classArr = [];
	if(!empty($id)){  
		$classStmt = $mysqli->prepare("SELECT  class_name ,class_id  FROM edu_class where school_id = ? AND level_id = ?");
		$classStmt->bind_param("ss",$sid,$id);
		$classStmt->execute();
		$result = $classStmt->get_result(); 
		$classArr = [];
		while($row = $result->fetch_assoc()) {
		  $classArr[] = array(
		    'class_name'=>$row['class_name'], 
		    'class_id'=>$row['class_id'], 
		  );
		}
		$classStmt->close();  
	}
	$json['success'] = true; 
	$json['class_data'] = $classArr;
	echo json_encode($json);
?>