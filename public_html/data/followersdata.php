<?php 
require_once "../inc/config.php";
	include "../inc/constants.php";
header('Content-Type: application/json');


//query to get data from the table
//$query = sprintf("SELECT userid, facebook, twitter, googleplus FROM followers");

		$user_status = $active;
$Stmt = $mysqli->prepare("SELECT b.user_id, mag_id   FROM edu_users a inner join edu_school_subscription b  on a.user_id = b.user_id where a.user_status=?  GROUP BY a.user_id, b.mag_id");
		$Stmt->bind_param("s",$user_status);
		$Stmt->execute();
		$result = $Stmt->get_result(); 
		$data = array();
		while($row = $result->fetch_assoc()) {
		  $data[] = $row;
		}


//now print the data
print json_encode($data);
?>