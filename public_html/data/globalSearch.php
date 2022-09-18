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

$stmt = $mysqli->prepare("SELECT b.school_id FROM  edu_users a inner join edu_user_school_level_class b on a.user_id  = b.user_id  WHERE a.user_id = ? and a.user_status = ?");
/* Bind parameters */
$stmt->bind_param("ss", $param_uid,$param_urstatus);
/* Set parameters */
$param_uid = $_SESSION["id"];
$param_urstatus = $active;
$stmt->execute();
$stmt->bind_result($school_id);
$stmt->fetch();
$stmt->close();

if($_POST['mag'] != '' && $_POST['mag2'] == '' && $_POST['garticle'] == '' && $_POST['gactivity'] == '' && $_POST['gall'] == '' && $_POST['gwordbank'] == '' && $_POST['gusers'] == '')
{



  if ($stmt = $mysqli->prepare("SELECT DISTINCT(a.article_title), a.article_image,a.article_id,a.mag_id FROM edu_article a inner join edu_school_subscription b on a.article_id = b.article_id where b.school_id =? and b.school_subscription_status=? and b.subscription_end_date > ? and (a.article_title like ? or a.article_content like ?) and b.activity_id=?")) {
		
	 $stmt->bind_param("ssssss", $param_school_id, $param_school_subscription_status, $param_subscription_end_date, $param_article_title, $param_article_content, $param_activity_id);
		 // Set parameters 
	 $param_school_id = $school_id;
	 $param_school_subscription_status = $active;
	 $param_subscription_end_date = $todaysDate; 
	 $param_article_title = "%{$_POST['gsearch']}%";
	 $param_article_content = "%{$_POST['gsearch']}%";
	 $param_activity_id = 0;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($article_title, $article_image, $article_id, $mag_id);
	 
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<p style='font-size:16px'>Articles(".$total_rows.")</p>";}
	 $sr =1;
	 echo "<div class='row'>";
	 while ($stmt->fetch()) {
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	     echo  "<div class='col-md-2-5 normaltext' align='center' style='margin:0 20px 20px 0; padding:10px; background-color:#ffffff'><a href='article-detail.php?artID=".$article_id."&actID=0&magID=".$mag_id."'><img src='".$article_image."' width='200' height='265' style='border:1px solid #CCCCCC; margin-bottom:5px;'></a><br>".$article_title."</div>";
		
		 $sr++;
	 }
        	
	}
	echo "</div>";
	//------------- for activity--------------------------
	if ($stmt = $mysqli->prepare("SELECT DISTINCT(a.activity_title), a.image_path,a.article_id,a.mag_id,a.activity_id FROM edu_activity a inner join edu_school_subscription b on a.activity_id = b.activity_id where b.school_id =? and b.school_subscription_status=? and b.subscription_end_date > ? and (a.activity_title like ? or a.activity_content like ?) and b.activity_id!=?")) {
		
	 $stmt->bind_param("ssssss", $param_school_id, $param_school_subscription_status, $param_subscription_end_date, $param_activity_title, $param_activity_content, $param_activity_id);
		 // Set parameters 
	 $param_school_id = $school_id;
	 $param_school_subscription_status = $active;
	 $param_subscription_end_date = $todaysDate; 
	 $param_activity_title = "%{$_POST['gsearch']}%";
	 $param_activity_content = "%{$_POST['gsearch']}%";
	 $param_activity_id = 0;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($activity_title, $activity_image, $article_id, $mag_id, $activity_id);
	 
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<p style='font-size:16px'>Activities(".$total_rows.")</p>";}
	 $sr =1;
	  echo "<div class='row'>";
	 while ($stmt->fetch()) {
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	     echo  "<div class='col-md-2-5 normaltext' align='center' style='margin:0 20px 20px 0; padding:10px; background-color:#ffffff'><a href='activity-detail.php?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id."'><img src='".$activity_image."' width='200' height='265' style='border:1px solid #CCCCCC; margin-bottom:5px;'></a><br>".$activity_title."</div>";
		
		 $sr++;
	 }
        	
	}
	echo "</div>";
	
	//------------- for wordbank--------------------------
	if ($stmt = $mysqli->prepare("SELECT a.wname, c.wordbank_type,a.foldnameid, a.wordbank_typeid,b.folder_color FROM edu_wordbank a inner join edu_wordfolder b on a.foldnameid = b.id inner join edu_wordbank_type c on c.id = a.wordbank_typeid where a.added_by =? and wstatus=? and a.wname like ? ")) {
		
	 $stmt->bind_param("sss", $param_added_by, $param_wstatus, $param_wname);
		 // Set parameters 
	 $param_added_by = $_SESSION["id"];
	 $param_wstatus = $active;
	 $param_wname = "%{$_POST['gsearch']}%";
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($wname, $foldname, $foldnameid, $wordbank_typeid, $folder_color );
	 
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<div style='font-size:16px'>Word Bank(".$total_rows.")</div>";}
	 $sr =1;
	  echo "<div class='row' style='padding-left:15px; font-size:12px;'><p>";
	 while ($stmt->fetch()) {
	    $folder_color1 = trim($folder_color,"#");
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	    echo  "<li><a href='detail-wordbank.php?fdId=".$foldnameid."&wbId=".$wordbank_typeid."&fdcol=".$folder_color1."' style='color:#323c47; text-decoration:none'>".$wname." in ".$foldname."</a></li>";
		
		 $sr++;
	 }
        	
	}
	echo "</p></div>";
	
	//------------- for users--------------------------
	if ($stmt = $mysqli->prepare("SELECT first_name, last_name, school_name, class_name,a.user_id,b.class_id FROM edu_users a inner join  edu_user_school_level_class b on a.user_id = b.user_id inner join edu_school c on b.school_id=c.school_id inner join edu_class d on b.class_id=d.class_id where b.school_id =?  and (a.first_name like ? or a.last_name like ?) and user_type_id=? group by first_name, last_name ")) {
		
	  $stmt->bind_param("ssss", $param_school_id,  $param_first_name, $param_last_name, $param_user_type_id);
		 // Set parameters 
	 $param_school_id = $school_id; 
	 $param_first_name = "%{$_POST['gsearch']}%";
	 $param_last_name = "%{$_POST['gsearch']}%";$param_user_type_id=3;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($first_name, $last_name, $school_name, $class_name,$user_id,$class_id);
	 
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<div style='font-size:16px'>Users(".$total_rows.")</div>";}
	 $sr =1;
	  echo "<div class='row' style='padding-left:15px; font-size:12px;'><p>";
	 while ($stmt->fetch()) {
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	    echo  "<li><a href='student-info.php?uid=".$user_id."&classID=".$class_id."' style='color:#323c47; text-decoration:none'>".$last_name." ".$first_name." in ".$school_name.": ".$class_name."</a></li>";
		
		 $sr++;
	 }
        	
	}
	echo "</p></div>";
}

if($_POST['mag2'] != '' && $_POST['mag'] == '' && $_POST['garticle'] == '' && $_POST['gactivity'] == '' && $_POST['gall'] == '' && $_POST['gwordbank'] == '' && $_POST['gusers'] == '')
{



  if ($stmt = $mysqli->prepare("SELECT DISTINCT(a.article_title), a.article_image, a.article_id, a.mag_id FROM edu_article a inner join edu_school_subscription b on a.article_id = b.article_id where b.school_id =? and b.school_subscription_status=? and b.subscription_end_date > ? and (a.article_title like ? or a.article_content like ?) and b.activity_id=?")) {
		
	 $stmt->bind_param("ssssss", $param_school_id, $param_school_subscription_status, $param_subscription_end_date, $param_article_title, $param_article_content, $param_activity_id);
		 // Set parameters 
	 $param_school_id = $school_id;
	 $param_school_subscription_status = $active;
	 $param_subscription_end_date = $todaysDate; 
	 $param_article_title = "%{$_POST['gsearch']}%";
	 $param_article_content = "%{$_POST['gsearch']}%";
	 $param_activity_id = 0;
	 $stmt->execute();
	  $stmt->store_result();
	 $total_rows = $stmt->num_rows;
		 /* bind variables to prepared statement */
	 $stmt->bind_result($article_title, $article_image, $article_id, $mag_id);
	 
	
	 $sr =1;
	  echo "<div class='row'>";
	 if($total_rows != 0){echo "<p style='font-size:16px'>Articles(".$total_rows.")</p>";}
	 while ($stmt->fetch()) {
	   if($total_rows != 0){  
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	     echo  "<div class='col-md-2-5 normaltext' align='center' style='margin:0 20px 20px 0; padding:10px; background-color:#ffffff'><a href='article-detail.php?artID=".$article_id."&actID=0&magID=".$mag_id."'><img src='".$article_image."' width='200' height='265' style='border:1px solid #CCCCCC; margin-bottom:5px;'></a><br>".$article_title."</div>";
		}
		 $sr++;
	 }
        	
	}
	echo "</div>";
	//------------- for activity--------------------------
	if ($stmt = $mysqli->prepare("SELECT DISTINCT(a.activity_title), a.image_path, a.article_id, a.mag_id, a.activity_id FROM edu_activity a inner join edu_school_subscription b on a.activity_id = b.activity_id where b.school_id =? and b.school_subscription_status=? and b.subscription_end_date > ? and (a.activity_title like ? or a.activity_content like ?) and b.activity_id!=?")) {
		
	 $stmt->bind_param("ssssss", $param_school_id, $param_school_subscription_status, $param_subscription_end_date, $param_activity_title, $param_activity_content, $param_activity_id);
		 // Set parameters 
	 $param_school_id = $school_id;
	 $param_school_subscription_status = $active;
	 $param_subscription_end_date = $todaysDate; 
	 $param_activity_title = "%{$_POST['gsearch']}%";
	 $param_activity_content = "%{$_POST['gsearch']}%";
	 $param_activity_id = 0;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($activity_title, $activity_image, $article_id, $mag_id, $activity_id);
	 
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<p style='font-size:16px'>Activities(".$total_rows.")</p>";}
	 $sr =1;
	  echo "<div class='row'>";
	 while ($stmt->fetch()) {
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	     echo  "<div class='col-md-2-5 normaltext' align='center' style='margin:0 20px 20px 0; padding:10px; background-color:#ffffff'><a href='activity-detail.php?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id."'><img src='".$activity_image."' width='200' height='265' style='border:1px solid #CCCCCC; margin-bottom:5px;'></a><br>".$activity_title."</div>";
		
		 $sr++;
	 }
        	
	}
	echo "</div>";
	
	//------------- for wordbank--------------------------
	if ($stmt = $mysqli->prepare("SELECT a.wname, c.wordbank_type,a.foldnameid, a.wordbank_typeid,b.folder_color FROM edu_wordbank a inner join edu_wordfolder b on a.foldnameid = b.id inner join edu_wordbank_type c on c.id = a.wordbank_typeid where a.added_by =? and wstatus=? and a.wname like ? ")) {
		
	 $stmt->bind_param("sss", $param_added_by, $param_wstatus, $param_wname);
		 // Set parameters 
	 $param_added_by = $_SESSION["id"];
	 $param_wstatus = $active;
	 $param_wname = "%{$_POST['gsearch']}%";
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($wname, $foldname,$foldnameid, $wordbank_typeid,$folder_color);
	 
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<div style='font-size:16px'>Word Bank(".$total_rows.")</div>";}
	 $sr =1;
	  echo "<div class='row' style='padding-left:15px; font-size:12px;'><p>";
	 while ($stmt->fetch()) {
	    $folder_color1 = trim($folder_color,"#");
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	    echo  "<li><a href='detail-wordbank.php?fdId=".$foldnameid."&wbId=".$wordbank_typeid."&fdcol=".$folder_color1."' style='color:#323c47; text-decoration:none'>".$wname." in ".$foldname."</a></li>";
		
		 $sr++;
	 }
        	
	}
	echo "</div>";
	
	//------------- for users--------------------------
	if ($stmt = $mysqli->prepare("SELECT first_name, last_name, school_name, class_name,a.user_id,b.class_id FROM edu_users a inner join  edu_user_school_level_class b on a.user_id = b.user_id inner join edu_school c on b.school_id=c.school_id inner join edu_class d on b.class_id=d.class_id where b.school_id =?  and (a.first_name like ? or a.last_name like ?) and user_type_id=? group by first_name, last_name ")) {
		
	  $stmt->bind_param("ssss", $param_school_id,  $param_first_name, $param_last_name, $param_user_type_id);
		 // Set parameters 
	 $param_school_id = $school_id; 
	 $param_first_name = "%{$_POST['gsearch']}%";
	 $param_last_name = "%{$_POST['gsearch']}%";$param_user_type_id=3;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($first_name, $last_name, $school_name, $class_name,$user_id,$class_id);
	 
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<div style='font-size:16px'>Users(".$total_rows.")</div>";}
	 $sr =1;
	  echo "<div class='row' style='padding-left:15px; font-size:12px;'><p>";
	 while ($stmt->fetch()) {
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	    echo  "<li><a href='student-info.php?uid=".$user_id."&classID=".$class_id."' style='color:#323c47; text-decoration:none'>".$last_name." ".$first_name." in ".$school_name.": ".$class_name."</a></li>";
		
		 $sr++;
	 }
        	
	}
	echo "</p></div>";
}

if($_POST['garticle'] != '')
{



  if ($stmt = $mysqli->prepare("SELECT DISTINCT(a.article_title), a.article_image, a.article_id, a.mag_id FROM edu_article a inner join edu_school_subscription b on a.article_id = b.article_id where b.school_id =? and b.school_subscription_status=? and b.subscription_end_date > ? and (a.article_title like ? or a.article_content like ?) and b.activity_id=?")) {
		
	 $stmt->bind_param("ssssss", $param_school_id, $param_school_subscription_status, $param_subscription_end_date, $param_article_title, $param_article_content, $param_activity_id);
		 // Set parameters 
	 $param_school_id = $school_id;
	 $param_school_subscription_status = $active;
	 $param_subscription_end_date = $todaysDate; 
	 $param_article_title = "%{$_POST['gsearch']}%";
	 $param_article_content = "%{$_POST['gsearch']}%";
	 $param_activity_id = 0;
	 $stmt->execute();
	  $stmt->store_result();
	 $total_rows = $stmt->num_rows;
		 /* bind variables to prepared statement */
	 $stmt->bind_result($article_title, $article_image, $article_id, $mag_id);
	 
	
	 $sr =1;
	  echo "<div class='row'>";
	 if($total_rows != 0){echo "<p style='font-size:16px'>Articles(".$total_rows.")</p>";}
	 while ($stmt->fetch()) {
	   if($total_rows != 0){  
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	     echo  "<div class='col-md-2-5 normaltext' align='center' style='margin:0 20px 20px 0; padding:10px; background-color:#ffffff'><a href='article-detail.php?artID=".$article_id."&actID=0&magID=".$mag_id."'><img src='".$article_image."' width='200' height='265' style='border:1px solid #CCCCCC; margin-bottom:5px;'></a><br>".$article_title."</div>";
		}
		 $sr++;
	 }
        	
	}
	echo "</div>";
	
	

}
if($_POST['gactivity'] != '')
{	
   
	
	//------------- for activity--------------------------
	if ($stmt = $mysqli->prepare("SELECT DISTINCT(a.activity_title), a.image_path, a.article_id, a.mag_id, a.activity_id FROM edu_activity a inner join edu_school_subscription b on a.activity_id = b.activity_id where b.school_id =? and b.school_subscription_status=? and b.subscription_end_date > ? and (a.activity_title like ? or a.activity_content like ?) and b.activity_id!=? ")) {
		
	 $stmt->bind_param("ssssss", $param_school_id, $param_school_subscription_status, $param_subscription_end_date, $param_activity_title, $param_activity_content, $param_activity_id);
		 // Set parameters 
	 $param_school_id = $school_id;
	 $param_school_subscription_status = $active;
	 $param_subscription_end_date = $todaysDate; 
	 $param_activity_title = "%{$_POST['gsearch']}%";
	 $param_activity_content = "%{$_POST['gsearch']}%";
	 $param_activity_id = 0;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($activity_title, $activity_image, $article_id, $mag_id, $activity_id);
	 
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<p style='font-size:16px'>Activities(".$total_rows.")</p>";}
	 $sr =1;
	  echo "<div class='row'>";
	 while ($stmt->fetch()) {
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	     echo  "<div class='col-md-2-5 normaltext' align='center' style='margin:0 20px 20px 0; padding:10px; background-color:#ffffff'><a href='activity-detail.php?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id."'><img src='".$activity_image."' width='200' height='265' style='border:1px solid #CCCCCC; margin-bottom:5px;'></a><br>".$activity_title."</div>";
		
		 $sr++;
	 }
        	
	}
	echo "</div>";
}

if($_POST['gwordbank'] != '')
{	
   
	
	//------------- for wordbank--------------------------
	if ($stmt = $mysqli->prepare("SELECT a.wname, c.wordbank_type,a.foldnameid, a.wordbank_typeid,b.folder_color FROM edu_wordbank a inner join edu_wordfolder b on a.foldnameid = b.id inner join edu_wordbank_type c on c.id = a.wordbank_typeid where a.added_by =? and wstatus=? and a.wname like ? ")) {
		
	 $stmt->bind_param("sss", $param_added_by, $param_wstatus, $param_wname);
		 // Set parameters 
	 $param_added_by = $_SESSION["id"];
	 $param_wstatus = $active;
	 $param_wname = "%{$_POST['gsearch']}%";
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($wname, $foldname,$foldnameid, $wordbank_typeid,$folder_color);
	 
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<div style='font-size:16px'>Word Bank(".$total_rows.")</div>";}
	 $sr =1;
	  echo "<div class='row' style='padding-left:15px; font-size:12px;'><p>";
	 while ($stmt->fetch()) {
	    $folder_color1 = trim($folder_color,"#");
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	    echo  "<li><a href='detail-wordbank.php?fdId=".$foldnameid."&wbId=".$wordbank_typeid."&fdcol=".$folder_color1."' style='color:#323c47; text-decoration:none'>".$wname." in ".$foldname."</a></li>";
		
		 $sr++;
	 }
        	
	}
	echo "</div>";
}

if($_POST['gusers'] !=''){

//------------- for users--------------------------
	if ($stmt = $mysqli->prepare("SELECT first_name, last_name, school_name, class_name,a.user_id,b.class_id FROM edu_users a inner join  edu_user_school_level_class b on a.user_id = b.user_id inner join edu_school c on b.school_id=c.school_id inner join edu_class d on b.class_id=d.class_id where b.school_id =?  and (a.first_name like ? or a.last_name like ?) and user_type_id=? group by first_name, last_name ")) {
		
	  $stmt->bind_param("ssss", $param_school_id,  $param_first_name, $param_last_name, $param_user_type_id);
		 // Set parameters 
	 $param_school_id = $school_id; 
	 $param_first_name = "%{$_POST['gsearch']}%";
	 $param_last_name = "%{$_POST['gsearch']}%";$param_user_type_id=3;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($first_name, $last_name, $school_name, $class_name,$user_id,$class_id);
	 
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<div style='font-size:16px'>Users(".$total_rows.")</div>";}
	 $sr =1;
	  echo "<div class='row' style='padding-left:15px; font-size:12px;'><p>";
	 while ($stmt->fetch()) {
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	    echo  "<li><a href='student-info.php?uid=".$user_id."&classID=".$class_id."' style='color:#323c47; text-decoration:none'>".$last_name." ".$first_name." in ".$school_name.": ".$class_name."</a></li>";
		
		 $sr++;
	 }
        	
	}
	echo "</p></div>";

}



if($_POST['gall'] != '' && $_POST['mag'] == '' && $_POST['mag2'] == '')
{



  if ($stmt = $mysqli->prepare("SELECT DISTINCT(a.article_title), a.article_image, a.article_id, a.mag_id FROM edu_article a inner join edu_school_subscription b on a.article_id = b.article_id where b.school_id =? and b.school_subscription_status=? and b.subscription_end_date > ? and (a.article_title like ? or a.article_content like ?) and b.activity_id=?")) {
		
	 $stmt->bind_param("ssssss", $param_school_id, $param_school_subscription_status, $param_subscription_end_date, $param_article_title, $param_article_content, $param_activity_id);
		 // Set parameters 
	 $param_school_id = $school_id;
	 $param_school_subscription_status = $active;
	 $param_subscription_end_date = $todaysDate; 
	 $param_article_title = "%{$_POST['gsearch']}%";
	 $param_article_content = "%{$_POST['gsearch']}%";
	 $param_activity_id = 0;
	 $stmt->execute();
	  $stmt->store_result();
	 $total_rows = $stmt->num_rows;
		 /* bind variables to prepared statement */
	 $stmt->bind_result($article_title, $article_image, $article_id, $mag_id);
	 
	
	 $sr =1;
	  echo "<div class='row'>";
	 if($total_rows != 0){echo "<p style='font-size:16px'>Articles(".$total_rows.")</p>";}
	 while ($stmt->fetch()) {
	   if($total_rows != 0){  
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	     echo  "<div class='col-md-2-5 normaltext' align='center' style='margin:0 20px 20px 0; padding:10px; background-color:#ffffff'><a href='article-detail.php?artID=".$article_id."&actID=0&magID=".$mag_id."'><img src='".$article_image."' width='200' height='265' style='border:1px solid #CCCCCC; margin-bottom:5px;'></a><br>".$article_title."</div>";
		}
		 $sr++;
	 }
        	
	}
	echo "</div>";
	
	//------------- for activity--------------------------
	if ($stmt = $mysqli->prepare("SELECT DISTINCT(a.activity_title), a.image_path, a.article_id, a.mag_id, a.activity_id FROM edu_activity a inner join edu_school_subscription b on a.activity_id = b.activity_id where b.school_id =? and b.school_subscription_status=? and b.subscription_end_date > ? and (a.activity_title like ? or a.activity_content like ?) and b.activity_id!=?")) {
		
	 $stmt->bind_param("ssssss", $param_school_id, $param_school_subscription_status, $param_subscription_end_date, $param_activity_title, $param_activity_content, $param_activity_id);
		 // Set parameters 
	 $param_school_id = $school_id;
	 $param_school_subscription_status = $active;
	 $param_subscription_end_date = $todaysDate; 
	 $param_activity_title = "%{$_POST['gsearch']}%";
	 $param_activity_content = "%{$_POST['gsearch']}%";
	 $param_activity_id = 0;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($activity_title, $activity_image, $article_id, $mag_id, $activity_id);
	 
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<p style='font-size:16px'>Activities(".$total_rows.")</p>";}
	 $sr =1;
	  echo "<div class='row'>";
	 while ($stmt->fetch()) {
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	     echo  "<div class='col-md-2-5 normaltext' align='center' style='margin:0 20px 20px 0; padding:10px; background-color:#ffffff'><a href='activity-detail.php?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id."'><img src='".$activity_image."' width='200' height='265' style='border:1px solid #CCCCCC; margin-bottom:5px;'></a><br>".$activity_title."</div>";
		
		 $sr++;
	 }
        	
	}
	echo "</div>";
	
	//------------- for wordbank--------------------------
	if ($stmt = $mysqli->prepare("SELECT a.wname, c.wordbank_type,a.foldnameid, a.wordbank_typeid,b.folder_color FROM edu_wordbank a inner join edu_wordfolder b on a.foldnameid = b.id inner join edu_wordbank_type c on c.id = a.wordbank_typeid where a.added_by =? and wstatus=? and a.wname like ? ")) {
		
	 $stmt->bind_param("sss", $param_added_by, $param_wstatus, $param_wname);
		 // Set parameters 
	 $param_added_by = $_SESSION["id"];
	 $param_wstatus = $active;
	 $param_wname = "%{$_POST['gsearch']}%";
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($wname, $foldname,$foldnameid, $wordbank_typeid,$folder_color);
	 
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<div style='font-size:16px'>Word Bank(".$total_rows.")</div>";}
	 $sr =1;
	  echo "<div class='row' style='padding-left:15px; font-size:12px;'><p>";
	 while ($stmt->fetch()) {
	    $folder_color1 = trim($folder_color,"#");
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	    echo  "<li><a href='detail-wordbank.php?fdId=".$foldnameid."&wbId=".$wordbank_typeid."&fdcol=".$folder_color1."' style='color:#323c47; text-decoration:none'>".$wname." in ".$foldname."</a></li>";
		
		 $sr++;
	 }
        	
	}
	echo "</div>";
	
	//------------- for users--------------------------
	if ($stmt = $mysqli->prepare("SELECT first_name, last_name, school_name, class_name,a.user_id,b.class_id FROM edu_users a inner join  edu_user_school_level_class b on a.user_id = b.user_id inner join edu_school c on b.school_id=c.school_id inner join edu_class d on b.class_id=d.class_id where b.school_id =?  and (a.first_name like ? or a.last_name like ?) and user_type_id=? group by first_name, last_name ")) {
		
	  $stmt->bind_param("ssss", $param_school_id,  $param_first_name, $param_last_name, $param_user_type_id);
		 // Set parameters 
	 $param_school_id = $school_id; 
	 $param_first_name = "%{$_POST['gsearch']}%";
	 $param_last_name = "%{$_POST['gsearch']}%";$param_user_type_id=3;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($first_name, $last_name, $school_name, $class_name, $user_id, $class_id);
	 
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<div style='font-size:16px'>Users(".$total_rows.")</div>";}
	 $sr =1;
	  echo "<div class='row' style='padding-left:15px; font-size:12px;'><p>";
	 while ($stmt->fetch()) {
		// if($mag_issue =='22/23'){$link ='magzine-detail.php';} else if($mag_issue =='18'){$link ='magzine-details.php';}
	    echo  "<li><a href='student-info.php?uid=".$user_id."&classID=".$class_id."' style='color:#323c47; text-decoration:none'>".$last_name." ".$first_name." in ".$school_name.": ".$class_name."</a></li>";
		
		 $sr++;
	 }
        	
	}
	echo "</p></div>";
}



?>