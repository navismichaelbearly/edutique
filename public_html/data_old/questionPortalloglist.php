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
$questionPortalLog = !empty($_POST['questionPortalLog'])?$_POST['questionPortalLog']:0;
$questionPortalLogschool = !empty($_POST['questionPortalLogschool'])?$_POST['questionPortalLogschool']:0;
if($_SESSION["utypeid"]==$admconst){
   if($questionPortalLog == 1)
	{
			
			
			if ($stmt = $mysqli->prepare("SELECT b.id,b.content, b.publish_date,b.parent_qp_id, b.qp_to, b.qp_by, b.art_id, b.act_id,b.qp_answered,d.class_name FROM  edu_question_portal b  inner join edu_user_school_level_class c on b.qp_by=c.user_id inner join edu_class d on c.class_id=d.class_id where b.status=?  and parent_qp_id=? group by b.id")) {
  $stmt->bind_param("ss", $param_status,$param_parent_qp_id);
  $param_status = $active;
		   
           $param_parent_qp_id = 0;
	 
	 $stmt->execute();
	 $result = $stmt->get_result();
	 /* bind variables to prepared statement */
	// $stmt->bind_result($refId,$first_name,$content,$publish_date,$last_name,$parent_qp_id,$qp_to, $qp_by, $art_id, $act_id, $qp_answered, $class_name);
	 $sr =1;
	 echo "<table id='example' class='table table-striped table-bordered' style='width:100%'>
                                        <thead>
                                            <tr><th><input type='checkbox' id='select_all'> Select </th>
                                                <th>No.</th>
                                                <th>Sent By</th>
												<th>Sent To</th>
                                                <th>Question</th>
                                                <th>Sent Date</th>
												<th>Answered</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										";
                                            
	 /* fetch values */
	 while ($row = $result->fetch_assoc()) {
	                    $stmt2 = $mysqli->prepare("Select first_name, last_name from edu_users a INNER JOIN edu_question_portal b on a.user_id=b.qp_by where b.id=?");					
						$stmt2->bind_param("s", $param_id);
						$param_id =$row['id'];
						$stmt2->execute();
						$result2 = $stmt2->get_result();
                        $row2 = $result2->fetch_assoc();
						
						$stmt3 = $mysqli->prepare("Select first_name, last_name from edu_users a INNER JOIN edu_question_portal b on a.user_id=b.qp_to where b.id=?");					
						$stmt3->bind_param("s", $param_id);
						$param_id =$row['id'];
						$stmt3->execute();
						$result3 = $stmt3->get_result();
                        $row3 = $result3->fetch_assoc();
	      echo "<tr>";
		  if($row['publish_date'] !=""){	
		     $newDate = date("d M Y", strtotime($row['publish_date']));
		  }else {
		  	 $newDate="";
	      }
		 
		  if($row['qp_answered']!=1){
		     $checkbox= "";
			 $disabled ="";
		  } else {
		     $checkbox= "checked";
			 $disabled ="disabled";
		  }
		  
		  if($row['id'] == 0) {$row['id']="";
		  echo "";
		  echo "<td colspan='5' align='center'> <span class='normaltext'>No entries to show</span></td>";
		  }	else {
		       echo "<td><input type='checkbox' class='rev_checkbox' data-rev-id='" . $row['id'] . "'>";
		       echo "<td>" . $sr . "</td>";	   
			   echo "<td class='normaltext'><a href='question-portal.php?qpId=".$row['id']."&qp_to=".$row['qp_to']."&qp_by=".$row['qp_by']."&art_id=".$row['art_id']."&act_id=".$row['act_id']."' style='color:#323c47; text-decoration:none'> " . $row2['last_name'] . " " . $row2['first_name']." : Class ".$row['class_name']."</a></td>";
			   echo "<td class='normaltext'><a href='question-portal.php?qpId=".$row['id']."&qp_to=".$row['qp_to']."&qp_by=".$row['qp_by']."&art_id=".$row['art_id']."&act_id=".$row['act_id']."' style='color:#323c47; text-decoration:none'> " . $row3['last_name'] . " " . $row3['first_name']."</a></td>";
			   echo "<td class='normaltext'><a href='question-portal.php?qpId=".$row['id']."&qp_to=".$row['qp_to']."&qp_by=".$row['qp_by']."&art_id=".$row['art_id']."&act_id=".$row['act_id']."' style='color:#323c47; text-decoration:none'> " . $row['content'] . "</a></td>";
		       echo "<td class='normaltext'><a href='question-portal.php?qpId=".$row['id']."&qp_to=".$row['qp_to']."&qp_by=".$row['qp_by']."&art_id=".$row['art_id']."&act_id=".$row['act_id']."' style='color:#323c47; text-decoration:none'>" . $newDate . "</a></td>";
			   echo "<td class='normaltext'><input type='checkbox' name='qpStatuschange' id='qpStatuschange'  data-id='" . $row['id'] ."' ".$checkbox." disabled ></td>";
		  }	
	      
		     echo "</tr>" ;
					$sr++;
	}
	
	echo "
                                        </tbody>    
                                      </table>";
 }				
	 
	}
	
	if($questionPortalLogschool == 1){
		if($_POST['schoolid']=='Allschool'){
		  $var ="SELECT b.id,b.content, b.publish_date,b.parent_qp_id, b.qp_to, b.qp_by, b.art_id, b.act_id,b.qp_answered,d.class_name FROM  edu_question_portal b  inner join edu_user_school_level_class c on b.qp_by=c.user_id inner join edu_class d on c.class_id=d.class_id where b.status=?  and parent_qp_id=? group by b.id";
		}else {
		  $var ="SELECT b.id,b.content, b.publish_date,b.parent_qp_id, b.qp_to, b.qp_by, b.art_id, b.act_id,b.qp_answered,d.class_name FROM  edu_question_portal b  inner join edu_user_school_level_class c on b.qp_by=c.user_id inner join edu_class d on c.class_id=d.class_id where b.status=? and parent_qp_id=? and c.school_id=? and qp_to !=? group by b.id";
		}
		if ($stmt = $mysqli->prepare($var)) {    
			 
			  if($_POST['schoolid']=='Allschool'){
				  $stmt->bind_param("ss", $param_status,$param_parent_qp_id);
                  $param_status = $active;		   
                  $param_parent_qp_id = 0; 
				}else {
				    $stmt->bind_param("ssss", $param_status,$param_parent_qp_id,$param_school_id,$param_qp_to);
                    $param_status = $active;		   
                    $param_parent_qp_id = 0;
					$param_school_id = $_POST['schoolid'];
					$param_qp_to=1;
				}
			
				
			 
			 
			 $stmt->execute();
			$result = $stmt->get_result();
	 /* bind variables to prepared statement */
	// $stmt->bind_result($refId,$first_name,$content,$publish_date,$last_name,$parent_qp_id,$qp_to, $qp_by, $art_id, $act_id, $qp_answered, $class_name);
	 $sr =1;
	 echo "<table id='example' class='table table-striped table-bordered' style='width:100%'>
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Sent By</th>
												<th>Sent To</th>
                                                <th>Question</th>
                                                <th>Sent Date</th>
												<th>Answered</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										";
                                            
	 /* fetch values */
	 while ($row = $result->fetch_assoc()) {
	                    $stmt2 = $mysqli->prepare("Select first_name, last_name from edu_users a INNER JOIN edu_question_portal b on a.user_id=b.qp_by where b.id=?");					
						$stmt2->bind_param("s", $param_id);
						$param_id =$row['id'];
						$stmt2->execute();
						$result2 = $stmt2->get_result();
                        $row2 = $result2->fetch_assoc();
						
						$stmt3 = $mysqli->prepare("Select first_name, last_name from edu_users a INNER JOIN edu_question_portal b on a.user_id=b.qp_to where b.id=?");					
						$stmt3->bind_param("s", $param_id);
						$param_id =$row['id'];
						$stmt3->execute();
						$result3 = $stmt3->get_result();
                        $row3 = $result3->fetch_assoc();
	      echo "<tr>";
		  if($row['publish_date'] !=""){	
		     $newDate = date("d M Y", strtotime($row['publish_date']));
		  }else {
		  	 $newDate="";
	      }
		 
		  if($row['qp_answered']!=1){
		     $checkbox= "";
			 $disabled ="";
		  } else {
		     $checkbox= "checked";
			 $disabled ="disabled";
		  }
		  
		  if($row['id'] == 0) {$row['id']="";
		  echo "";
		  echo "<td colspan='5' align='center'> <span class='normaltext'>No entries to show</span></td>";
		  }	else {
		       echo "<td>" . $sr . "</td>";	   
			   echo "<td class='normaltext'><a href='question-portal.php?qpId=".$row['id']."&qp_to=".$row['qp_to']."&qp_by=".$row['qp_by']."&art_id=".$row['art_id']."&act_id=".$row['act_id']."' style='color:#323c47; text-decoration:none'> " . $row2['last_name'] . " " . $row2['first_name']." : Class ".$row['class_name']."</a></td>";
			   echo "<td class='normaltext'><a href='question-portal.php?qpId=".$row['id']."&qp_to=".$row['qp_to']."&qp_by=".$row['qp_by']."&art_id=".$row['art_id']."&act_id=".$row['act_id']."' style='color:#323c47; text-decoration:none'> " . $row3['last_name'] . " " . $row3['first_name']."</a></td>";
			   echo "<td class='normaltext'><a href='question-portal.php?qpId=".$row['id']."&qp_to=".$row['qp_to']."&qp_by=".$row['qp_by']."&art_id=".$row['art_id']."&act_id=".$row['act_id']."' style='color:#323c47; text-decoration:none'> " . $row['content'] . "</a></td>";
		       echo "<td class='normaltext'><a href='question-portal.php?qpId=".$row['id']."&qp_to=".$row['qp_to']."&qp_by=".$row['qp_by']."&art_id=".$row['art_id']."&act_id=".$row['act_id']."' style='color:#323c47; text-decoration:none'>" . $newDate . "</a></td>";
			   echo "<td class='normaltext'><input type='checkbox' name='qpStatuschange' id='qpStatuschange'  data-id='" . $row['id'] ."' ".$checkbox." disabled ></td>";
		  }	
	      
		     echo "</tr>" ;
					$sr++;
	}
	
	echo "
                                        </tbody>    
                                      </table>";
	 }									
	}

}

?>
