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
$classID = !empty($_POST['classID'])?$_POST['classID']:0;
$myClassuser = !empty($_POST['myClassuser'])?$_POST['myClassuser']:0;
$userID = !empty($_POST['userID'])?$_POST['userID']:0;
$userIDrem = !empty($_POST['userIDrem'])?$_POST['userIDrem']:0;
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
		



if($myClassuser ==1)	{	
$stmt = $mysqli->prepare("SELECT last_name,first_name,username,a.user_id, suspended, removed from edu_users a INNER JOIN edu_user_school_level_class b on a.user_id=b.user_id inner join edu_school_subscription c on a.user_id=c.user_id where b.school_id=? and a.user_type_id=? and b.class_id=? and school_subscription_status =? group by first_name,last_name");
                $stmt->bind_param("ssss", $param_school_id,$param_user_type_id,$param_clss_id,$param_school_subscription_status);
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
					  $param_clss_id=$classID;
					  $param_school_subscription_status=$active;
                $stmt->execute();
                $result = $stmt->get_result();
                $sr = 1;
                          echo "<table id='example' class='table table-striped table-bordered' style='width:100%;'>
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>User ID</th>
                                                <th>Suspend</th>
                                                <th>Remove</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										";
                    while ($row = $result->fetch_assoc()) {
					   if($row['suspended']!=1){
						 $checkboxsus= "";
					   } else {
						 $checkboxsus= "checked";
		               }
					   
					   if($row['removed']!=1){
						 $checkboxrem= "";
					   } else {
						 $checkboxrem= "checked";
		               }
                       echo "<tr>
					   <td>".$sr."</td>
					   <td>".$row['last_name']." " .$row['first_name']."</td>
					   <td>".$row['username']."</td>
					   <td><input type='checkbox' name='susStud' id='susStud'  data-id='" .$row['user_id']."' ".$checkboxsus." ></td>
					   <td><input type='checkbox' name='removeStud' id='removeStud'  data-id='" .$row['user_id']."' ".$checkboxrem." ></td>
					   </tr>";
                     
                     $sr++; 
                    } 
                  echo "
                </tbody></table>";		
		
}


if($userID >0)	{	
if($_POST["cpStatusval"]==1){
$stat = $inactive;
}else if($_POST["cpStatusval"]==0){
$stat = $active;
}
$stmt = $mysqli->prepare("UPDATE edu_users SET suspended = ?, user_status=? WHERE user_id = ?");	
	  $stmt->bind_param("sss", $param_suspended,$param_user_status,$param_user_id);    
	  $param_suspended = $_POST["cpStatusval"];
	  $param_user_status =$stat;
	   $param_user_id =$userID;
	  if($stmt->execute()){
	     
	  }
	  $stmt->close();
}


if($userIDrem >0)	{	
if($_POST["rcpStatusval"]==1){
$stat = $inactive;
}else if($_POST["rcpStatusval"]==0){
$stat = $active;
}
$stmt = $mysqli->prepare("UPDATE edu_users SET removed = ?, user_status=? WHERE user_id = ?");	
	  $stmt->bind_param("sss", $param_suspended,$param_user_status,$param_user_id);    
	  $param_suspended = $_POST["rcpStatusval"];
	  $param_user_status =$stat;
	   $param_user_id =$userIDrem;
	  if($stmt->execute()){
	     
	  }
	  $stmt->close();
}
?>
