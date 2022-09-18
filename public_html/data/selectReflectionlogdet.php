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
		

$mag_id = !empty($_POST['mag_id'])?$_POST['mag_id']:'';	
$art_id = !empty($_POST['art_id'])?$_POST['art_id']:'';	
$act_id = !empty($_POST['act_id'])?$_POST['act_id']:'';		
if($_POST['reflectionLog'] != '')
{
	if($_SESSION["utypeid"] == $admconst){
	   $var ="";
	}else{
	   $var ="WHERE teach_id=?";
	}   	
		
		if ($stmt = $mysqli->prepare("SELECT b.article_title, a.ques, count(response) as response, a.mag_id, a.art_id,a.act_id FROM edu_reflection a inner join edu_article b on a.art_id=b.article_id ".$var."  GROUP BY a.ques")) {    
		 
		 if($_SESSION["utypeid"] == $admconst){
			   
			}else{
			   $stmt->bind_param("s", $param_teach_id);
		       $param_teach_id = $_SESSION['id'];	
			}  
		 
		 
		 $stmt->execute();
		 /* bind variables to prepared statement */
		 $stmt->bind_result($article_title,$ques, $response, $mag_id, $art_id, $act_id);
		 $sr =1;
		 echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
											<thead>
												<tr>
													<th>Title</th>
													<th>Question</th>
													<th>No. of Responses</th>
												</tr>
											</thead>
											<tbody>
											";
												
		 /* fetch values */
		 while ($stmt->fetch()) {
			  echo "<tr>";
			 $magLink = "article-detail.php?artID=".$art_id."&actID=".$act_id."&magID=".$mag_id;	
			  if($ques == '') {$ques="";
			  
			  echo "<td colspan='7' align='center'> <span class='normaltext'>No entries to show</span></td>";
			  }	else {
				   
				   echo "<td class='normaltext'><a href='".$magLink."'>" . $article_title . "</a></td>";
				   echo "<td class='normaltext'><a href='".$magLink."'>" . $ques ."</a></td>";
				   echo "<td class='normaltext'>" . $response ."</td>";
			  }	
			  
				 echo "</tr>" ;
						$sr++;
		}
		
		echo "
											</tbody>    
										  </table>";
 }									
 
}


if($mag_id != '' && $art_id !=''  && $_POST['reflectionLog'] == '')
{
		if($_SESSION["utypeid"] == $admconst){
		   $var2 ="";
		}else{
		   $var2 ="WHERE teach_id=?";
		}   
		
		if ($stmt = $mysqli->prepare("SELECT b.article_title, a.response, a.mag_id, a.art_id,a.act_id,submitted_on, c.first_name, c.last_name, class_name FROM edu_reflection a inner join edu_article b  on a.art_id=b.article_id inner join edu_users c on a.stud_id=c.user_id inner join edu_class d on a.class_id=d.class_id ".$var2)) {    
		 if($_SESSION["utypeid"] == $admconst){
			   
			}else{
			   $stmt->bind_param("s", $param_teach_id);
		 $param_teach_id = $_SESSION['id'];		
			}  
		  
		 
		 
		 $stmt->execute();
		 /* bind variables to prepared statement */
		 $stmt->bind_result($article_title,$response, $mag_id, $art_id, $act_id, $submitted_on, $first_name, $last_name, $class_name);
		 $sr =1;
		 echo "<table id='example1' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
											<thead>
												<tr>
													<th>Name</th>
													<th>Class</th>
													<th>Reflection Responses</th>
													<th>Submitted On</th>
												</tr>
											</thead>
											<tbody>
											";
												
		 /* fetch values */
		 while ($stmt->fetch()) {
			  echo "<tr>";
			 	
			  if($response == '') {$response="";
			  
			  echo "<td colspan='7' align='center'> <span class='normaltext'>No entries to show</span></td>";
			  }	else {
				   
				   echo "<td class='normaltext'>" . $last_name. " ".$first_name . "</td>";
				   echo "<td class='normaltext'>".$class_name."</td>";
				   echo "<td class='normaltext'>" . $response ."</td>";
				   echo "<td class='normaltext'>" . $submitted_on ."</td>";
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
