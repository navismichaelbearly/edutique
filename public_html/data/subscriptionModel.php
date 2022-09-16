<?php
session_start(); /*Session Start*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
$userIDE = !empty($_POST['userIDE']) ? $_POST['userIDE'] : '';

if ($mag_type_var != '') {
	$returnData = array();
	$issueHTML = '';
	$skillsHTML = '';
	$articleHTML = '';
	$issueHTML .= '<select id="issue_no" name="issue_no[]" class="form-control formfield selectheadback" multiple>';
	$issueHTML .= "<option style='font-family:Arial, Helvetica, sans-serif !important;' value='multiselect-all'> Select All</option>";

	$skillsHTML .= '<select id="skill_type" name="skill_type[]" class="form-control formfield selectheadback" multiple>';
	$skillsHTML .= "<option style='font-family:Arial, Helvetica, sans-serif !important;' value='multiselect-all'> Select All</option>";

	$articleHTML .= '<select name="article_type[]"  id="article_type" class="form-control formfield selectheadback" multiple>';
	$articleHTML .= "<option style='font-family:Arial, Helvetica, sans-serif !important;' value='multiselect-all'> Select All</option>";

	foreach($mag_type_var as $key=> $value){
		$stmt = $mysqli->prepare("SELECT mag_issue, mag_type, a.mag_id FROM edu_magazine a inner join edu_mag_type b on a.mag_type_id=b.mag_type_id inner join edu_article c on a.mag_id =c.mag_id where mag_status=? and a.mag_type_id = ? GROUP BY mag_issue");

			/* Bind parameters */
			$stmt->bind_param("ss", $param_status, $value );
			
			$param_status = $active;
			$stmt->execute();
			$stmt->bind_result($mag_issue, $mag_type, $mag_id);
		
			$issue_no = $_POST['issue_no'] ?? '';
			$sr = 1;
			

			while ($stmt->fetch()) {
				$magType =  $mag_type;
				$mag_issue_type = $mag_type . " " . $mag_issue;
				$issueHTML .= " <option style='font-family:Arial, Helvetica, sans-serif !important;' value='".$mag_id."' ".(($mag_issue_type == $issue_no)?'selected="selected"':"").">".$mag_issue_type."</option>";
				
				$sr++;
				
			}

			/////////// Skill Type change based on type of publication	
			$stmt = $mysqli->prepare( "SELECT * FROM edu_essay_type LEFT JOIN edu_article ON edu_article.essay_type_id = edu_essay_type.essay_type_id LEFT JOIN edu_magazine ON edu_magazine.mag_id = edu_article.mag_id  WHERE mag_type_id = ? GROUP BY essay_type");

			$stmt->bind_param("s", $value);
			// Set parameters 
			$stmt->execute();
			$result = $stmt->get_result();
			

			while ($row = $result->fetch_assoc()) {
				$skillsHTML .= '<option value="' . $row['essay_type_id'] . '">' . $row['essay_type'] . '</option>';
			}

			/////////// ArtIcle Type change based on type of publication			
			$stmt = $mysqli->prepare( "SELECT a.article_id, a.article_title, m.mag_issue FROM edu_article a inner join edu_magazine m ON a.mag_id = m.mag_id WHERE m.mag_type_id = ? and article_status=? ");
                                             
			$stmt->bind_param("ss", $value, $param_article_status);
			$param_article_status= $active;
			//$param_mag_type_id = implode("", $mag_type_var);
			$stmt->execute();
			$result = $stmt->get_result();

			$magIssue = '';
			$first = true;
			while ($row = $result->fetch_assoc()) {
				if ($row['mag_issue'] != $magIssue) {
					$magIssue = $row['mag_issue']; // Just set the new group name
					
					if (!$first) { // Add a closing tag when we change the group, but only if we're not in the first loop
					$articleHTML .= '</optgroup>';
					} else {
						$first = false; // Make sure we don't close the tag first time, but do after the first loop
					}
				$articleHTML .= '<optgroup label= "' . $magType . ' Issue ' . $magIssue . '">';
				}
				// We want to echo the options every loop so it's outside the if condition
				$article_title = str_replace("'", " ", $row['article_title']);
				$articleHTML .= '<option value="'.$row['article_id'].'">'. $article_title . '</option>';
			
			}
			$articleHTML .= '</optgroup>';
			
	}
	$issueHTML .= '</select>';
	$skillsHTML .= '</select>';
	$articleHTML .= '</select>';

	$returnData['issueHTML'] = $issueHTML;
	$returnData['articleHTML'] = $articleHTML;
	$returnData['skillsHTML'] = $skillsHTML;

	echo json_encode($returnData);
	exit ;

}

 $issue_no = $_POST['issue_no'] ?? '';
 $article_type = $_POST['article_type'] ?? '';
 $skill_type = $_POST['skill_type'] ?? '';

if($addUSR > 0)
{ 
	  if(isset($_POST['schoolIDs']) || isset($_POST['userIDE']) || isset($_POST['mag_type']) ||  isset($_POST['classIDE'])  || isset($_POST['levelIDE'])  || isset($_POST['startDate'])  || isset($_POST['endDate']))
		{ 
			// Get the submitted form data 
			$schoolIDs = $_POST['schoolIDs']; 
			$mag_type = $_POST['mag_type']; 
			//$issue_no = $_POST['issue_no'];
			$userIDE = $_POST['userIDE'];
			$classIDE = $_POST['classIDE'];
		
			$levelIDE = $_POST['levelIDE'];
			$startDate = $_POST['startDate'];
			$endDate = $_POST['endDate'];
			
		if(!empty($issue_no) && (empty($skill_type) && empty($article_type))){ 
			foreach($userIDE as $key=> $value){
				$eduUserStmt = $mysqli->prepare("SELECT  user_type_id  FROM edu_users b where user_id = ?");
				$eduUserStmt->bind_param("s",$value);
				$eduUserStmt->execute();
				$resultUsers = $eduUserStmt->get_result();

					if($resultUsers->num_rows > 0){
						while($rowUsers = $resultUsers->fetch_assoc()) {
								$userID = $value;
								$usertypeID = $rowUsers['user_type_id'];

								$getuserStmt = $mysqli->prepare("SELECT class_id  FROM edu_user_school_level_class where user_id=?");
								$getuserStmt->bind_param("s",$userID);
								$getuserStmt->execute();
								$result = $getuserStmt->get_result();
								$getuserStmt->close(); 

								if($result->num_rows > 0){
									while($row = $result->fetch_assoc()) {
										$classID = $row['class_id'];
									}
								}

								foreach($issue_no as $issueKey=> $issuevalue){
		
									$eduActivityStmt = $mysqli->prepare("SELECT activity_id,article_id  FROM edu_activity where mag_id = ?");
									$eduActivityStmt->bind_param("s",$issuevalue);
									$eduActivityStmt->execute();
									$result = $eduActivityStmt->get_result();
									$eduActivityStmt->close(); 
									
									if($result->num_rows > 0){
										
										while($row = $result->fetch_assoc()) {
											$articalId = $row['article_id'];
											$activityId = $row['activity_id'];
											subscribeDataInsert($mysqli,$articalId,$issuevalue,$userID,$schoolIDs,$activityId,$levelIDE,$classID,$usertypeID);
										}
									}

									$eduArticalStmt = $mysqli->prepare("SELECT  article_id  FROM edu_article where mag_id = ?");
									$eduArticalStmt->bind_param("s",$issuevalue);
									$eduArticalStmt->execute();
									$result = $eduArticalStmt->get_result();
									$eduArticalStmt->close(); 
					
									if($result->num_rows > 0){
										while($row = $result->fetch_assoc()) {
											 $articalId = $row['article_id'];
											$activityId = 0;
											subscribeDataInsert($mysqli,$articalId,$issuevalue,$userID,$schoolIDs,$activityId,$levelIDE,$classID,$usertypeID);
										}
									}
								}

								
								
						}
					}	
					
					$eduUserStmt->close(); 
			}

				
		}
		   //------------ subscribe by skill---------------------------------------------
		    
		if(!empty($skill_type) && (empty($issue_no) && empty($article_type))){   
			foreach($userIDE as $key=> $value){
				$eduUserStmt = $mysqli->prepare("SELECT user_type_id FROM edu_users where user_id = ?");
				$eduUserStmt->bind_param("s",$value);
					$eduUserStmt->execute();
					$resultUsers = $eduUserStmt->get_result();
					$eduUserStmt->close();
					if($resultUsers->num_rows > 0){
							while($rowUsers = $resultUsers->fetch_assoc()) {
								$userID = $value;
								 $usertypeID = $rowUsers['user_type_id'];

								$getuserStmt = $mysqli->prepare("SELECT class_id  FROM edu_user_school_level_class where user_id=?");
								$getuserStmt->bind_param("s",$userID);
								$getuserStmt->execute();
								$result = $getuserStmt->get_result();
								$getuserStmt->close(); 

								if($result->num_rows > 0){
									while($row = $result->fetch_assoc()) {
										$classID = $row['class_id'];
									}
								}

								 foreach($skill_type as $skill_key=> $skill_value){
									foreach($mag_type as $key=> $magValue){
										//echo $magValue;

										$eduActivityStmt = $mysqli->prepare("SELECT  activity_id,a.article_id,a.mag_id  FROM edu_activity a inner join edu_magazine b on a.mag_id=b.mag_id INNER JOIN edu_article c on a.article_id=c.article_id where b.mag_type_id=? and c.essay_type_id= ?");
											$eduActivityStmt->bind_param("ss",$magValue,$skill_value);
											$eduActivityStmt->execute();
											$result = $eduActivityStmt->get_result();
											
											
											if($result->num_rows > 0){
												while($row = $result->fetch_assoc()) {
													$articalId = $row['article_id'];
													$activityId = $row['activity_id'];
													$issuevalue = $row['mag_id'];
													subscribeDataInsert($mysqli,$articalId,$issuevalue,$userID,$schoolIDs,$activityId,$levelIDE,$classID,$usertypeID);
												}
											}

											$eduArticalStmt = $mysqli->prepare("SELECT  article_id,a.mag_id  FROM edu_article a inner join edu_magazine b on a.mag_id=b.mag_id where essay_type_id = ? and b.mag_type_id=?");
											$eduArticalStmt->bind_param("ss",$skill_value, $magValue);
											$eduArticalStmt->execute();
											$result = $eduArticalStmt->get_result();
											$eduArticalStmt->close(); 
							
											if($result->num_rows > 0){
												while($row = $result->fetch_assoc()) {
													$articalId = $row['article_id'];
													$activityId = 0;
													$issue_no = $row['mag_id'];
													subscribeDataInsert($mysqli,$articalId,$issue_no,$userID,$schoolIDs,$activityId,$levelIDE,$classID,$usertypeID);
												}
											}

											$eduActivityStmt->close(); 
									}
								 }
															
							}
					}	
			}
			
		}
		   //------------------------- subscribe by activity -------------------
		if(!empty($article_type) && (empty($issue_no) && empty($skill_type))){  
			foreach($userIDE as $key=> $value){
				$eduUserStmt = $mysqli->prepare("SELECT  user_type_id  FROM edu_users b where user_id = ?");
				$eduUserStmt->bind_param("s",$value);
					$eduUserStmt->execute();
					$resultUsers = $eduUserStmt->get_result();
					
					if($resultUsers->num_rows > 0){
							while($rowUsers = $resultUsers->fetch_assoc()) {
								$userID = $value;
								$usertypeID = $rowUsers['user_type_id'];

								$getuserStmt = $mysqli->prepare("SELECT class_id  FROM edu_user_school_level_class where user_id=?");
								$getuserStmt->bind_param("s",$userID);
								$getuserStmt->execute();
								$result = $getuserStmt->get_result();
								$getuserStmt->close(); 

								if($result->num_rows > 0){
									while($row = $result->fetch_assoc()) {
										$classID = $row['class_id'];
									}
								}

								foreach($article_type as $articleKey=> $articleValue){
									
									foreach($mag_type as $key=> $magValue){
										
										$eduActivityStmt = $mysqli->prepare("SELECT  activity_id,a.article_id,a.mag_id  FROM edu_activity a inner join edu_magazine b on a.mag_id=b.mag_id  where b.mag_type_id=? and a.article_id= ?");
										$eduActivityStmt->bind_param("ss",$magValue,$articleValue);
										$eduActivityStmt->execute();
										$result = $eduActivityStmt->get_result();
										$eduActivityStmt->close(); 
										
										if($result->num_rows > 0){
											//echo "<pre>" ; print_r($result->fetch_assoc()); echo "</pre>";
											while($row = $result->fetch_assoc()) {
												$articalId = $row['article_id'];
												$activityId = $row['activity_id'];
												$issuevalue = $row['mag_id'];
												subscribeDataInsert($mysqli,$articalId,$issuevalue,$userID,$schoolIDs,$activityId,$levelIDE,$classID,$usertypeID);
											}
										}

										$eduArticalStmt = $mysqli->prepare("SELECT  article_id,a.mag_id  FROM edu_article a inner join edu_magazine b on a.mag_id=b.mag_id where article_id = ? and b.mag_type_id=?");

										// $eduArticalStmt = $mysqli->prepare("SELECT  a.article_id,a.mag_id  FROM edu_article a inner join edu_magazine b on a.mag_id=b.mag_id INNER JOIN edu_activity c on a.article_id=c.article_id where activity_type_id = ? and b.mag_type_id=?");

										$eduArticalStmt->bind_param("ss",$articleValue, $magValue);
										$eduArticalStmt->execute();
										$result = $eduArticalStmt->get_result();
										$eduArticalStmt->close(); 
						
										if($result->num_rows > 0){
											//echo "<pre>" ; print_r($result->fetch_assoc()); echo "</pre>";
											while($row = $result->fetch_assoc()) {
												$articalId = $row['article_id'];
												$activityId = 0;
												$issuevalue = $row['mag_id'];
												subscribeDataInsert($mysqli,$articalId,$issuevalue,$userID,$schoolIDs,$activityId,$levelIDE,$classID,$usertypeID);
											}
										}
									}
								}
								
						}	
						$eduUserStmt->close(); 
					}
									
			}
				
		}   
		
	}

	
}

function subscribeDataInsert($mysqli,$articalId,$issue_no,$userID,$schoolIDs,$activityId,$levelIDE,$classIDE,$usertypeID){
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
   $status = 'Active';
   
   $Stmt = $mysqli->prepare("SELECT  school_subscription_id  FROM edu_school_subscription where mag_id=? and article_id=? and activity_id=? and school_id=? and user_id=? and class_id=? and level_id=? and u_type_id=?");
						  $Stmt->bind_param("ssssssss",$issue_no,$articalId,$activityId,$schoolIDs,$userID,$classIDE,$levelIDE,$usertypeID);
						  $Stmt->execute();
						  $result = $Stmt->get_result();
						  $Stmt->close(); 
						 // echo "<pre>"; print_r($result); echo "</pre>";
						  if($result->num_rows > 0){
							  //echo 1;
						  }else {
   
							  $insertArticalSql = "INSERT INTO edu_school_subscription (mag_id, article_id,activity_id,school_id,school_subscription_status,subscription_start_date,subscription_end_date,user_id,class_id,level_id,u_type_id) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
							  $stmtss = $mysqli->prepare($insertArticalSql);
							  $stmtss->bind_param("sssssssssss", $issue_no,$articalId,$activityId,$schoolIDs,$status,$startDate,$endDate,$userID,$classIDE,$levelIDE,$usertypeID);
							  $stmtss->execute(); 
							  $stmtss->close(); 
								  
						  }	 
} 	


	
	
	
?>

