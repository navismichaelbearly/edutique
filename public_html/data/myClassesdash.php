<?php
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";

$stmt = $mysqli->prepare("Select a.school_name, b.level, c.class_name, a.school_id, b.level_id, c.class_id  from edu_school a inner join edu_levels b on a.school_id= b.school_id inner join edu_class c on b.level_id= c.level_id inner join edu_school_subscription d on a.school_id= d.school_id where d.user_id=? and d.school_subscription_status=? group by d.user_id");
		/* Bind parameters */
		$stmt->bind_param("ss", $param_uid,$param_urstatus);
		/* Set parameters */
		$param_uid = $_SESSION["id"];
		$param_urstatus = $active;
		$stmt->execute();
		$stmt->bind_result($school_name, $level_name, $class_name, $school_id, $level_id, $class_id);
		$stmt->fetch();
		$stmt->close();
		
if($_POST['classInfo'] !="")	{	
$stmt = $mysqli->prepare("SELECT Distinct(b.level_id), level from edu_users a INNER JOIN edu_user_school_level_class b on a.user_id=b.user_id inner join edu_levels c on b.level_id=c.level_id where b.school_id=? and a.user_type_id=? ");
                $stmt->bind_param("ss", $param_school_id,$param_user_type_id);
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
                $stmt->execute();
                $result = $stmt->get_result();
                $sr = 1;
                    echo "<div class='row' >";
                    while ($row = $result->fetch_assoc()) {
                      $levelname = explode(" ",$row['level']);
                      echo "<div class='col-lg-3' align='center' style='border:4px solid #f1eded; margin:5px; padding:5px 5px 5px 5px; min-height:200px '><a href='my_classes.php'>Sec ".$levelname[1]."</a><br>
										";
                      $stmt1 = $mysqli->prepare("SELECT b.class_id, COUNT(b.user_id) AS userCount, class_name,c.class_id from edu_users a INNER JOIN edu_user_school_level_class b on a.user_id=b.user_id inner join edu_class c on b.class_id=c.class_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? group by b.class_id");
                      $stmt1->bind_param("ssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id);
					  $param_status =$active;
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
					  $param_level_id = $row['level_id'];
                      $stmt1->execute();
                      $result1 = $stmt1->get_result();
                      while ($row1 = $result1->fetch_assoc()) {
                      echo "<div><a href='class.php?classID=" . $row1['class_id'] . "'>" . $row1['class_name'] . "</a></div>";	
					   //echo "</tr>";
                      }
					  echo "
                </div>";
                    } 
                  		
		
}
?>
