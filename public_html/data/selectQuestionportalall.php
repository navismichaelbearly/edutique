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



if($_POST['quesPort'] == 1)
{
 if ($stmt = $mysqli->prepare("SELECT b.id,a.first_name, b.content, b.publish_date,a.last_name,b.parent_qp_id, b.qp_to, b.qp_by, b.art_id, b.act_id,b.qp_answered,d.class_name FROM edu_users a INNER JOIN edu_question_portal b ON a.user_id=b.qp_by inner join edu_user_school_level_class c on b.qp_by=c.user_id inner join edu_class d on c.class_id=d.class_id where b.status=? and b.qp_to=? and parent_qp_id=? group by b.id")) {
  $stmt->bind_param("sss", $param_status,$param_user_id,$param_parent_qp_id);
  $param_status = $active;
		   $param_user_id  = $_POST['userId'];
           $param_parent_qp_id = 0;
	 
	 $stmt->execute();
	 /* bind variables to prepared statement */
	 $stmt->bind_result($refId,$first_name,$content,$publish_date,$last_name,$parent_qp_id,$qp_to, $qp_by, $art_id, $act_id, $qp_answered, $class_name);
	 $sr =1;
	 echo "<table id='example' class='table table-striped table-bordered' style='width:100%'>
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Sent By</th>
                                                <th>Question</th>
                                                <th>Published Date</th>
												<th>Answered</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										";
                                            
	 /* fetch values */
	 while ($stmt->fetch()) {
	      echo "<tr>";
		  if($publish_date !=""){	
		     $newDate = date("d M Y", strtotime($publish_date));
		  }else {
		  	 $newDate="";
	      }
		 
		  if($qp_answered!=1){
		     $checkbox= "";
			 $disabled ="";
		  } else {
		     $checkbox= "checked";
			 $disabled ="disabled";
		  }
		  
		  if($refId == 0) {$refId="";
		  echo "";
		  echo "<td colspan='5' align='center'> <span class='normaltext'>No entries to show</span></td>";
		  }	else {
		       echo "<td>" . $sr . "</td>";	   
			   echo "<td class='normaltext'><a href='question-portal.php?qpId=".$refId."&qp_to=".$qp_to."&qp_by=".$qp_by."&art_id=".$art_id."&act_id=".$act_id."' style='color:#323c47; text-decoration:none'> " . $last_name . " " . $first_name." : Class ".$class_name."</a></td>";
			   echo "<td class='normaltext'><a href='question-portal.php?qpId=".$refId."&qp_to=".$qp_to."&qp_by=".$qp_by."&art_id=".$art_id."&act_id=".$act_id."' style='color:#323c47; text-decoration:none'> " . $content . "</a></td>";
		       echo "<td class='normaltext'><a href='question-portal.php?qpId=".$refId."&qp_to=".$qp_to."&qp_by=".$qp_by."&art_id=".$art_id."&act_id=".$act_id."' style='color:#323c47; text-decoration:none'>" . $newDate . "</a></td>";
			   echo "<td class='normaltext'><input type='checkbox' name='qpStatuschange' id='qpStatuschange'  data-id='" . $refId ."' ".$checkbox."  ></td>";
		  }	
	      
		     echo "</tr>" ;
					$sr++;
	}
	
	echo "
                                        </tbody>    
                                      </table>";
 }					
}else{	
if($_POST['selectqplogid'] == 'All' ){ 
    $mesageVal = '';
	$searchVar ='';
 }else if($_POST['selectqplogid'] == 1 || $_POST['selectqplogid'] == 0) {
    $mesageVal = $_POST['selectqplogid'];
	$searchVar = " AND b.qp_answered=?";
 }

 if ($stmt = $mysqli->prepare("SELECT b.id,a.first_name, b.content, b.publish_date,a.last_name,b.parent_qp_id, b.qp_to, b.qp_by, b.art_id, b.act_id,b.qp_answered,d.class_name FROM edu_users a INNER JOIN edu_question_portal b ON a.user_id=b.qp_by inner join edu_user_school_level_class c on b.qp_by=c.user_id inner join edu_class d on c.class_id=d.class_id where b.status=? and b.qp_to=? and parent_qp_id=?".$searchVar. "  group by b.id")) {
     
	 
	  if($_POST['selectqplogid'] == 'All'){ 
			$stmt->bind_param("sss", $param_status,$param_user_id,$param_parent_qp_id);
	   }else if($_POST['selectqplogid'] == 1 || $_POST['selectqplogid'] == 0) {
			$stmt->bind_param("ssss", $param_status,$param_user_id,$param_parent_qp_id,$param_qp_answered);
			$param_qp_answered  = $mesageVal;
	   }
		   $param_status = $active;
		   $param_user_id  = $_POST['userId'];
           $param_parent_qp_id = 0;
	 
	 $stmt->execute();
	 /* bind variables to prepared statement */
	 $stmt->bind_result($refId,$first_name,$content,$publish_date,$last_name,$parent_qp_id,$qp_to, $qp_by, $art_id, $act_id, $qp_answered, $class_name);
	 $sr =1;
	 echo "<table id='example' class='table table-striped table-bordered' style='width:100%'>
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Sent By</th>
                                                <th>Question</th>
                                                <th>Published Date</th>
												<th>Answered</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										";
                                            
	 /* fetch values */
	 while ($stmt->fetch()) {
	      echo "<tr>";
		  if($publish_date !=""){	
		     $newDate = date("d M Y", strtotime($publish_date));
		  }else {
		  	 $newDate="";
	      }
		 
		  if($qp_answered!=1){
		     $checkbox= "";
			 $disabled ="";
		  } else {
		     $checkbox= "checked";
			 $disabled ="disabled";
		  }
		  
		  if($refId == 0) {$refId="";
		  
		  echo "<td colspan='5' align='center'> <span class='normaltext'>No entries to show</span></td>";
		  }	else {
		       echo "<td>" . $sr . "</td>";	   
			   echo "<td class='normaltext'><a href='question-portal.php?qpId=".$refId."&qp_to=".$qp_to."&qp_by=".$qp_by."&art_id=".$art_id."&act_id=".$act_id."' style='color:#323c47; text-decoration:none'> " . $last_name . " " . $first_name." : Class ".$class_name."</a></td>";
			   echo "<td class='normaltext'><a href='question-portal.php?qpId=".$refId."&qp_to=".$qp_to."&qp_by=".$qp_by."&art_id=".$art_id."&act_id=".$act_id."' style='color:#323c47; text-decoration:none'> " . $content . "</a></td>";
		       echo "<td class='normaltext'><a href='question-portal.php?qpId=".$refId."&qp_to=".$qp_to."&qp_by=".$qp_by."&art_id=".$art_id."&act_id=".$act_id."' style='color:#323c47; text-decoration:none'>" . $newDate . "</a></td>";
			   echo "<td class='normaltext'><input type='checkbox' name='qpStatuschange' id='qpStatuschange'  data-id='" . $refId ."' ".$checkbox."  ></td>";
		  }	
	      
		     echo "</tr>" ;
					$sr++;
	}
	
	echo "
                                        </tbody>    
                                      </table>";
 }						
 
}

?>
