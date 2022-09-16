<?php
ini_set('memory_limit', '40M'); 
ini_set('max_execution_time', 80000); 
ini_set('post_max_size', '40M'); 
ini_set('upload_max_filesize', '40M');

session_start(); /*Session Start*/
/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";
include '../inc/functions.php';

 
/*$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); */


// If form is submitted 
if(isset($_POST['situationalWrite']) )
{ 
    // Get the submitted form data 
    $situationalWrite = $_POST['situationalWrite'];
	//$newDate = date("Y-m-d", strtotime($art_year));	
    
    // Check whether submitted data is not empty 
    if(!empty($situationalWrite) )
	{ 
	   
       $stmt = $mysqli->prepare("SELECT b.school_id FROM  edu_users a inner join edu_user_school_level_class b on a.user_id  = b.user_id  WHERE a.user_id = ? and a.user_status = ?");
		/* Bind parameters */
		$stmt->bind_param("ss", $param_uid,$param_urstatus);
		/* Set parameters */
		$param_uid = $_SESSION["id"];
		$param_urstatus = $active;
		$stmt->execute();
		$stmt->bind_result($school_id);
		$stmt->fetch();
		$stmt->close();
		
		$stmt = $mysqli->prepare("INSERT into edu_activity_result (user_id,activity_id,total, answer) 
						values(?,?,?,?)");
			$stmt->bind_param("ssss", $param_user_id, $param_activity_id, $param_total, $param_answer);
			$param_user_id = $_SESSION['id'];
			$param_activity_id= $_POST['activityId'];
			$param_total =$_POST['marks'];
			$param_answer =$situationalWrite;
			$stmt->execute();
			
			 $stmt = $mysqli->prepare("UPDATE edu_user_task as UE  
			INNER JOIN edu_task As ED 
				ON UE.task_id = ED.task_id SET task_stages  = ?, completed_date=? WHERE article_id = ? and school_id = ? and assigned_to = ? and mag_id = ? and activity_id=?");	
			  $stmt->bind_param("sssssss", $param_task_stages,$param_completed_date,$param_article_id,$param_school_id,$param_assigned_to, $param_mag_id, $param_activity_id);    
			  $param_task_stages = $completed;
			  $param_completed_date = $todaysDate;
			  $param_article_id = $_POST["articleId"];
			  $param_school_id = $school_id; 
			  $param_assigned_to = $_SESSION["id"];
			  $param_mag_id = $_POST["magId"];
			  $param_activity_id = $_POST['activityId'];
			  $stmt->execute();
			  $stmt->close();
			
			 $stmt2 = $mysqli->prepare("Select school_id,level_id,class_id,first_name, last_name from edu_users a INNER JOIN edu_user_school_level_class b on a.user_id=b.user_id where a.user_status=? and a.user_id=?");
						$stmt2->bind_param("ss", $param_status,$param_user_id);
					    $param_status =$active;
					    $param_user_id=$_SESSION['id'];
						$stmt2->execute();
						$result2 = $stmt2->get_result();
                        $row2 = $result2->fetch_assoc();  
		
        $stmt3 = $mysqli->prepare("Select a.user_id from edu_users a INNER JOIN edu_user_school_level_class b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=?");
						$stmt3->bind_param("sssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id);
					    $param_status =$active;
					    $param_school_id=$row2['school_id'];
					    $param_user_type_id=10;
					    $param_level_id = $row2['level_id'];
					    $param_class_id = $row2['class_id'];
						$stmt3->execute();
						$result3 = $stmt3->get_result();
                        $row3 = $result3->fetch_assoc();  
			
	   $stmt4 = $mysqli->prepare("Select a.user_id from edu_users a INNER JOIN edu_user_school_level_class b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=?");
						$stmt4->bind_param("sssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id);
					    $param_status =$active;
					    $param_school_id=$row2['school_id'];
					    $param_user_type_id=2;
					    $param_level_id = $row2['level_id'];
					    $param_class_id = $row2['class_id'];
						$stmt4->execute();
						$result4 = $stmt4->get_result();
                        $row4 = $result4->fetch_assoc();  	
		
		$stmt = $mysqli->prepare("INSERT into edu_noti (noti_title, noti_published_date,user_id, noti_status,  	added_by, article_id,activity_id,mag_id) 
						values(?,?,?,?,?,?,?,?)");
			$stmt->bind_param("ssssssss", $param_noti_title, $param_noti_published_date, $param_user_id, $param_noti_status, $param_added_by, $param_article_id,$param_activity_id,$param_mag_id);
			$param_noti_title ="Activity Submitted by ".$row2['first_name'] . " ".$row2['last_name'] ; 
			$param_noti_published_date= $todaysDate; 
			$param_user_id = $row3['user_id']; 
			$param_noti_status = $active;
			$param_added_by = $_SESSION['id'];
			$param_article_id=$_POST['articleId'];
			$param_activity_id=$_POST['activityId'];
			$param_mag_id=$_POST['magId'];
			
			$stmt->execute();
			
		$stmt = $mysqli->prepare("INSERT into edu_noti (noti_title, noti_published_date,user_id, noti_status,  	added_by, article_id,activity_id,mag_id) 
						values(?,?,?,?,?,?,?,?)");
			$stmt->bind_param("ssssssss", $param_noti_title, $param_noti_published_date, $param_user_id, $param_noti_status, $param_added_by, $param_article_id,$param_activity_id,$param_mag_id);
			$param_noti_title ="Activity Submitted by ".$row2['first_name'] . " ".$row2['last_name'] ; 
			$param_noti_published_date= $todaysDate; 
			$param_user_id = $row4['user_id']; 
			$param_noti_status = $active;
			$param_added_by = $_SESSION['id'];
			
			$param_article_id=$_POST['articleId'];
			$param_activity_id=$_POST['activityId'];
			$param_mag_id=$_POST['magId'];
			
			$stmt->execute();	
		
    } 
}


 
// Return response 
//echo json_encode();
?>
