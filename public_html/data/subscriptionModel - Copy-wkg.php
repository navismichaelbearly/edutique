<?php
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: login.php");
  exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";
$mag_type_var = !empty($_POST['mag_type_var']) ? $_POST['mag_type_var'] : '';
$addUSR = !empty($_POST['addUSR'])?$_POST['addUSR']:0;


if ($mag_type_var != '') {
  $stmt = $mysqli->prepare("SELECT mag_issue, mag_type,a.mag_id FROM edu_magazine a inner join edu_mag_type b on a.mag_type_id=b.mag_type_id where mag_status=? and a.mag_type_id=?");
  /* Bind parameters */
  $stmt->bind_param("ss", $param_status, $param_mag_type_id);
  /* Set parameters */

  $param_status = $active;
  $param_mag_type_id = $mag_type_var;
  $stmt->execute();
  $stmt->bind_result($mag_issue, $mag_type, $mag_id);
  $issue_no = $_POST['issue_no'] ?? '';
  $sr = 1;
  
  echo "<select id='issue_no' name='issue_no' class='form-control formfield'>";
  echo "<option style='font-family: Poppins !important;' value=''  >Select Issue</option>";
  // fetch values 
  while ($stmt->fetch()) {
    $mag_issue_type = $mag_type . " " . $mag_issue;
    echo "<option style='font-family: Poppins !important;' value='" . $mag_id . "' " . (($mag_issue_type == $issue_no) ? 'selected="selected"' : "") . ">" . $mag_issue_type . "</option>";


    $sr++;
  }
  echo "</select>
  

  
  ";
}

$issue_no = $_POST['issue_no'] ?? '';
$activity_type_id = $_POST['activity_type_id'] ?? '';
$text_type = $_POST['text_type'] ?? '';

if($addUSR > 0)
{ 
	  if(isset($_POST['schoolIDs']) || isset($_POST['mag_type']) ||  isset($_POST['classIDE'])  || isset($_POST['levelIDE'])  || isset($_POST['startDate'])  || isset($_POST['endDate']))
		{ 
			// Get the submitted form data 
			 $schoolIDs = $_POST['schoolIDs']; 
			$mag_type = $_POST['mag_type']; 
			//$issue_no = $_POST['issue_no'];
			$classIDE = $_POST['classIDE'];
			$levelIDE = $_POST['levelIDE'];
			$startDate = $_POST['startDate'];
			$endDate = $_POST['endDate'];
			
			if(!empty($issue_no) && (empty($text_type) && empty($activity_type_id))){ 
			    $eduUserStmt = $mysqli->prepare("SELECT  a.user_id, b.user_type_id  FROM edu_user_school_level_class a inner join edu_users b on a.user_id=b.user_id where school_id = ? and level_id=? and class_id=?");
				$eduUserStmt->bind_param("sss",$schoolIDs,$levelIDE,$classIDE);
				$eduUserStmt->execute();
				$resultUsers = $eduUserStmt->get_result();
				$eduUserStmt->close(); 
				if($resultUsers->num_rows > 0){
						while($rowUsers = $resultUsers->fetch_assoc()) {
							  $userID = $rowUsers['user_id'];
							$usertypeID = $rowUsers['user_type_id'];
							
								$eduArticalStmt = $mysqli->prepare("SELECT  article_id  FROM edu_article where mag_id = ?");
								$eduArticalStmt->bind_param("s",$issue_no);
								$eduArticalStmt->execute();
								$result = $eduArticalStmt->get_result();
								$eduArticalStmt->close(); 
				
								if($result->num_rows > 0){
									while($row = $result->fetch_assoc()) {
										 $articalId = $row['article_id'];
										$activityId = 0;
										subscribeDataInsert($mysqli,$articalId,$issue_no,$userID,$schoolIDs,$activityId,$levelIDE,$classIDE,$usertypeID);
									}
								}

								$eduActivityStmt = $mysqli->prepare("SELECT  activity_id,article_id  FROM edu_activity where mag_id = ?");
								$eduActivityStmt->bind_param("s",$issue_no);
								$eduActivityStmt->execute();
								$result = $eduActivityStmt->get_result();
								$eduActivityStmt->close(); 
								
								if($result->num_rows > 0){
									while($row = $result->fetch_assoc()) {
										$articalId = $row['article_id'];
										$activityId = $row['activity_id'];
										subscribeDataInsert($mysqli,$articalId,$issue_no,$userID,$schoolIDs,$activityId,$levelIDE,$classIDE,$usertypeID);
									}
								}
						}
					}			
		   }
		   //------------ subscribe by article---------------------------------------------
		    
		   if(!empty($text_type) && (empty($issue_no) && empty($activity_type_id))){   echo $text_type;   
	   
			    $eduUserStmt = $mysqli->prepare("SELECT  a.user_id, b.user_type_id  FROM edu_user_school_level_class a inner join edu_users b on a.user_id=b.user_id where school_id = ? and level_id=? and class_id=?");
				$eduUserStmt->bind_param("sss",$schoolIDs,$levelIDE,$classIDE);
				$eduUserStmt->execute();
				$resultUsers = $eduUserStmt->get_result();
				$eduUserStmt->close(); 
				if($resultUsers->num_rows > 0){
						while($rowUsers = $resultUsers->fetch_assoc()) {
							  $userID = $rowUsers['user_id'];
							$usertypeID = $rowUsers['user_type_id'];
							
								$eduArticalStmt = $mysqli->prepare("SELECT  article_id,a.mag_id  FROM edu_article a inner join edu_magazine b on a.mag_id=b.mag_id where essay_type_id = ? and b.mag_type_id=?");
								$eduArticalStmt->bind_param("ss",$text_type, $mag_type);
								$eduArticalStmt->execute();
								$result = $eduArticalStmt->get_result();
								$eduArticalStmt->close(); 
				
								if($result->num_rows > 0){
									while($row = $result->fetch_assoc()) {
										 $articalId = $row['article_id'];
										$activityId = 0;
										$issue_no = $row['mag_id'];
										subscribeDataInsert($mysqli,$articalId,$issue_no,$userID,$schoolIDs,$activityId,$levelIDE,$classIDE,$usertypeID);
									}
								}

								$eduActivityStmt = $mysqli->prepare("SELECT  activity_id,a.article_id,a.mag_id  FROM edu_activity a inner join edu_magazine b on a.mag_id=b.mag_id INNER JOIN edu_article c on a.article_id=c.article_id where b.mag_type_id=? and c.essay_type_id= ?");
								$eduActivityStmt->bind_param("ss",$mag_type,$text_type);
								$eduActivityStmt->execute();
								$result = $eduActivityStmt->get_result();
								$eduActivityStmt->close(); 
								
								if($result->num_rows > 0){
									while($row = $result->fetch_assoc()) {
										$articalId = $row['article_id'];
										$activityId = $row['activity_id'];
										$issue_no = $row['mag_id'];
										subscribeDataInsert($mysqli,$articalId,$issue_no,$userID,$schoolIDs,$activityId,$levelIDE,$classIDE,$usertypeID);
									}
								}
						}
					}			
		   }
		   //------------------------- subscribe by activity -------------------
		   if(!empty($activity_type_id) && (empty($issue_no) && empty($text_type))){     
	   
			    $eduUserStmt = $mysqli->prepare("SELECT  a.user_id, b.user_type_id  FROM edu_user_school_level_class a inner join edu_users b on a.user_id=b.user_id where school_id = ? and level_id=? and class_id=?");
				$eduUserStmt->bind_param("sss",$schoolIDs,$levelIDE,$classIDE);
				$eduUserStmt->execute();
				$resultUsers = $eduUserStmt->get_result();
				$eduUserStmt->close(); 
				if($resultUsers->num_rows > 0){
						while($rowUsers = $resultUsers->fetch_assoc()) {
							  $userID = $rowUsers['user_id'];
							$usertypeID = $rowUsers['user_type_id'];
							
								$eduArticalStmt = $mysqli->prepare("SELECT  a.article_id,a.mag_id  FROM edu_article a inner join edu_magazine b on a.mag_id=b.mag_id INNER JOIN edu_activity c on a.article_id=c.article_id where activity_type_id = ? and b.mag_type_id=?");
								$eduArticalStmt->bind_param("ss",$activity_type_id, $mag_type);
								$eduArticalStmt->execute();
								$result = $eduArticalStmt->get_result();
								$eduArticalStmt->close(); 
				
								if($result->num_rows > 0){
									while($row = $result->fetch_assoc()) {
										 $articalId = $row['article_id'];
										$activityId = 0;
										$issue_no = $row['mag_id'];
										subscribeDataInsert($mysqli,$articalId,$issue_no,$userID,$schoolIDs,$activityId,$levelIDE,$classIDE,$usertypeID);
									}
								}

								$eduActivityStmt = $mysqli->prepare("SELECT  activity_id,a.article_id,a.mag_id  FROM edu_activity a inner join edu_magazine b on a.mag_id=b.mag_id  where b.mag_type_id=? and a.activity_type_id= ?");
								$eduActivityStmt->bind_param("ss",$mag_type,$activity_type_id);
								$eduActivityStmt->execute();
								$result = $eduActivityStmt->get_result();
								$eduActivityStmt->close(); 
								
								if($result->num_rows > 0){
									while($row = $result->fetch_assoc()) {
										$articalId = $row['article_id'];
										$activityId = $row['activity_id'];
										$issue_no = $row['mag_id'];
										subscribeDataInsert($mysqli,$articalId,$issue_no,$userID,$schoolIDs,$activityId,$levelIDE,$classIDE,$usertypeID);
									}
								}
						}
					}			
		   }
		   //-------------------------------
			
	}
	
	
}
function subscribeDataInsert($mysqli,$articalId,$issue_no,$userID,$schoolIDs,$activityId,$levelIDE,$classIDE,$usertypeID){
 		 $startDate = $_POST['startDate'];
 		 $endDate = $_POST['endDate'];
		 $status = 'Active';
 		$insertArticalSql = "INSERT INTO edu_school_subscription (mag_id, article_id,activity_id,school_id,school_subscription_status,subscription_start_date,subscription_end_date,user_id,class_id,level_id,u_type_id) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
		$stmtss = $mysqli->prepare($insertArticalSql);
		$stmtss->bind_param("sssssssssss", $issue_no,$articalId,$activityId,$schoolIDs,$status,$startDate,$endDate,$userID,$classIDE,$levelIDE,$usertypeID);
		$stmtss->execute(); 
		$stmtss->close();  	 
 	} 		
?>

