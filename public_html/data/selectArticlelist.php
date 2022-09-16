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
$varDuedate ="";
if($_POST['artTitle'] != "")
{
 foreach ($_POST['artTitle'] as $key => $value) {
  $value;  
 }
 $magVar ="order by a.article_title ".$value;
 $varUser ="";
 $varDuedate="";
}else if($_POST['artDate'] != ""){
  foreach ($_POST['artDate'] as $key => $value) {
    $value;  
  }
   $magVar ="order by a.article_published_date ".$value;
   $varUser ="";
   $varDuedate="";
}else if($_POST['dueDate'] != ""){
  foreach ($_POST['dueDate'] as $key => $value) {
    $value;  
  }
   $varUser ="inner join edu_task g on a.article_id= g.article_id inner join edu_user_task l on e.user_id = l.assigned_to";
   if($_POST['dueDate'] == "Month"){
      $varDuedate ="and MONTH(g.due_date) = MONTH(CURRENT_DATE()) AND YEAR(g.due_date) = YEAR(CURRENT_DATE())";
   }else if	 ($_POST['dueDate'] == "Week"){
      $varDuedate ="and YEARWEEK(g.due_date, 1) = YEARWEEK(CURDATE(), 1)";
   } 
   $magVar="";

}else if($_POST['essayType'] != ""){
  $value1='';
  foreach ($_POST['essayType'] as $key => $value) {
    $value; 
	$value1 .= "'" . $value."', "; 
	$check_e = rtrim($value1,", ");
  }
   $varUser =" inner join edu_essay_type h on a.essay_type_id= h.essay_type_id ";   
   $magVar="";
   $varDuedate =" and h.essay_type_id  IN (".$check_e.")"; 
}else if($_POST['artLD'] != ""){
  $value1='';
  foreach ($_POST['artLD'] as $key => $value) {
    $value; 
	$value1 .= "'" . $value."', "; 
	$check_e = rtrim($value1,", ");
  }
   $varUser ="";   
   $magVar="";
   $varDuedate =" and a.difficulty_level  IN (".$check_e.")"; 
}
else{
  $magVar = " ";
  $varUser ="";
  $varDuedate="";
}

if($_POST['mag'] != '')
{
  if ($stmt = $mysqli->prepare("SELECT a.article_id,a.article_path,a.article_title, a.article_published_date, b.mag_title, b.mag_issue,b.mag_published_date,b.mag_image_path, d.mag_type,a.article_image, a.mag_id, a.description,a.difficulty_level, a.author,a.theme,a.topic_words from edu_article a inner join edu_magazine b on a.mag_id=b.mag_id inner join edu_mag_type d on b.mag_type_id = d.mag_type_id inner join edu_school_subscription e on a.article_id=e.article_id and a.mag_id=e.mag_id inner join edu_user_school_level_class f on e.school_id = f.school_id ".$varUser."  where a.article_status=? and b.mag_status=? and d.mag_type_status= ? and f.user_id=? and e.activity_id=? ".$varDuedate." group by a.article_id,f.user_id ".$magVar)) {
	
	
		
	 $stmt->bind_param("sssss", $param_status, $param_status2, $param_status3, $param_user_id, $param_activity_id);
		 // Set parameters 
	 $param_status = $active;
	 $param_status2 = $active;
	 $param_status3 = $active;
	 $param_user_id = $_SESSION['id'];
	 $param_activity_id =0;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($article_id,$article_path,$article_title, $article_published_date, $mag_title, $mag_issue, $mag_published_date, $mag_image_path, $mag_type, $article_image, $magID, $description, $difficulty_level, $author,$theme,$topic_words);
	 $sr =1;
	 echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
												<thead>
													<tr><td>No.</td>
														<th>Article</th>
														<th>Issue</th>
														<th>Theme</th>
														<th>Difficulty Level</th>
														<th>Keywords</th>
														<th>Author</th>
													</tr>
												</thead>
												<tbody>
												";
	 while ($stmt->fetch()) {
	     if($mag_type=='i-Magazine') {$mag_type= 'i';}
	    /* echo  "<div class='col-md-3 normaltext' align='center'><div class='img__wrap'><a href='article-detail.php?artID=".$article_id."&actID=0&magID=".$magID."'><img src='".$article_image."' width='200' height='265' class='img__img' style='border:1px solid #CCCCCC'></a><div class='middleImg'>
    <div class='img__description_layer'>
    <p class='img__description'>".$description."</p>
  </div></div>
  </div><br><br>".$article_title."<br>".$mag_type.$mag_issue."</div>";*/
  $stringContent = strlen($description) > 50 ? substr($description,0,70)."..." : $description;
  echo "<tr><td style='vertical-align:middle'>".$sr."</td>";
		       echo "<td class='normaltext'><div class='img__wrap'><a href='article-detail.php?artID=".$article_id."&actID=0&magID=".$magID."'><img src='".$article_image."' width='100' height='133' class='img__img' style='border:1px solid #CCCCCC'></a><div class='middleImg'>
    <div class='img__description_layer'>
     <a href='article-detail.php?artID=".$article_id."&actID=0&magID=".$magID."' style='color:#ffffff; text-decoration:none'><p class='img__description'>".$stringContent."</p></a>
  </div></div>
  </div><br>" . $article_title ."</td>";
					   echo "<td class='normaltext' style='vertical-align:middle'>" . $mag_type." ".$mag_issue ."</td>";
					   echo "<td class='normaltext' style='vertical-align:middle'>" . $theme ."</td>";
					   echo "<td class='normaltext' style='vertical-align:middle'>" . $difficulty_level."</td>";
					   echo "<td class='normaltext' style='vertical-align:middle'>" . $topic_words ."</td>";
					   echo "<td class='normaltext' style='vertical-align:middle'>" . $author ."</td>";
		  echo "</tr>" ;
		
		 $sr++;
	 }
        	
	}
}




?>