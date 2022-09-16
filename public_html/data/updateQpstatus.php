<?php

//update_is_type_status.php

require_once "../inc/config.php";
include "../inc/constants.php";

session_start();

/*$query = "
UPDATE login_details 
SET is_type = '".$_POST["is_type"]."' 
WHERE login_details_id = '".$_SESSION["login_details_id"]."'
";

$statement = $connect->prepare($query);

$statement->execute();*/
if($_POST['qpStatusval'] != ''){
$stmt = $mysqli->prepare("UPDATE edu_question_portal 
SET qp_answered = ?
WHERE id = ?");	
	  $stmt->bind_param("ss", $param_qp_answered,$param_qpid);    
	  $param_qp_answered = $_POST["qpStatusval"];
	  $param_qpid =$_POST['qpStatuschange'];
	  if($stmt->execute()){
	     
	  }
	  $stmt->close();
}


?>