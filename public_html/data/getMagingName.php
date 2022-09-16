<?php
	require_once "../inc/config.php";
	include "../inc/constants.php";
	$id = $_POST['issueType'];  
	$magging = [];
	if(!empty($id)){  
		$classStmt = $mysqli->prepare("SELECT  mag_id ,mag_issue  FROM edu_magazine where mag_type_id = ?");
		$classStmt->bind_param("s",$id);
		$classStmt->execute();
		$result = $classStmt->get_result();  
		while($row = $result->fetch_assoc()) {
		  $magging[] = array(
		    'id'=>$row['mag_id'], 
		    'name'=>$row['mag_issue'], 
		  );
		}
		$classStmt->close();  
	}
	$json['success'] = true; 
	$json['magging'] = $magging;
	echo json_encode($json);
?>