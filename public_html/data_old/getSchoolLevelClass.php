<?php
	require_once "../inc/config.php";
	include "../inc/constants.php";
	$id = $_POST['id']; 
	$leverArr = [];
	$classArr = []; 
	if(!is_numeric($id)){
		$schoolStmt = $mysqli->prepare("SELECT school_id FROM edu_school where school_name=?");
		$schoolStmt->bind_param("s", $id);
		$schoolStmt->execute();
		$schoolStmt->bind_result($school_id); 
		$schoolStmt->fetch();
		$schoolStmt->close();
		$id = $school_id;
	}
	if(!empty($id)){ 
		$classStmt = $mysqli->prepare("SELECT  el.level ,el.level_id  FROM edu_user_school_level_class as euslc left join edu_levels el on euslc.level_id = el.level_id  where euslc.school_id = ? GROUP BY el.level");
		$classStmt->bind_param("s",$id);
		$classStmt->execute();
		$result = $classStmt->get_result();
		while($row = $result->fetch_assoc()) {
		  $leverArr[] = array(
		    'level_name'=>$row['level'], 
		    'level_id'=>$row['level_id'], 
		  );
		}
		$classStmt->close();

		$classStmt = $mysqli->prepare("SELECT  ec.class_name ,ec.class_id  FROM edu_user_school_level_class as euslc left join edu_class ec on euslc.class_id = ec.class_id  where euslc.school_id = ? GROUP BY ec.class_name");
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
		$classStmt->close();  
	}
	$json['success'] = true;
	$json['school_level'] = $leverArr;
	$json['school_class'] = $classArr;
	echo json_encode($json);
?>