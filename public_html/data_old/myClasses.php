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
$myClassvar = !empty($_POST['myClass'])?$_POST['myClass']:0;
$yearVar = !empty($_POST['yearVar'])?$_POST['yearVar']:0;
$classVardrop = !empty($_POST['classVardrop'])?$_POST['classVardrop']:0;
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
if($classVardrop ==1 && $_POST['classValuedrop']=='Myclass')	{
$myClassvar =1;
}		
if($myClassvar ==1)	{
$stmtnew = $mysqli->prepare("SELECT Distinct(b.level_id), level,b.class_id from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id inner join edu_levels c on b.level_id=c.level_id where b.school_id=? and a.user_id=? group by b.user_id");
                $stmtnew->bind_param("ss", $param_school_id,$param_user_id);
					  $param_school_id=$school_id;
					  $param_user_id=$_SESSION['id'];;
                $stmtnew->execute();
                $resultnew = $stmtnew->get_result();
                $sr = 1;

                    while ($rownew = $resultnew->fetch_assoc()) {
					
					
$stmt = $mysqli->prepare("SELECT Distinct(b.level_id), level from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id inner join edu_levels c on b.level_id=c.level_id where b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=? group by b.user_id");
                $stmt->bind_param("ssss", $param_school_id,$param_user_type_id,$param_level_id,$param_class_id);
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
					  $param_level_id=$rownew['level_id'];
					  $param_class_id=$rownew['class_id'];
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
                      $stmt1 = $mysqli->prepare("SELECT Distinct(COUNT(b.user_id)) AS userCount, b.class_id,  class_name from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id inner join edu_class c on b.class_id=c.class_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=?  group by b.class_id, b.user_id");
                      $stmt1->bind_param("sssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id);
					  $param_status =$active;
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
					  $param_level_id = $row['level_id'];
					  $param_class_id=$rownew['class_id'];
                      $stmt1->execute();
                      $result1 = $stmt1->get_result();
                      while ($row1 = $result1->fetch_assoc()) {
					  
					      $stmt2 = $mysqli->prepare("Select first_name, last_name,user_email from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=?");
						
						/* Set parameters */
						$stmt2->bind_param("sssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id);
					    $param_status =$active;
					    $param_school_id=$school_id;
					    $param_user_type_id=2;
					    $param_level_id = $row['level_id'];
					    $param_class_id = $row1['class_id'];
						$stmt2->execute();
						$result2 = $stmt2->get_result();
                        $row2 = $result2->fetch_assoc();
						
						$stmt3 = $mysqli->prepare("Select first_name, last_name,user_email from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=?");
						
						/* Set parameters */
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
					  
						  echo "<tr><td> <a href='class.php?classID=".$row1['class_id']."'><span class='normaltext'>" . $row1['class_name'] . "</span></a></td>";	   
						   echo "<td class='normaltext'> " . $row1['userCount'] . "</td>";
						   echo "<td class='normaltext'> " . $row4['articleCount'] . " Articles, " . $row5['activityCount'] . " Activities </td>";
						   echo "<td class='normaltext'>" .  $row3['last_name']. " ". $row3['first_name'] . "</td>";
						   echo "<td class='normaltext'>" . $row3['user_email'] . "</td>";
						   echo "<td class='normaltext'>" .  $row2['last_name']. " ". $row2['first_name'] . "</td>";
						   echo "<td class='normaltext'>" . $row2['user_email'] . "</td></tr>";
					  }
					  //echo "<tr><td>Total</td><td colspan='5'>" . $row1['totusers'] . "</td></tr>";
                    } 
					}
                  echo "
                </tbody></table>";		
		
}


if($yearVar ==1)	{
$stmtnew = $mysqli->prepare("SELECT Distinct(b.level_id), level,b.class_id from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id inner join edu_levels c on b.level_id=c.level_id where b.school_id=? and a.user_id=?  group by b.user_id");
                $stmtnew->bind_param("ss", $param_school_id,$param_user_id);
					  $param_school_id=$school_id;
					  $param_user_id=$_SESSION['id'];;
                $stmtnew->execute();
                $resultnew = $stmtnew->get_result();
                $sr = 1;

                    while ($rownew = $resultnew->fetch_assoc()) {	
$stmt = $mysqli->prepare("SELECT Distinct(b.level_id), level from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id inner join edu_levels c on b.level_id=c.level_id where b.school_id=? and a.user_type_id=? and subscription_start_date like ?  and b.level_id=? and b.class_id=?  group by b.user_id");
                $stmt->bind_param("sssss", $param_school_id,$param_user_type_id,$param_subscription_start_date,$param_level_id,$param_class_id);
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
					  $param_subscription_start_date = "%{$_POST['yearValue']}%";
					  $param_level_id=$rownew['level_id'];
					  $param_class_id=$rownew['class_id'];
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
                      $stmt1 = $mysqli->prepare("SELECT Distinct(COUNT(b.user_id)) AS userCount, b.class_id,  class_name from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id inner join edu_class c on b.class_id=c.class_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=? and subscription_start_date like ? group by b.class_id");
                      $stmt1->bind_param("ssssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id,$param_subscription_start_date);
					  $param_status =$active;
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
					  $param_level_id = $row['level_id'];
					  $param_class_id=$rownew['class_id'];
					  $param_subscription_start_date = "%{$_POST['yearValue']}%";
                      $stmt1->execute();
                      $result1 = $stmt1->get_result();
                      while ($row1 = $result1->fetch_assoc()) {
					  
					      $stmt2 = $mysqli->prepare("Select first_name, last_name,user_email from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=?  and subscription_start_date like ?");
						
						/* Set parameters */
						$stmt2->bind_param("ssssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id,$param_subscription_start_date);
					    $param_status =$active;
					    $param_school_id=$school_id;
					    $param_user_type_id=2;
					    $param_level_id = $row['level_id'];
					    $param_class_id = $row1['class_id'];
						$param_subscription_start_date = "%{$_POST['yearValue']}%";
						$stmt2->execute();
						$result2 = $stmt2->get_result();
                        $row2 = $result2->fetch_assoc();
						
						$stmt3 = $mysqli->prepare("Select first_name, last_name,user_email from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=?  and subscription_start_date like ?");
						
						/* Set parameters */
						$stmt3->bind_param("ssssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id,$param_subscription_start_date);
					    $param_status =$active;
					    $param_school_id=$school_id;
					    $param_user_type_id=10;
					    $param_level_id = $row['level_id'];
					    $param_class_id = $row1['class_id'];
						$param_subscription_start_date = "%{$_POST['yearValue']}%";
						$stmt3->execute();
						$result3 = $stmt3->get_result();
                        $row3 = $result3->fetch_assoc();
						
						$stmt4 = $mysqli->prepare("Select count(article_id) as articleCount from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=? and b.activity_id=?  and subscription_start_date like ?");
						$stmt4->bind_param("sssssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id,$param_activity_id,$param_subscription_start_date);
					    $param_status =$active;
					    $param_school_id=$school_id;
					    $param_user_type_id=3;
					    $param_level_id = $row['level_id'];
					    $param_class_id = $row1['class_id'];
						$param_activity_id =0;
						$param_subscription_start_date = "%{$_POST['yearValue']}%";
						$stmt4->execute();
						$result4 = $stmt4->get_result();
                        $row4 = $result4->fetch_assoc();
						
						$stmt5 = $mysqli->prepare("Select count(activity_id) as activityCount from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=? and b.activity_id !=?  and subscription_start_date like ?");
						$stmt5->bind_param("sssssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id,$param_activity_id,$param_subscription_start_date);
					    $param_status =$active;
					    $param_school_id=$school_id;
					    $param_user_type_id=3;
					    $param_level_id = $row['level_id'];
					    $param_class_id = $row1['class_id'];
						$param_activity_id =0;
						$param_subscription_start_date = "%{$_POST['yearValue']}%";
						$stmt5->execute();
						$result5 = $stmt5->get_result();
                        $row5 = $result5->fetch_assoc();
					  
						  echo "<tr><td> <a href='class.php?classID=".$row1['class_id']."'><span class='normaltext'>" . $row1['class_name'] . "</span></a></td>";	   
						   echo "<td class='normaltext'> " . $row1['userCount'] . "</td>";
						   echo "<td class='normaltext'> " . $row4['articleCount'] . " Articles, " . $row5['activityCount'] . " Activities </td>";
						   echo "<td class='normaltext'>" .  $row3['last_name']. " ". $row3['first_name'] . "</td>";
						   echo "<td class='normaltext'>" . $row3['user_email'] . "</td>";
						   echo "<td class='normaltext'>" .  $row2['last_name']. " ". $row2['first_name'] . "</td>";
						   echo "<td class='normaltext'>" . $row2['user_email'] . "</td></tr>";
					  }
					  //echo "<tr><td>Total</td><td colspan='5'>" . $row1['totusers'] . "</td></tr>";
                    }
					} 
                  echo "
                </tbody></table>";		
		
}


if($classVardrop ==1 && $_POST['classValuedrop']=='Allclass')	{	
$stmt = $mysqli->prepare("SELECT Distinct(b.level_id), level from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id inner join edu_levels c on b.level_id=c.level_id where b.school_id=? and a.user_type_id=? ");
                $stmt->bind_param("ss", $param_school_id,$param_user_type_id);
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
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
                      $stmt1 = $mysqli->prepare("SELECT b.class_id, COUNT(b.user_id) AS userCount, class_name from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id inner join edu_class c on b.class_id=c.class_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=?  group by b.class_id");
                      $stmt1->bind_param("ssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id);
					  $param_status =$active;
					  $param_school_id=$school_id;
					  $param_user_type_id=3;
					  $param_level_id = $row['level_id'];
                      $stmt1->execute();
                      $result1 = $stmt1->get_result();
                      while ($row1 = $result1->fetch_assoc()) {
					  
					      $stmt2 = $mysqli->prepare("Select first_name, last_name,user_email from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=?");
						
						/* Set parameters */
						$stmt2->bind_param("sssss", $param_status,$param_school_id,$param_user_type_id,$param_level_id,$param_class_id);
					    $param_status =$active;
					    $param_school_id=$school_id;
					    $param_user_type_id=2;
					    $param_level_id = $row['level_id'];
					    $param_class_id = $row1['class_id'];
						$stmt2->execute();
						$result2 = $stmt2->get_result();
                        $row2 = $result2->fetch_assoc();
						
						$stmt3 = $mysqli->prepare("Select first_name, last_name,user_email from edu_users a INNER JOIN edu_school_subscription b on a.user_id=b.user_id where a.user_status=? and b.school_id=? and a.user_type_id=? and b.level_id=? and b.class_id=?");
						
						/* Set parameters */
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
					  
						  echo "<tr><td> <a href='class.php?classID=".$row1['class_id']."'><span class='normaltext'>" . $row1['class_name'] . "</span></a></td>";	   
						   echo "<td class='normaltext'> " . $row1['userCount'] . "</td>";
						   echo "<td class='normaltext'> " . $row4['articleCount'] . " Articles, " . $row5['activityCount'] . " Activities </td>";
						   echo "<td class='normaltext'>" .  $row3['last_name']. " ". $row3['first_name'] . "</td>";
						   echo "<td class='normaltext'>" . $row3['user_email'] . "</td>";
						   echo "<td class='normaltext'>" .  $row2['last_name']. " ". $row2['first_name'] . "</td>";
						   echo "<td class='normaltext'>" . $row2['user_email'] . "</td></tr>";
					  }
					  //echo "<tr><td>Total</td><td colspan='5'>" . $row1['totusers'] . "</td></tr>";
                    } 
                  echo "
                </tbody></table>";		
		
}
?>
