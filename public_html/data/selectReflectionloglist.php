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
$reflectionLog = !empty($_POST['reflectionLog'])?$_POST['reflectionLog']:0;
$refl_id = !empty($_POST['refl_id'])?$_POST['refl_id']:0;

   if($reflectionLog > 0)
	{
			
			/*if ($stmt = $mysqli->prepare("SELECT b.article_title, a.ques, count(review_id) as review, a.mag_id, a.art_id,a.act_id FROM edu_review a inner join edu_article b on a.art_id=b.article_id GROUP BY a.ques")) {*/    
			if ($stmt = $mysqli->prepare("SELECT a.id, b.article_title, a.ques, count(response) as response, a.mag_id, a.art_id,a.act_id FROM edu_reflection a inner join edu_article b on a.art_id=b.article_id GROUP BY a.ques")) {    
			 
			  
			 //$stmt->bind_param("s", $param_teach_id);
			// $param_teach_id = $_SESSION['id'];	
			 
			 $stmt->execute();
			 /* bind variables to prepared statement */
			 $stmt->bind_result($id, $article_title,$ques, $response, $mag_id, $art_id, $act_id);
			 $sr =1;
			 echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
												<thead>
													<tr><th><input type='checkbox' id='select_all'> Select </th>
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
				 $refLoglink = "reflection-logdetail.php?artID=".$art_id."&actID=".$act_id."&magID=".$mag_id;
				  if($ques == '') {$ques="";
				  
				  echo "<td colspan='7' align='center'> <span class='normaltext'>No entries to show</span></td>";
				  }	else {
					   echo "<td><input type='checkbox' class='refl_checkbox' data-refl-id='" .$id.  "'></td>";
					   echo "<td class='normaltext'><a href='".$magLink."'>" . $article_title . "</a></td>";
					   echo "<td class='normaltext'><a href='".$magLink."'>" . $ques ."</a></td>";
					   echo "<td class='normaltext'><a href='".$refLoglink."'>" . $response ."</a></td>";
				  }	
				  
					 echo "</tr>" ;
							$sr++;
			}
			
			echo "
												</tbody>    
											  </table>";
	 }									
	 
	}
	
if($refl_id > 0)
	{
	  $stmt = $mysqli->prepare("UPDATE edu_reflection SET status = ? WHERE id = ?");	
	  $stmt->bind_param("ss", $param_status,$param_id);    
	  $param_status = $_POST["revStatus"];
	  $param_id =$refl_id;
	  if($stmt->execute()){
	     
	  }
	  $stmt->close();
	}
