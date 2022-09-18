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
$myClassusersusrem = !empty($_POST['myClassusersusrem'])?$_POST['myClassusersusrem']:0;
$myClassusersusrem2 = !empty($_POST['myClassusersusrem2'])?$_POST['myClassusersusrem2']:0;
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
$stmt = $mysqli->prepare("SELECT last_name,first_name,username,subscription_start_date,subscription_end_date,a.user_id, c.level_id from edu_users a INNER JOIN edu_user_school_level_class b on a.user_id=b.user_id inner join edu_school_subscription c on a.user_id=c.user_id where b.school_id=? and a.user_type_id=? and b.class_id=? and school_subscription_status =? and user_status=? and a.user_id=? group by first_name,last_name");
                $stmt->bind_param("ssssss", $param_school_id,$param_user_type_id,$param_clss_id,$param_school_subscription_status,$param_user_status,$param_user_id);
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
					  $param_clss_id=$classID;
					  $param_school_subscription_status=$active;
					  $param_user_status=$active;
					  $param_user_id = $_POST['userID'];
                $stmt->execute();
                $result = $stmt->get_result();
                $sr = 1;
                          echo "<table id='example2' class='table table-striped table-bordered' style='width:100%; margin-bottom:50px!important'>
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>User ID</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
												<th>Subscribed Product</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										";
                    while ($row = $result->fetch_assoc()) {
					   $stmt4 = $mysqli->prepare("Select count(article_id) as articleCount from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=? and b.activity_id=? and a.user_id=?");
						$stmt4->bind_param("sssssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id,$param_activity_id,$param_user_id);
					    $param_status =$active;
					    $param_school_id=$school_id;
					    $param_user_type_id=3;
					    $param_level_id = $row['level_id'];
					    $param_class_id = $classID;
						$param_activity_id =0;
						$param_user_id = $_POST['userID'];
						$stmt4->execute();
						$result4 = $stmt4->get_result();
                        $row4 = $result4->fetch_assoc();
						
						$stmt5 = $mysqli->prepare("Select count(activity_id) as activityCount from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=? and b.activity_id !=? and a.user_id=?");
						$stmt5->bind_param("sssssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id,$param_activity_id,$param_user_id);
					    $param_status =$active;
					    $param_school_id=$school_id;
					    $param_user_type_id=3;
					    $param_level_id = $row['level_id'];
					    $param_class_id = $classID;
						$param_activity_id =0;
						$param_user_id = $_POST['userID'];
						$stmt5->execute();
						$result5 = $stmt5->get_result();
                        $row5 = $result5->fetch_assoc();
					   $s_start_date = date("d M Y", strtotime($row['subscription_start_date']));
					   $s_end_date = date("d M Y", strtotime($row['subscription_end_date']));
                       /*echo "<tr><td>".$sr."</td><td><a href='student-info.php?uid=".$row['user_id']."'>".$row['last_name']." " .$row['first_name']."</a></td><td>".$row['username']."</td><td>".$s_start_date."</td><td>".$s_end_date."</td>";*/
					   echo "<tr><td>".$sr."</td><td>".$row['last_name']." " .$row['first_name']."</td><td>".$row['username']."</td><td>".$s_start_date."</td><td>".$s_end_date."</td>";
                     echo "<td class='normaltext'> " . $row4['articleCount'] . " Articles, " . $row5['activityCount'] . " Activities </td></tr>";
                     $sr++; 
                    } 
                  echo "
                </tbody></table>";		
		
}

if($myClassusersusrem ==1)	{	
$stmt = $mysqli->prepare("SELECT a.task_stages, a.completed_date, article_title,a.article_ids FROM edu_user_task a INNER JOIN edu_task b on a.task_id=b.task_id INNER JOIN edu_article c on a.article_ids=c.article_id  WHERE a.assigned_to=? and a.activity_ids=?");

                $stmt->bind_param("ss", $param_assigned_to,$param_activity_ids);
					  $param_assigned_to=$_POST['userID'];
					  $param_activity_ids =0;
                $stmt->execute();
                $result = $stmt->get_result();
                $sr = 1;
                          echo "<table id='example1' class='table table-striped table-bordered' style='width:100%; margin-bottom:50px!important'>
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Score</th>
                                                <th>Status</th>
                                                <th>Completed Date</th>
                                                <th>Feedback</th>
												<th>Reflection Response</th>
												<th>Review Attempt</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										";
                    while ($row = $result->fetch_assoc()) {
					    if($row['completed_date']!=''){
						  $c_date = date("d M Y", strtotime($row['completed_date']));
						}else {
						  $c_date ='-';
						}
					    
						if($row['task_stages']=='Completed'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#18ce67'>.</span></li>";
						}else if($row['task_stages']=='Incomplete'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#ffcc00'>.</span></li>";
						}else if($row['task_stages']=='Unopened'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#c2cfe0'>.</span></li>";
						}else if($row['task_stages']=='Overdue'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#ef7739'>.</span></li>";
						}
						
                                    
                       echo "
					   <tr><td>Article: ".$row['article_title']."</td>
					   <td></td>
					   <td>".$colorTask."</td>
					   <td>".$c_date."</td>
					   <td>-</td>
					   <td>-</td>
					   <td>-</td>
					   </tr>";
                      
                       $stmt1 = $mysqli->prepare("SELECT a.task_stages, a.completed_date, activity_title,a.activity_ids FROM edu_user_task a INNER JOIN edu_task b on a.task_id=b.task_id INNER JOIN edu_activity c on a.activity_ids=c.activity_id  WHERE a.assigned_to=? and a.activity_ids!=? and a.article_ids=?");
                      $stmt1->bind_param("sss", $param_assigned_to,$param_activity_ids,$row['article_ids']);
					   $param_user_id=$_POST['userID'];
					  $param_activity_id = 0;
                      $stmt1->execute();
                      $result1 = $stmt1->get_result();
                      while ($row1 = $result1->fetch_assoc()) { 
					     $stmt2 = $mysqli->prepare("Select feedback, emotions from edu_feedback where user_id=? and article_id=? and activity_id=?");					
						$stmt2->bind_param("sss", $param_user_id,$param_article_id,$param_activity_id);
					    $param_user_id =$_POST['userID'];
					    $param_article_id=$row['article_ids'];
					    $param_activity_id=$row1['activity_ids'];
						$stmt2->execute();
						$result2 = $stmt2->get_result();
                        $row2 = $result2->fetch_assoc();
						if($row2['emotions']=='neutral'){
						   $emo ="<img src='images/neutral.png' width='20' height='20'>";
						}else if($row2['emotions']=='easy'){
						   $emo ="<img src='images/smile.png' width='20' height='20'>";
						}else if($row2['emotions']=='tough'){
						   $emo ="<img src='images/tough.png' width='20' height='20'>";
						}
						
						if($row1['task_stages']=='Completed'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#18ce67'>.</span></li>";
						}else if($row1['task_stages']=='Incomplete'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#ffcc00'>.</span></li>";
						}else if($row1['task_stages']=='Unopened'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#c2cfe0'>.</span></li>";
						}else if($row1['task_stages']=='Overdue'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#ef7739'>.</span></li>";
						}
						$stmt3 = $mysqli->prepare("Select response from edu_reflection where stud_id=? and art_id=? and act_id=?");
						$stmt3->bind_param("sss", $param_user_id,$param_article_id,$param_activity_id);
					    $param_user_id =$_POST['userID'];
					    $param_article_id=$row['article_ids'];
					    $param_activity_id=$row1['activity_ids'];
						$stmt3->execute();
						$result3 = $stmt3->get_result();
                        $row3 = $result3->fetch_assoc();
						if($row1['completed_date']!=''){
						  $c_date = date("d M Y", strtotime($row1['completed_date']));
						}else {
						  $c_date ='-';
						}
						
						 $stmt4 = $mysqli->prepare("SELECT SUM(mark) as totMarkall FROM  mag_act_ans_detail a inner join mag_act_ans b on b.id = a.mag_act_ans_id");		
						 $stmt4->execute();
						 $result4 = $stmt4->get_result();
                         $row4 = $result4->fetch_assoc();
						 
						 $stmt5 = $mysqli->prepare("SELECT a.activity_title, b.attempt, b.submitted_on, b.id,b.act_id,b.art_id,b.mag_id, SUM(c.is_true) as totmark FROM edu_activity a inner join stu_act_performed b on a.activity_id = b.act_id and a.mag_id=b.mag_id and a.article_id=b.art_id inner join stu_act_performed_detail c on b.id = c.stu_act_performed_id WHERE  b.user_id=? and b.art_id=? and b.act_id=? group by c.stu_act_performed_id");	
						 $stmt5->bind_param("sss", $param_user_id,$param_article_id,$param_activity_id);
					     $param_user_id =$_POST['userID'];	
						 $param_article_id=$row['article_ids'];
					     $param_activity_id=$row1['activity_ids'];
						 $stmt5->execute();
						 $result5 = $stmt5->get_result();
                         $row5 = $result5->fetch_assoc();
						 $count1 = $row5['totmark'] / $row4['totMarkall'];
						 $count2 = $count1 * 100;
						 $count = number_format($count2, 0);
						 
					     echo "
					   <tr><td>Activity: ".$row1['activity_title']."</td>
					   <td>".$count."%</td>
					   <td>".$colorTask."</td>
					   <td>".$c_date."</td>
					   <td>".$emo." ".$row2['feedback']."</td>
					   <td>".$row3['response']."</td>
					   <td><button type='button' class='btn btn-default btn-xs' id='viewAttempt'>View Attempt</button></td>
					   </tr>";
					  }  
                    } 
                  echo "
                </tbody></table>";		
		
}


if($myClassusersusrem2 ==1)	{	
$stmt = $mysqli->prepare("SELECT a.task_stages, a.completed_date, article_title,a.article_ids FROM edu_user_task a INNER JOIN edu_task b on a.task_id=b.task_id INNER JOIN edu_article c on a.article_ids=c.article_id  WHERE a.assigned_to=? and a.activity_ids=? and a.task_stages=?");

                $stmt->bind_param("sss", $param_assigned_to,$param_activity_ids,$param_task_stages);
					  $param_assigned_to=$_POST['userID'];
					  $param_activity_ids =0;
					  $param_task_stages = $_POST['taskStages'];
                $stmt->execute();
                $result = $stmt->get_result();
                $sr = 1;
                          echo "<table id='example1' class='table table-striped table-bordered' style='width:100%; margin-bottom:50px!important'>
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Score</th>
                                                <th>Status</th>
                                                <th>Completed Date</th>
                                                <th>Feedback</th>
												<th>Reflection Response</th>
												<th>Review Attempt</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										";
                    while ($row = $result->fetch_assoc()) {
					    if($row['completed_date']!=''){
						  $c_date = date("d M Y", strtotime($row['completed_date']));
						}else {
						  $c_date ='-';
						}
					    
						if($row['task_stages']=='Completed'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#18ce67'>.</span></li>";
						}else if($row['task_stages']=='Incomplete'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#ffcc00'>.</span></li>";
						}else if($row['task_stages']=='Unopened'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#c2cfe0'>.</span></li>";
						}else if($row['task_stages']=='Overdue'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#ef7739'>.</span></li>";
						}
						
                                    
                       echo "
					   <tr><td>Article: ".$row['article_title']."</td>
					   <td></td>
					   <td>".$colorTask."</td>
					   <td>".$c_date."</td>
					   <td>-</td>
					   <td>-</td>
					   <td>-</td>
					   </tr>";
                      
                       $stmt1 = $mysqli->prepare("SELECT a.task_stages, a.completed_date, activity_title,a.activity_ids FROM edu_user_task a INNER JOIN edu_task b on a.task_id=b.task_id INNER JOIN edu_activity c on a.activity_ids=c.activity_id  WHERE a.assigned_to=? and a.activity_ids!=? and a.article_ids=? and a.task_stages=?");
                      $stmt1->bind_param("ssss", $param_assigned_to,$param_activity_ids,$param_article_ids,$param_task_stages);
					   $param_user_id=$_POST['userID'];
					  $param_activity_id = 0;
					  $param_article_ids = $row['article_ids'];
					  $param_task_stages = $_POST['taskStages'];
                      $stmt1->execute();
                      $result1 = $stmt1->get_result();
                      while ($row1 = $result1->fetch_assoc()) { 
					     $stmt2 = $mysqli->prepare("Select feedback, emotions from edu_feedback where user_id=? and article_id=? and activity_id=?");					
						$stmt2->bind_param("sss", $param_user_id,$param_article_id,$param_activity_id);
					    $param_user_id =$_POST['userID'];
					    $param_article_id=$row['article_ids'];
					    $param_activity_id=$row1['activity_ids'];
						$stmt2->execute();
						$result2 = $stmt2->get_result();
                        $row2 = $result2->fetch_assoc();
						if($row2['emotions']=='neutral'){
						   $emo ="<img src='images/neutral.png' width='20' height='20'>";
						}else if($row2['emotions']=='easy'){
						   $emo ="<img src='images/smile.png' width='20' height='20'>";
						}else if($row2['emotions']=='tough'){
						   $emo ="<img src='images/tough.png' width='20' height='20'>";
						}
						
						if($row1['task_stages']=='Completed'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#18ce67'>.</span></li>";
						}else if($row1['task_stages']=='Incomplete'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#ffcc00'>.</span></li>";
						}else if($row1['task_stages']=='Unopened'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#c2cfe0'>.</span></li>";
						}else if($row1['task_stages']=='Overdue'){
						   $colorTask = "<li style='list-style:none'><span style='font-size:50px; color:#ef7739'>.</span></li>";
						}
						$stmt3 = $mysqli->prepare("Select response from edu_reflection where stud_id=? and art_id=? and act_id=?");
						$stmt3->bind_param("sss", $param_user_id,$param_article_id,$param_activity_id);
					    $param_user_id =$_POST['userID'];
					    $param_article_id=$row['article_ids'];
					    $param_activity_id=$row1['activity_ids'];
						$stmt3->execute();
						$result3 = $stmt3->get_result();
                        $row3 = $result3->fetch_assoc();
						if($row1['completed_date']!=''){
						  $c_date = date("d M Y", strtotime($row1['completed_date']));
						}else {
						  $c_date ='-';
						}
						
						 $stmt4 = $mysqli->prepare("SELECT SUM(mark) as totMarkall FROM  mag_act_ans_detail a inner join mag_act_ans b on b.id = a.mag_act_ans_id");		
						 $stmt4->execute();
						 $result4 = $stmt4->get_result();
                         $row4 = $result4->fetch_assoc();
						 
						 $stmt5 = $mysqli->prepare("SELECT a.activity_title, b.attempt, b.submitted_on, b.id,b.act_id,b.art_id,b.mag_id, SUM(c.is_true) as totmark FROM edu_activity a inner join stu_act_performed b on a.activity_id = b.act_id and a.mag_id=b.mag_id and a.article_id=b.art_id inner join stu_act_performed_detail c on b.id = c.stu_act_performed_id WHERE  b.user_id=? and b.art_id=? and b.act_id=? group by c.stu_act_performed_id");	
						 $stmt5->bind_param("sss", $param_user_id,$param_article_id,$param_activity_id);
					     $param_user_id =$_POST['userID'];	
						 $param_article_id=$row['article_ids'];
					     $param_activity_id=$row1['activity_ids'];
						 $stmt5->execute();
						 $result5 = $stmt5->get_result();
                         $row5 = $result5->fetch_assoc();
						 $count1 = $row5['totmark'] / $row4['totMarkall'];
						 $count2 = $count1 * 100;
						 $count = number_format($count2, 0);
						 
					     echo "
					   <tr><td>Activity: ".$row1['activity_title']."</td>
					   <td>".$count."%</td>
					   <td>".$colorTask."</td>
					   <td>".$c_date."</td>
					   <td>".$emo." ".$row2['feedback']."</td>
					   <td>".$row3['response']."</td>
					   <td><button type='button' class='btn btn-default btn-xs' id='viewAttempt'>View Attempt</button></td>
					   </tr>";
					  }  
                    } 
                  echo "
                </tbody></table>";		
		
}


?>
