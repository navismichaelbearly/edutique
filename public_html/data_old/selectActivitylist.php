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
if($_POST['actTitle'] != "")
{
 foreach ($_POST['actTitle'] as $key => $value) {
  $value;  
 }
 $magVar ="order by a.activity_title ".$value;
 $varUser ="";
 $varDuedate="";
}else if($_POST['actDate'] != ""){
  foreach ($_POST['actDate'] as $key => $value) {
    $value;  
  }
   $magVar ="order by a.activity_published_date ".$value;
   $varUser ="";
 $varDuedate="";
}else if($_POST['dueDate'] != ""){
  foreach ($_POST['dueDate'] as $key => $value) {
    $value;  
  }
   $varUser ="inner join edu_task g on a.activity_id= g.activity_id inner join edu_user_task l on e.user_id = l.assigned_to";
   if($_POST['dueDate'] == "Month"){
      $varDuedate ="and MONTH(g.due_date) = MONTH(CURRENT_DATE()) AND YEAR(g.due_date) = YEAR(CURRENT_DATE())";
   }else if	 ($_POST['dueDate'] == "Week"){
      $varDuedate ="and YEARWEEK(g.due_date, 1) = YEARWEEK(CURDATE(), 1)";
   } 
   $magVar="";

}else if($_POST['actType'] != ""){
  $value1='';
  foreach ($_POST['actType'] as $key => $value) {
    $value; 
	$value1 .= "'" . $value."', "; 
	$check_e = rtrim($value1,", ");
  }
   $varUser =" inner join edu_activity_type h on a.activity_type_id= h.activity_type_id ";   
   $magVar="";
   $varDuedate =" and h.activity_type_id  IN (".$check_e.")"; 
}
else{
  $magVar = " ";
  $varUser ="";
  $varDuedate="";
}

/*if($_POST['actType'] != ""){
  foreach ($_POST['actType'] as $key => $value) {
    $typeV =" and activity_type_id =?"; 
  }
   $typeV =" ";
}*/

if($_POST['mag'] != '')
{
  if ($stmt = $mysqli->prepare("SELECT a.article_id,a.activity_id,a.activity_path,a.activity_title, a.activity_published_date, b.mag_title, b.mag_issue,b.mag_published_date,b.mag_image_path, d.mag_type,a.image_path, a.mag_id, a.activity_content, a.theme, a.difficulty_level, a.author, a.topic_words from edu_activity a inner join edu_magazine b on a.mag_id=b.mag_id inner join edu_mag_type d on b.mag_type_id = d.mag_type_id inner join edu_school_subscription e on a.activity_id=e.activity_id and a.mag_id=e.mag_id inner join edu_user_school_level_class f on e.school_id = f.school_id ".$varUser." where a.activity_status=? and b.mag_status=? and d.mag_type_status= ? and f.user_id=? and e.activity_id !=? ".$varDuedate." group by a.activity_id,f.user_id ".$magVar)) {
	
	
		
	$stmt->bind_param("sssss", $param_status, $param_status2, $param_status3, $param_user_id, $param_activity_id);
		 // Set parameters 
	 $param_status = $active;
	 $param_status2 = $active;
	 $param_status3 = $active;
	 $param_user_id = $_SESSION['id'];
	 $param_activity_id =0;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($article_id,$activity_id,$activity_path,$activity_title, $activity_published_date, $mag_title, $mag_issue, $mag_published_date, $mag_image_path, $mag_type, $activity_image, $magID, $activity_content, $theme, $difficulty_level, $author, $topic_words);
	 $sr =1;
	  echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
   <thead>
     <tr>
		 <th>No.</th>
       <th>Activities</th>
       <th>Issue No</th>
       <th>Theme</th>
       <th>Difficulty Level</th>
       <th>Author</th>
     </tr>
   </thead>
   <tbody>
   ";
	 while ($stmt->fetch()) {
	     if($mag_type=='i-Magazine') {$mag_type= 'i';}
	     /*echo  "<div class='col-md-2-5 normaltext' align='center'><a href='activity-detail.php?artID=".$article_id."&actID=".$activity_id."&magID=".$magID."'><img src='".$activity_image."' width='200' height='265' style='border:1px solid #CCCCCC'></a><br><br>".$activity_title."<br>".$mag_type.$mag_issue."</div>";*/
		 
		 echo "<tr><td style='vertical-align:middle'>" . $sr . "</td>";
        echo "<td class='normaltext'><div class='img__wrap'><a href='activity-detail.php?actID=" . $activity_id . "&artID=" . $article_id . "&magID=" . $magID . "'><img src='" . $activity_image . "' width='100' height='133' class='img__img' style='border:1px solid #CCCCCC'></a><div class='middleImg'>
            <div class='img__description_layer'>
            <a href='activity-detail-admin.php?actID=" . $activity_id . "&artID=" . $article_id . "&magID=" . $magID . "' style='color:#ffffff; text-decoration:none'> <p class='img__description'></p></a>
            </div></div>
            </div><br>" . $activity_title . "</td>";
        echo "<td class='normaltext' style='vertical-align:middle'>" . $mag_type . " " . $mag_issue . "</td>";
        echo "<td class='normaltext' style='vertical-align:middle'>" . $theme . "</td>";
        echo "<td class='normaltext' style='vertical-align:middle'>" . $difficulty_level . "</td>";
        echo "<td class='normaltext' style='vertical-align:middle'>" . $author . "</td>";
        //echo "<td style='vertical-align:middle'><span>&nbsp;&nbsp;<i class='material-icons-outlined md-16 annocom' id='actDel' data-id='" . $activity_id . "'>delete</i></span></td>";
        echo "</tr>";
		
		 $sr++;
	 }
        	
	}
}




?>