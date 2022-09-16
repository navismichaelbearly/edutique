
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
$myClass = !empty($_POST['myClass'])?$_POST['myClass']:0;
$classID = !empty($_POST['classID'])?$_POST['classID']:0;
$myClassuser = !empty($_POST['myClassuser'])?$_POST['myClassuser']:0;
$addStudfrimclass = !empty($_POST['addStudfrimclass'])?$_POST['addStudfrimclass']:0;
$myClassusersusrem = !empty($_POST['myClassusersusrem'])?$_POST['myClassusersusrem']:0;
$studInfo = !empty($_POST['studInfo'])?$_POST['studInfo']:0;
$studInfoadd = !empty($_POST['studInfoadd'])?$_POST['studInfoadd']:0;
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
		
if($myClass ==1)	{	
$stmt = $mysqli->prepare("SELECT Distinct(b.level_id), level from edu_users a INNER JOIN edu_user_school_level_class b on a.user_id=b.user_id inner join edu_levels c on b.level_id=c.level_id where b.school_id=? and a.user_type_id=? and b.class_id=? ");
                $stmt->bind_param("sss", $param_school_id,$param_user_type_id,$param_clss_id);
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
					  $param_clss_id=$classID;
                $stmt->execute();
                $result = $stmt->get_result();
                $sr = 1;

                    while ($row = $result->fetch_assoc()) {
                      
                      echo "<table  class='table table-striped table-bordered' style='width:100%; margin-bottom:50px!important'>
                                        <thead>
                                            <tr>
                                                <th>".$row['level']."</th>
                                                <th>Enrolment</th>
                                                <th>Subscribed Product</th>
                                                <th>Teacher IC</th>
                                                <th>Email</th>
												<th>EL Teacher</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										";
                      $stmt1 = $mysqli->prepare("SELECT b.class_id, COUNT(b.user_id) AS userCount, class_name from edu_users a INNER JOIN edu_user_school_level_class b on a.user_id=b.user_id inner join edu_class c on b.class_id=c.class_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=? group by b.class_id");
                      $stmt1->bind_param("sssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_clss_id);
					  $param_status =$active;
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
					  $param_level_id = $row['level_id'];
					  $param_clss_id=$classID;
                      $stmt1->execute();
                      $result1 = $stmt1->get_result();
                      while ($row1 = $result1->fetch_assoc()) {
					       $stmt2 = $mysqli->prepare("Select first_name, last_name,user_email from edu_users a INNER JOIN edu_user_school_level_class b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=?");					
						$stmt2->bind_param("sssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id);
					    $param_status =$active;
					    $param_school_id=$school_id;
					    $param_user_type_id=2;
					    $param_level_id = $row['level_id'];
					    $param_class_id = $row1['class_id'];
						$stmt2->execute();
						$result2 = $stmt2->get_result();
                        $row2 = $result2->fetch_assoc();
						
						$stmt3 = $mysqli->prepare("Select first_name, last_name,user_email from edu_users a INNER JOIN edu_user_school_level_class b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=?");
						$stmt3->bind_param("sssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id);
					    $param_status =$active;
					    $param_school_id=$school_id;
					    $param_user_type_id=10;
					    $param_level_id = $row['level_id'];
					    $param_class_id = $row1['class_id'];
						$stmt3->execute();
						$result3 = $stmt3->get_result();
                        $row3 = $result3->fetch_assoc();
						
						$stmt4 = $mysqli->prepare("Select count(article_id) as articleCount from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=? and b.activity_id=?");
						$stmt4->bind_param("ssssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id,$param_activity_id);
					    $param_status =$active;
					    $param_school_id=$school_id;
					    $param_user_type_id=3;
					    $param_level_id = $row['level_id'];
					    $param_class_id = $row1['class_id'];
						$param_activity_id =0;
						$stmt4->execute();
						$result4 = $stmt4->get_result();
                        $row4 = $result4->fetch_assoc();
						
						$stmt5 = $mysqli->prepare("Select count(activity_id) as activityCount from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=? and b.activity_id !=?");
						$stmt5->bind_param("ssssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id,$param_activity_id);
					    $param_status =$active;
					    $param_school_id=$school_id;
					    $param_user_type_id=3;
					    $param_level_id = $row['level_id'];
					    $param_class_id = $row1['class_id'];
						$param_activity_id =0;
						$stmt5->execute();
						$result5 = $stmt5->get_result();
                        $row5 = $result5->fetch_assoc();
                      echo "<tr><td> <span class='normaltext'>" . $row1['class_name'] . "</span></td>";	   
					   echo "<td class='normaltext'> " . $row1['userCount'] . "</td>";
					   echo "<td class='normaltext'> " . $row4['articleCount'] . " Articles, " . $row5['activityCount'] . " Activities </td>";
					   echo "<td class='normaltext'>" .  $row3['last_name']. " ". $row3['first_name'] . "</td>";
						   echo "<td class='normaltext'>" . $row3['user_email'] . "</td>";
						   echo "<td class='normaltext'>" .  $row2['last_name']. " ". $row2['first_name'] . "</td>";
						   echo "<td class='normaltext'>" . $row2['user_email'] . "</td></tr>";
                      }
                    } 
                  echo "
                </tbody></table>";		
		
}


if($myClassuser ==1)	{	
$stmt = $mysqli->prepare("SELECT last_name,first_name,username,subscription_start_date,subscription_end_date,a.user_id from edu_users a INNER JOIN edu_user_school_level_class b on a.user_id=b.user_id inner join edu_school_subscription c on a.user_id=c.user_id where b.school_id=? and a.user_type_id=? and b.class_id=? and school_subscription_status =? and user_status=? group by first_name,last_name");
                $stmt->bind_param("sssss", $param_school_id,$param_user_type_id,$param_clss_id,$param_school_subscription_status,$param_user_status);
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
					  $param_clss_id=$classID;
					  $param_school_subscription_status=$active;
					  $param_user_status=$active;
                $stmt->execute();
                $result = $stmt->get_result();
                $sr = 1;
                          echo "<div class='panel panel-default'>
                                <div class='panel-heading'>Enrolled
								     <div class='pull-right'>
                                        <div class='btn-group'>
                                            <span><button type='button' class='btn btn-default btn-xs' id='transfStud'>Transfer Student</button> &nbsp;&nbsp;</span>
											<span><button type='button' class='btn btn-default btn-xs' id='addStud'>Add Student</button> &nbsp;&nbsp;</span>
											<span><button type='button' class='btn btn-default btn-xs' id='removeStud' style='background: #dfdede; border-color:#cac8c8; color:#585757'>Remove Student</button></span>
                                        </div>
                                    </div>
								</div>
                                <div class='panel-body' style='overflow-y: scroll; height:350px'><table id='example2' class='table table-striped table-bordered' style='width:100%; margin-bottom:50px!important'>
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>User ID</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										";
                    while ($row = $result->fetch_assoc()) {
					   $s_start_date = date("d M Y", strtotime($row['subscription_start_date']));
					   $s_end_date = date("d M Y", strtotime($row['subscription_end_date']));
                       echo "<tr><td>".$sr."</td><td><a href='student-info.php?uid=".$row['user_id']."&classID=".$classID."'>".$row['last_name']." " .$row['first_name']."</a></td><td>".$row['username']."</td><td>".$s_start_date."</td><td>".$s_end_date."</td></tr>";
                     
                     $sr++; 
                    } 
                  echo "
                </tbody></table></div></div>";		
		
}

if($myClassusersusrem ==1)	{	
$stmt = $mysqli->prepare("SELECT last_name,first_name,username,subscription_start_date,subscription_end_date,a.user_id from edu_users a INNER JOIN edu_user_school_level_class b on a.user_id=b.user_id inner join edu_school_subscription c on a.user_id=c.user_id where b.school_id=? and a.user_type_id=? and b.class_id=? and school_subscription_status =? and user_status=? group by first_name,last_name");
                $stmt->bind_param("sssss", $param_school_id,$param_user_type_id,$param_clss_id,$param_school_subscription_status,$param_user_status);
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
					  $param_clss_id=$classID;
					  $param_school_subscription_status=$active;
					  $param_user_status=$inactive;
                $stmt->execute();
                $result = $stmt->get_result();
                $sr = 1;
                          echo "<div class='panel panel-default'>
                                <div class='panel-heading'>Suspended/Removed 
								<div class='pull-right'>
                                        <div class='btn-group'>
                                            <button type='button' class='btn btn-default btn-xs' id='unsusStud'>Unsuspend Student</button>
                                        </div>
                                    </div>
								</div>
                                <div class='panel-body' style='overflow-y: scroll; height:350px'><table id='example1' class='table table-striped table-bordered' style='width:100%; margin-bottom:50px!important'>
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>User ID</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										";
                    while ($row = $result->fetch_assoc()) {
					   $s_start_date = date("d M Y", strtotime($row['subscription_start_date']));
					   $s_end_date = date("d M Y", strtotime($row['subscription_end_date']));
                       echo "<tr><td>".$sr."</td><td><a href='student-info.php?uid=".$row['user_id']."&classID=".$classID."''>".$row['last_name']." " .$row['first_name']."</a></td><td>".$row['username']."</td><td>".$s_start_date."</td><td>".$s_end_date."</td></tr>";
                      
                     $sr++; 
                    } 
                  echo "
                </tbody></table></div></div>";		
		
}

if($addStudfrimclass ==1)	{
  $levelClass = explode("_",$_POST['classID']);
  $stmt = $mysqli->prepare("Select a.user_id, first_name, last_name from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=?  group by first_name, last_name");
                                                /* Bind parameters */
												$stmt->bind_param("sssss", $param_u_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id);
												  $param_school_id=$school_id;
												  $param_user_type_id=3;
												  
												  $param_u_status=$active;	
												  $param_level_id=$levelClass[0];
												  $param_class_id=$levelClass[1];								                                                
                                                
                                                $stmt->execute();
                                                $stmt->bind_result($user_id,$first_name,$last_name);
                                                 $sr =1;
												 echo "<div class='form-group'><label>Students:</label>";
                                                 echo "<select id='asfc_stud' class='form-control' required>";
                                                 #echo "<option >Students</option>";				
                                                 // fetch values 
                                                 while ($stmt->fetch()) {
                                                      
                                                      echo "<option value='" . $user_id . "'>" . $last_name. " ".$first_name."</option>";
                                                      
                                                      
                                                        $sr++;
                                                 }
												 //echo "<option value='2'>test</option>";
                                                 echo "</select></div>";
}

if($studInfo !=0)	{	
      $levelClass = explode("_",$_POST['classInfo']);
      $stmt = $mysqli->prepare("UPDATE edu_user_school_level_class SET class_id = ?, level_id=? WHERE user_id = ? and school_id=?");	
	  $stmt->bind_param("ssss", $param_class_id,$param_level_id,$param_user_id,$param_school_id);    
	  $param_class_id = $levelClass[1];
	  $param_level_id =$levelClass[0];
	  $param_user_id = $_POST['studInfo'];
	  $param_school_id = $school_id;
	  $stmt->execute();
	  $stmt->close();
	  
	  $stmt = $mysqli->prepare("UPDATE edu_school_subscription SET class_id = ?, level_id=? WHERE user_id = ? and school_id=?");	
	  $stmt->bind_param("ssss", $param_class_id,$param_level_id,$param_user_id,$param_school_id);    
	  $param_class_id = $levelClass[1];
	  $param_level_id =$levelClass[0];
	  $param_user_id = $_POST['studInfo'];
	  $param_school_id = $school_id;
	  $stmt->execute();
	  $stmt->close();
	  
	  $stmt = $mysqli->prepare("UPDATE edu_task AS et
INNER JOIN edu_user_task AS eut ON et.task_id = eut.task_id
SET eut.level_ids = ?,
  eut.class_ids =?
WHERE assigned_to=? and school_id=?");	
	  $stmt->bind_param("ssss", $param_level_id,$param_class_id2,$param_user_id,$param_school_id); 
	  $param_level_id =$levelClass[0];
	  $param_class_id2 = $levelClass[1];
	  $param_user_id = $_POST['studInfo'];
	  $param_school_id = $school_id;
	  $stmt->execute();
	  $stmt->close();
}

if($studInfoadd !=0)	{	
      $stmt = $mysqli->prepare("Select level_id from edu_class where school_id=? and class_id=?");
		/* Bind parameters */
		$stmt->bind_param("ss", $param_school_id,$param_class_id);
		/* Set parameters */
		$param_school_id = $school_id;
		$param_class_id = $_POST['classInfoadd'];
		$stmt->execute();
		$stmt->bind_result($level_ids);
		$stmt->fetch();
		$stmt->close();
      $stmt = $mysqli->prepare("UPDATE edu_user_school_level_class SET class_id = ?, level_id=? WHERE user_id = ? and school_id=?");	
	  $stmt->bind_param("ssss", $param_class_id,$param_level_id,$param_user_id,$param_school_id);    
	  $param_class_id = $_POST['classInfoadd'];
	  $param_level_id =$level_ids;
	  $param_user_id = $_POST['studInfoadd'];
	  $param_school_id = $school_id;
	  $stmt->execute();
	  $stmt->close();
	    
	  $stmt = $mysqli->prepare("UPDATE edu_task AS et
INNER JOIN edu_user_task AS eut ON et.task_id = eut.task_id
SET eut.level_ids = ?,
  eut.class_ids =?
WHERE assigned_to=? and school_id=?");	
	  $stmt->bind_param("ssss", $param_level_id,$param_class_id2,$param_user_id,$param_school_id); 
	  $param_level_id =$level_ids;
	  $param_class_id2 = $_POST['classInfoadd'];
	  $param_user_id = $_POST['studInfoadd'];
	  $param_school_id = $school_id;
	  $stmt->execute();
	  $stmt->close();
	  
	  $stmt = $mysqli->prepare("UPDATE edu_school_subscription SET class_id = ?, level_id=? WHERE user_id = ? and school_id=?");	
	  $stmt->bind_param("ssss", $param_class_id,$param_level_id,$param_user_id,$param_school_id);    
	  $param_class_id = $_POST['classInfoadd'];
	  $param_level_id =$level_ids;
	  $param_user_id = $_POST['studInfoadd'];
	  $param_school_id = $school_id;
	  $stmt->execute();
	  $stmt->close();
}
?>
