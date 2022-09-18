<?php
error_reporting(-1);
ini_set('display_errors', true);
session_start(); /*Session Start*/

/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

/* include files */
require_once "../inc/config.php";
include "../inc/constants.php";
$userVar = !empty($_POST['userVar'])?$_POST['userVar']:0;
$addUSR = !empty($_POST['addUSR'])?$_POST['addUSR']:0;
$usernameVAR = !empty($_POST['usernameVAR'])?$_POST['usernameVAR']:'';
$emailVAR = !empty($_POST['emailVAR'])?$_POST['emailVAR']:'';
$schoolIDs = !empty($_POST['schoolIDs'])?$_POST['schoolIDs']:'';
$levelIDE = !empty($_POST['levelIDE'])?$_POST['levelIDE']:'';
$classIDE = !empty($_POST['classIDE'])?$_POST['classIDE']:'';
$userIDE = !empty($_POST['userIDE'])?$_POST['userIDE']:'';
$updateUSR = !empty($_POST['updateUSR'])?$_POST['updateUSR']:'';




if($schoolIDs > 0)
	{
	 	 $stmt = $mysqli->prepare("SELECT level_id, level FROM edu_levels where level_status=? and school_id=?");
                                                        /* Bind parameters */
		$stmt->bind_param("ss", $param_status,$param_school_id);
		/* Set parameters */
		
		$param_status = $active;
		$param_school_id = $schoolIDs;
		$stmt->execute();
		$stmt->bind_result($level_id, $level);
			$sr =1;
			echo " <label>Level</label>
				<div class='form-group' >";
			echo "<select id='levelIDE' name='levelIDE' class='form-control formfield' required>";
			echo "<option style='font-family:Arial, Helvetica, sans-serif !important;'  >Select Level</option>";			
			// fetch values 
			while ($stmt->fetch()) {
				
				echo "<option style='font-family:Arial, Helvetica, sans-serif !important;' value='" . $level_id . "' >" . $level . "</option>";
				
				
				$sr++;
			}
			echo "</select></div>";
	}

if($levelIDE > 0 && $classIDE == '')
	{
	 	//  $stmt = $mysqli->prepare("SELECT class_id, class_name FROM edu_class where class_status=? and school_id=? and level_id=?");
		  $stmt = $mysqli->prepare("SELECT class_id, class_name FROM edu_class where class_id IN (SELECT class_id FROM edu_user_school_level_class where class_status=? and school_id=? and level_id=?)");
		/* Bind parameters */
		$stmt->bind_param("sss", $param_status,$param_school_id,$param_level_id);
		/* Set parameters */
		
		$param_status = $active;
		$param_school_id = $_POST['schoolIDsforclass'];
		$param_level_id = $levelIDE;
		$stmt->execute();
		$stmt->bind_result($class_id, $class_name);
			$sr =1;
			echo " <label>Class</label>
				<div class='form-group' >";
			echo "<select id='classIDE' name='classIDE[]' class='form-control formfield' multiple required >";
			// echo "<option style='font-family:Arial, Helvetica, sans-serif !important;'  >Select all Class</option>";
			echo "<option style='font-family:Arial, Helvetica, sans-serif !important;' value='multiselect-all'> Select All</option>";			
			// fetch values 
			while ($stmt->fetch()) {
				
				echo "<option style='font-family:Arial, Helvetica, sans-serif !important;' value='" . $class_id . "' >" . $class_name . "</option>";
				
				
				$sr++;
			}
			echo "</select></div>";
	}
	if(!empty($classIDE) )
	{
		echo " <label>User</label>
				<div class='form-group' >";
		echo "<select id='userIDE' name='userIDE[]' class='form-control formfield'  multiple required>";
		// echo "<option style='font-family:Arial, Helvetica, sans-serif !important;'  >Select Users</option>";
		echo "<option style='font-family:Arial, Helvetica, sans-serif !important;' value='multiselect-all'> Select All</option>";
		foreach($classIDE as $key=> $value){
		//echo $value;

		$stmt = $mysqli->prepare("SELECT first_name, user_id FROM edu_users where user_id IN (SELECT user_id FROM edu_user_school_level_class where class_id = ? and school_id = ? and level_id = ?)");
			/* Bind parameters */
		$stmt->bind_param("sss",$param_class_id,$param_school_id,$param_level_id);
		/* Set parameters */
		$param_class_id = $value;
		$param_school_id = $_POST['schoolIDsforclass'];
		$param_level_id = $_POST['levelIDE'];
		$stmt->execute();
		$stmt->bind_result($first_name, $user_id);
			$sr =1;
						
			// fetch values 
			while ($stmt->fetch()) {
				
				echo "<option style='font-family:Arial, Helvetica, sans-serif !important;' value='" . $user_id . "' >" . $first_name . "</option>";
				
				
				$sr++;
			}
			
		}
		echo "</select></div>";
		
	}
   if($userVar > 0)
	{

		if($_POST['scID'] > 0 && $_POST['lvId'] > 0 && $_POST['clId'] > 0){	
		  $stmt = $mysqli->prepare("SELECT a.user_id,username, user_email, first_name, last_name, user_status, suspended, removed, user_type FROM edu_users a inner join edu_utype b on a.user_type_id=b.user_type_id inner join edu_user_school_level_class c on a.user_id =c.user_id where school_id=? and level_id=? and class_id=?");
		  $stmt->bind_param("sss", $_POST['schoolIDs'], $_POST['levelIDE'], $_POST['classIDE']);
		}
			/*if ($stmt = $mysqli->prepare("SELECT b.article_title, a.ques, count(review_id) as review, a.mag_id, a.art_id,a.act_id FROM edu_review a inner join edu_article b on a.art_id=b.article_id GROUP BY a.ques")) {*/    
		else { $stmt = $mysqli->prepare("SELECT a.user_id,username, user_email, first_name, last_name, user_status, suspended, removed, user_type FROM edu_users a inner join edu_utype b on a.user_type_id=b.user_type_id");
		}
			  
			 //$stmt->bind_param("s", $param_teach_id);
			// $param_teach_id = $_SESSION['id'];	
			 
			 $stmt->execute();
			 $result = $stmt->get_result();
			 /* bind variables to prepared statement */
			// $stmt->bind_result($first_name,$last_name, $user_type_id, $user_rating, $user_review, $mag_id, $art_id, $act_id, $status);
			 $sr =1;
			 echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
												<thead>
													<tr><th><input type='checkbox' id='select_all'> Select </th>
													<th>No.</th>
													    <th>Name</th>
														<th>Username</th>
														<th>Email</th>
														<th>User Type</th>
														<th>Suspended</th>
														<th>Removed</th>
														<th>Status</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												";
													
			 /* fetch values */
			 while ($row = $result->fetch_assoc()) {
			     
				  echo "<tr>";
				/*if($_SESSION["utypeid"]==$admconst){
				  $magLink = "article-detail-admin.php?artID=".$row['art_id']."&actID=".$row['act_id']."&magID=".$row['mag_id'];
				}else{
				  $magLink = "acticle-detail.php?artID=".$row['art_id']."&actID=".$row['act_id']."&magID=".$row['mag_id'];
				 }*/
				
				  if($row['suspended']==0 || $row['suspended'] ==""){ $varSus= "No";}else{ $varSus= "Yes";}
				   if($row['removed']==0 || $row['removed'] ==""){ $varRemv= "No";}else{ $varRemv= "Yes";}
					   
					  // echo "<td class='normaltext'><a href='".$magLink."'>" . $activity_title . "</a></td>";
					  echo "<td><input type='checkbox' class='rev_checkbox' data-rev-id='" . $row['user_id'] . "'></td>";
					  echo "<td>" .$sr."</td>";
					   echo "<td class='normaltext'>" . $row['last_name'] ." ". $row['first_name']."</td>";
					   echo "<td class='normaltext'>" . $row['username'] ."</td>";
					   echo "<td class='normaltext'>" . $row['user_email'] ."</td>"; 
					    echo "<td class='normaltext'>" . $row['user_type'] ."</td>"; 
						echo "<td class='normaltext'>" . $varSus ."</td>";
						 echo "<td class='normaltext'>" . $varRemv ."</td>";
						 echo "<td class='normaltext'>" . $row['user_status'] ."</td>";
						 echo "<td class='normaltext' style='vertical-align:middle'><a href='edit-user.php?userID=" . $row['user_id'] . "'><i class='material-icons-outlined md-16 annocom' >create</i></a></td>";
					  
					 echo "</tr>" ;
							$sr++;
			}
			
			echo "
												</tbody>    
											  </table>";
	 //}									
	 
	}
	
	if($addUSR > 0)
	{
	  if(isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['userID']) || isset($_POST['username'])  || isset($_POST['user_email']))
		{ 
			// Get the submitted form data 
			$first_name = $_POST['first_name']; 
			$last_name = $_POST['last_name']; 
			$userID = $_POST['userID']; 
			$username = $_POST['username']; 
			$user_email = $_POST['user_email'];
			$stmt = $mysqli->prepare("SELECT username,user_email,user_id FROM  edu_users where username = ? or user_email=?");
		   /* Bind parameters */
		   $stmt->bind_param("ss", $param_username, $param_user_email);
		   /* Set parameters */
		   $param_username = $username;
		   $param_user_email = $user_email;
		   $stmt->execute();
		   $stmt->store_result();
		   $total_rows = $stmt->num_rows;
		   $stmt->bind_result($usernameCheck,$user_emailCheck, $user_idcheck);
		   $stmt->fetch();
		   $stmt->close();
			// Check whether submitted data is not empty 
			if(!empty($first_name) )
			{ 
			   if($total_rows !=1)
			   {
				   $confirm_password ="Zxcv.mnbv@19";
				   $stmt = $mysqli->prepare("INSERT into edu_users (first_name,last_name,username,user_email,user_type_id,user_password,user_status, user_created_by, user_created_date) 
							values (?,?,?,?,?,?,?,?,?)");	
				   $stmt->bind_param("sssssssss", $param_first_name,$param_last_name,$param_username,$param_user_email,$param_user_type_id, $param_password, $param_user_status, $param_user_created_by, $param_user_created_date);  
				   $param_first_name = $first_name;
				   $param_last_name = $last_name;
				   $param_username = $username;
				   $param_user_email = $user_email;
				   $param_user_type_id = $userID;			   
				   $param_password = password_hash($confirm_password, PASSWORD_DEFAULT);			   
				   $param_user_status = $active;
				   $param_user_created_by = $admintitle;
				   $param_user_created_date = $todaysDate;
				   if($stmt->execute()){
				       $lastuser_id = $stmt->insert_id;
				      if(isset($_POST['schoolIDs']) || isset($_POST['levelIDE']) || isset($_POST['classIDE']))
		                {
							$stmt = $mysqli->prepare("INSERT into edu_user_school_level_class (user_id, school_id, level_id, class_id) 
									values (?,?,?,?)");	
						   $stmt->bind_param("ssss", $param_user_id,$param_school_id,$param_level_id,$param_class_id);  
						   $param_user_id = $lastuser_id;
						   $param_school_id = $_POST['schoolIDs'];
						   $param_level_id = $_POST['levelIDE'];
						   $param_class_id = $_POST['classIDE'];
						   $stmt->execute();
						 }
				    }
				}else{ echo "<span>Username / User Email exists in the System</span>";}   
				
				
			} 
		}	  
	}

if($usernameVAR !=''){
   $stmt = $mysqli->prepare("SELECT username,user_email,user_id FROM  edu_users where username = ?");
		   /* Bind parameters */
		   $stmt->bind_param("s", $param_username);
		   /* Set parameters */
		   $param_username = $usernameVAR;
		   $stmt->execute();
		   $stmt->store_result();
		   $total_rowsUN = $stmt->num_rows;
		   $stmt->bind_result($usernameCheck,$user_emailCheck, $user_idcheck);
		   $stmt->fetch();
		   $stmt->close();
		   if($total_rowsUN==1){
		   echo 1;
		   }else{
		   echo 0;
		   }
}	

if($emailVAR !=''){
   $stmt = $mysqli->prepare("SELECT username,user_email,user_id FROM  edu_users where user_email = ?");
		   /* Bind parameters */
		   $stmt->bind_param("s", $param_user_email);
		   /* Set parameters */
		   $param_user_email = $emailVAR;
		   $stmt->execute();
		   $stmt->store_result();
		   $total_rowsEm = $stmt->num_rows;
		   $stmt->bind_result($usernameCheck,$user_emailCheck, $user_idcheck);
		   $stmt->fetch();
		   $stmt->close();
		   if($total_rowsEm==1){
		   echo 1;
		   }else{
		   echo 0;
		   }
}

if($updateUSR > 0)
	{
	  if(isset($_POST['first_name']) || isset($_POST['last_name']) || isset($_POST['userID']) || isset($_POST['username'])  || isset($_POST['user_email']))
		{ 
			// Get the submitted form data 
			$first_name = $_POST['first_name']; 
			$last_name = $_POST['last_name']; 
			$userID = $_POST['userID']; 
			$username = $_POST['username']; 
			$user_email = $_POST['user_email'];
			$stmt = $mysqli->prepare("SELECT username,user_email,user_id FROM  edu_users where username = ? or user_email=?");
		   /* Bind parameters */
		   $stmt->bind_param("ss", $param_username, $param_user_email);
		   /* Set parameters */
		   $param_username = $username;
		   $param_user_email = $user_email;
		   $stmt->execute();
		   $stmt->store_result();
		   $total_rows = $stmt->num_rows;
		   $stmt->bind_result($usernameCheck,$user_emailCheck, $user_idcheck);
		   $stmt->fetch();
		   $stmt->close();
			// Check whether submitted data is not empty 
			if(!empty($first_name) )
			{ 
			   if($total_rows !=1)
			   {
				   //$confirm_password ="Zxcv.mnbv@19";
				   $stmt = $mysqli->prepare("UPDATE edu_users SET first_name=?,last_name=?,username=?,user_email=? where user_id=?");	
				   $stmt->bind_param("sssss", $param_first_name,$param_last_name,$param_username,$param_user_email,$param_user_id);  
				   $param_first_name = $first_name;
				   $param_last_name = $last_name;
				   $param_username = $username;
				   $param_user_email = $user_email;
				   $param_user_id = $_POST['user_idcheck'];
				   if($stmt->execute()){
				       
				    }
				}else{ echo "<span>Username / User Email exists in the System</span>";}   
				
				
			} 
		}	  
	}	
	

?>
