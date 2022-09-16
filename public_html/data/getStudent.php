<?php
	require_once "../inc/config.php";
	include "../inc/constants.php";
	$id = $_POST['id'];
	if(!empty($id)){ 
		$classStmt = $mysqli->prepare("SELECT  el.first_name,el.last_name ,el.user_id  FROM edu_user_school_level_class as euslc left join edu_users el on euslc.user_id = el.user_id  where euslc.class_id = ? AND el.user_type_id=3");
		$classStmt->bind_param("s",$id);
		$classStmt->execute();
		$result = $classStmt->get_result(); 
		$classArr = [];
		while($row = $result->fetch_assoc()) {
		  $classArr[] = array(
		    'user_name'=>$row['first_name'].' '.$row['last_name'], 
		    'user_id'=>$row['user_id'], 
		  );
		}
	}
	$json['success'] = true;
	$json['data'] = $classArr;
	echo json_encode($json);
?>