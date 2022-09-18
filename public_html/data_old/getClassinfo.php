<?php
	require_once "../inc/config.php";
	include "../inc/constants.php";
	$id = $_POST['id'];
	if(!empty($id)){ 
		$classStmt = $mysqli->prepare("SELECT  ec.class_name ,ec.class_id  FROM edu_user_school_level_class as euslc left join edu_class ec on euslc.class_id = ec.class_id where euslc.school_id=?  GROUP BY ec.class_name");
		$classStmt->bind_param("s",$id);
		$classStmt->execute();
		$result = $classStmt->get_result(); 
		$classArr = [];
		while($row = $result->fetch_assoc()) {
		  $classArr[] = array(
		    'class_name'=>$row['class_name'], 
		    'class_id'=>$row['class_id'], 
		  );
		}
	}
	$json['success'] = true;
	$json['data'] = $classArr;
	echo json_encode($json);
?>