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
$levelIDEto = !empty($_POST['levelIDEto'])?$_POST['levelIDEto']:'';
$updateUSR = !empty($_POST['updateUSR'])?$_POST['updateUSR']:'';
$schoolIDsforclass = !empty($_POST['schoolIDsforclass'])?$_POST['schoolIDsforclass']:'';
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
                                                         echo " <label>From Level</label>
                                                               <div class='form-group' >";
                                                         echo "<select id='levelIDE' name='levelIDE' class='form-control formfield' required>";
														 echo "<option style='font-family: Poppins !important;'  >Select Level</option>";			
                                                         // fetch values 
                                                         while ($stmt->fetch()) {
                                                              
                                                              echo "<option style='font-family: Poppins !important;' value='" . $level_id . "' >" . $level . "</option>";
                                                              
                                                              
                                                                $sr++;
                                                         }
                                                         echo "</select></div>";
														 
														 $stmt = $mysqli->prepare("SELECT level_id, level FROM edu_levels where level_status=? and school_id=?");
                                                        /* Bind parameters */
                                                        $stmt->bind_param("ss", $param_status,$param_school_id);
                                                        /* Set parameters */
                                                        
                                                        $param_status = $active;
														$param_school_id = $schoolIDs;
                                                        $stmt->execute();
                                                        $stmt->bind_result($level_id, $level);
                                                         $sr =1;
                                                         echo " <label>To Level</label>
                                                               <div class='form-group' >";
                                                         echo "<select id='levelIDEto' name='levelIDEto' class='form-control formfield' required>";
														 echo "<option style='font-family: Poppins !important;'  >Select Level</option>";			
                                                         // fetch values 
                                                         while ($stmt->fetch()) {
                                                              
                                                              echo "<option style='font-family: Poppins !important;' value='" . $level_id . "' >" . $level . "</option>";
                                                              
                                                              
                                                                $sr++;
                                                         }
                                                         echo "</select></div>";
	}

if($levelIDE > 0)
	{
	  $stmt = $mysqli->prepare("SELECT class_id, class_name FROM edu_class where class_status=? and school_id=? and level_id=?");
                                                        /* Bind parameters */
                                                        $stmt->bind_param("sss", $param_status,$param_school_id,$param_level_id);
                                                        /* Set parameters */
                                                        
                                                        $param_status = $active;
														$param_school_id = $schoolIDsforclass;
														$param_level_id = $levelIDE;
                                                        $stmt->execute();
                                                        $stmt->bind_result($class_id, $class_name);
                                                         $sr =1;
                                                         echo " <label>From Class</label>
                                                               <div class='form-group' >";
                                                         echo "<select id='classIDE' name='classIDE' class='form-control formfield' required>";
														 echo "<option style='font-family: Poppins !important;'  >Select Class</option>";			
                                                         // fetch values 
                                                         while ($stmt->fetch()) {
                                                              
                                                              echo "<option style='font-family: Poppins !important;' value='" . $class_id . "' >" . $class_name . "</option>";
                                                              
                                                              
                                                                $sr++;
                                                         }
                                                         echo "</select></div>";
	}
	
if($levelIDEto > 0)
	{
	  $stmt = $mysqli->prepare("SELECT class_id, class_name FROM edu_class where class_status=? and school_id=? and level_id=?");
                                                        /* Bind parameters */
                                                        $stmt->bind_param("sss", $param_status,$param_school_id,$param_level_id);
                                                        /* Set parameters */
                                                        
                                                        $param_status = $active;
														$param_school_id = $schoolIDsforclass;
														$param_level_id = $levelIDEto;
                                                        $stmt->execute();
                                                        $stmt->bind_result($class_id, $class_name);
                                                         $sr =1;
                                                         echo " <label>To Class</label>
                                                               <div class='form-group' >";
                                                         echo "<select id='classIDEto' name='classIDEto' class='form-control formfield' required>";
														 echo "<option style='font-family: Poppins !important;'  >Select Class</option>";			
                                                         // fetch values 
                                                         while ($stmt->fetch()) {
                                                              
                                                              echo "<option style='font-family: Poppins !important;' value='" . $class_id . "' >" . $class_name . "</option>";
                                                              
                                                              
                                                                $sr++;
                                                         }
                                                         echo "</select></div>";
	}		
	
 
	
	if($addUSR > 0)
	{
	  if(isset($_POST['schoolIDs']) || isset($_POST['levelIDE']) || isset($_POST['levelIDEto']) || isset($_POST['classIDE'])  || isset($_POST['classIDEto']))
		{ 
			// Get the submitted form data 
			$schoolIDs = $_POST['schoolIDs']; 
			$levelIDE = $_POST['levelIDE']; 
			$levelIDEto = $_POST['levelIDEto']; 
			$classIDE = $_POST['classIDE']; 
			$classIDEto = $_POST['classIDEto'];
			
			// Check whether submitted data is not empty 
			if(!empty($schoolIDs) )
			{ 
			    $stmt = $mysqli->prepare("SELECT a.user_id from edu_user_school_level_class a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where b.school_id=? and b.u_type_id=? and b.level_id=? and b.class_id=?");
                $stmt->bind_param("ssss", $param_school_id,$param_user_type_id,$param_level_id,$param_class_id);
					  $param_school_id=$schoolIDs;
					  $param_user_type_id=3;
					  $param_level_id=$levelIDE;
					  $param_class_id=$classIDE;
                $stmt->execute();
                $result = $stmt->get_result();
                $sr = 1;

                while ($row = $result->fetch_assoc()) {
				  $stmt = $mysqli->prepare("UPDATE edu_user_school_level_class SET school_id = ? , level_id = ?, class_id = ? where user_id=?");
				  $stmt->bind_param("ssss", $schoolIDs,$levelIDEto,$classIDEto,$row['user_id']); 		
				  $stmt->execute();
				  $stmt->close();
				  
				  $stmt = $mysqli->prepare("UPDATE edu_school_subscription SET school_id = ? , level_id = ?, class_id = ? where user_id=?");
				  $stmt->bind_param("ssss", $schoolIDs,$levelIDEto,$classIDEto,$row['user_id']); 		
				  $stmt->execute();
				  $stmt->close(); 
				  echo $row['user_id'];
			   }    
				   
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
