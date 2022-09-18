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

$studId = !empty($_POST['studId'])?$_POST['studId']:0;
if($_POST['folderV'] !='')
{

	//$stmt = $mysqli->prepare("SELECT b.bookmark_type, a.folder_color, COUNT(a.bookmark) as bookmarkno, a.bookmark_type FROM edu_annotation_bookmark a inner join edu_bookmark_type b on a.bookmark_type=b.id where a.status=? and a.anno_by =? and a.bookmark_type=? and a.folder_color=?");
	$stmt = $mysqli->prepare("SELECT a.id,a.bookmark_type, b.folder_color,b.id,c.id, COUNT(c.bookmark) as bookmarkno FROM  edu_bookmark_type a inner join edu_bookmarkfolder b on a.id =b.foldnameid left join edu_annotation_bookmark c on c.foldnameid=b.id where  a.status=? and a.created_by =? and c.anno_by =? and a.id=? and b.id=? and b.folder_color=?
");
	/* Bind parameters */
	$stmt->bind_param("ssssss", $param_status,$param_createdby,$param_anno_by,$param_bmID,$param_fdID,$param_folder_color);
	/* Set parameters */
	if($studId > 0){
	   $userValue = $studId;
	}else{
	   $userValue = $_SESSION['id'];
	}
	$param_status = $active;
	$param_createdby = $userValue;
	$param_anno_by = $userValue;
	$param_bmID = $_POST['bmId'];
	$param_fdID = $_POST['fdId'];
	$param_folder_color = '#'.$_POST['fdcol'];	
	$stmt->execute();
	$stmt->bind_result($bookmark_typeid,$bookmark_type,$folder_color,$foldid,$bmIDmain,$bookmarkno);
	 $sr =1;
	 					
	 // fetch values 
	 while ($stmt->fetch()) {
	      if($bookmarkno > 1){$varBm = 'bookmarks';} else { $varBm = 'bookmark';}
		  echo "<div class='col-lg-12' >
		            <div style='width:100%; color:#000000; min-height:100px; display: inline-block; margin:10px 10px 40px 0px; padding:10px 40px; border-radius: 8px; background-color: #".$_POST['fdcol']."'>                         ".$bookmark_type."
					     <div class='row'>
						 <div style='margin:50px 0px 0px 0px; font-size:10px' class='col-lg-8'>".$bookmarkno." ".$varBm."</div>
						 <div class='col-lg-4' style='margin:50px 0px 0px 0px; font-size:10px' align='right'><i class='material-icons md-10 annocom' id='bmDel' data-id='" .$_POST['bmId']."_#".$_POST['fdcol']."_".$_POST['fdId']. "'>delete</i></div>
						 </div>
					</div>
					
		        </div>";
		  
		  
		  	$sr++;
	 }
}



if($_POST['bm_id'] != '' && $_POST['bm_search'] == '')
{
    $bm_id = explode("_",$_POST['bm_id']);
	$stmt = $mysqli->prepare("delete FROM edu_annotation_bookmark where bookmark_type=? and foldnameid=?");
	$stmt->bind_param("ss", $param_bookmark_type, $param_foldnameid);
	$param_bookmark_type = $bm_id[0];
	$param_foldnameid = $bm_id[2];
	$stmt->execute();
	$stmt->close();
	
	$stmt = $mysqli->prepare("delete FROM edu_bookmarkfolder where folder_color=? and id=?");
	$stmt->bind_param("ss", $param_folder_color, $param_foldnameid);
	$param_folder_color = $bm_id[1];
	$param_foldnameid = $bm_id[2];
	$stmt->execute();
	$stmt->close();
}

if($_POST['indvbm_del'] != '')
{
	$stmt = $mysqli->prepare("delete FROM edu_annotation_bookmark where id=?");
	$stmt->bind_param("s", $param_bookmark_id);
	$param_bookmark_id = $_POST['indvbm_del'];
	$stmt->execute();
	$stmt->close();
}



$magVar = " ";
if($_POST['mag'] != '' && $_POST['bm_search'] == '')
{
  if ($stmt = $mysqli->prepare("SELECT a.article_path,a.article_title, a.article_published_date, b.mag_title, b.mag_issue,b.mag_published_date,b.mag_image_path, d.mag_type,a.article_image, e.id,e.art_id,e.mag_id,e.act_id from edu_article a inner join edu_magazine b on a.mag_id=b.mag_id inner join edu_mag_type d on b.mag_type_id = d.mag_type_id inner join edu_annotation_bookmark e on e.art_id=a.article_id inner join edu_bookmarkfolder f on e.foldnameid=f.id where a.article_status=? and b.mag_status=? and d.mag_type_status= ? and e.bookmark_type=? and f.folder_color=? and e.act_id=?")) {
	
	
		
	 $stmt->bind_param("ssssss", $param_status, $param_status2, $param_status3, $param_bookmark_type, $param_folder_color, $param_act_id);
		 // Set parameters 
	 $param_status = $active;
	 $param_status2 = $active;
	 $param_status3 = $active;
	 $param_bookmark_type = $_POST['bmId'];
	 $param_folder_color = '#'.$_POST['fdcol'];
	 $param_act_id = 0;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($article_path,$article_title, $article_published_date, $mag_title, $mag_issue, $mag_published_date, $mag_image_path, $mag_type, $article_image, $id, $article_id, $mag_id, $activity_id);
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<p style='font-size:16px'>Articles(".$total_rows.")</p>";}
	 $sr =1;
	 echo "<div class='row'>";
	 while ($stmt->fetch()) {
	     if($mag_type=='i-Magazine') {$mag_type= 'i';}
	     echo  "<div class='col-md-2-5 normaltext' align='center' style='margin:0 20px 20px 0; padding:10px; background-color:#ffffff'><a href='article-detail-admin.php?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id."'><img src='".$article_image."' width='200' height='265' style='border:1px solid #CCCCCC'></a><br><br>".$article_title."<br>".$mag_type.$mag_issue."
		 <div  align='right'><i class='material-icons md-10 annocom' id='indvbmDel' data-id='".$id."'>delete</i></div>
		 </div>";
		
		 $sr++;
	 }
     echo "</div>"; 	
	}
	
	if ($stmt = $mysqli->prepare("SELECT a.activity_path,a.activity_title, a.activity_published_date, b.mag_title, b.mag_issue,b.mag_published_date,b.mag_image_path, d.mag_type,a.image_path, e.id,e.art_id,e.mag_id,e.act_id from edu_activity a inner join edu_magazine b on a.mag_id=b.mag_id inner join edu_mag_type d on b.mag_type_id = d.mag_type_id inner join edu_annotation_bookmark e on e.art_id=a.article_id inner join edu_bookmarkfolder f on e.foldnameid=f.id where a.activity_status=? and b.mag_status=? and d.mag_type_status= ? and e.bookmark_type=? and f.folder_color=? and e.act_id !=? group by e.mag_id" )) {
	
	
		
	 $stmt->bind_param("ssssss", $param_status, $param_status2, $param_status3, $param_bookmark_type, $param_folder_color, $param_act_id);
		 // Set parameters 
	 $param_status = $active;
	 $param_status2 = $active;
	 $param_status3 = $active;
	 $param_bookmark_type = $_POST['bmId'];
	 $param_folder_color = '#'.$_POST['fdcol'];
	 $param_act_id = 0;
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($article_path,$article_title, $article_published_date, $mag_title, $mag_issue, $mag_published_date, $mag_image_path, $mag_type, $article_image, $id, $article_id, $mag_id, $activity_id);
	 $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<p style='font-size:16px'>Activities(".$total_rows.")</p>";}
	 $sr =1;
	 echo "<div class='row'>";
	 while ($stmt->fetch()) {
	     if($mag_type=='i-Magazine') {$mag_type= 'i';}
	     echo  "<div class='col-md-2-5 normaltext' align='center' style='margin:0 20px 20px 0; padding:10px; background-color:#ffffff'><a href='activity-detail-admin.php?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id."'><img src='".$article_image."' width='200' height='265' style='border:1px solid #CCCCCC'></a><br><br>".$article_title."<br>".$mag_type.$mag_issue."
		 <div  align='right'><i class='material-icons md-10 annocom' id='indvbmDel' data-id='".$id."'>delete</i></div>
		 </div>";
		
		 $sr++;
	 }
     echo "</div>";   	
	}
}

if($_POST['bm_search'] != '')
{
  if ($stmt = $mysqli->prepare("SELECT a.article_path,a.article_title, a.article_published_date, b.mag_title, b.mag_issue,b.mag_published_date,b.mag_image_path, d.mag_type,a.article_image, e.id, e.art_id,e.mag_id,e.act_id from edu_article a inner join edu_magazine b on a.mag_id=b.mag_id inner join edu_mag_type d on b.mag_type_id = d.mag_type_id inner join edu_annotation_bookmark e on e.art_id=a.article_id inner join edu_bookmarkfolder f on e.foldnameid=f.id where a.article_status=? and b.mag_status=? and d.mag_type_status= ? and e.bookmark_type=? and f.folder_color=? and e.act_id =? and a.article_title like ? group by e.mag_id")) {
	
	
		
	 $stmt->bind_param("sssssss", $param_status, $param_status2, $param_status3, $param_bookmark_type, $param_folder_color, $param_act_id, $param_article_title);
		 // Set parameters 
	 $param_status = $active;
	 $param_status2 = $active;
	 $param_status3 = $active;
	 $param_bookmark_type = $_POST['bmId'];
	 $param_folder_color = '#'.$_POST['fdcol'];
	 $param_act_id = 0;
	 $param_article_title = "%{$_POST['bm_search']}%";
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($article_path,$article_title, $article_published_date, $mag_title, $mag_issue, $mag_published_date, $mag_image_path, $mag_type, $article_image, $id, $article_id, $mag_id, $activity_id);
	  $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<p style='font-size:16px'>Activities(".$total_rows.")</p>";}
	 $sr =1;
	 echo "<div class='row'>";
	 while ($stmt->fetch()) {
	     if($mag_type=='i-Magazine') {$mag_type= 'i';}
	     echo  "<div class='col-md-2-5 normaltext' align='center' style='margin:0 20px 20px 0; padding:10px; background-color:#ffffff'><a href='article-detail-admin.php?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id."'><img src='".$article_image."' width='200' height='265' style='border:1px solid #CCCCCC'></a><br><br>".$article_title."<br>".$mag_type.$mag_issue."
		 <div  align='right'><i class='material-icons md-10 annocom' id='indvbmDel' data-id='".$id."'>delete</i></div>
		 </div>";
		
		 $sr++;
	 }
    echo "</div>";    	
	}
	
	if ($stmt = $mysqli->prepare("SELECT a.activity_path,a.activity_title, a.activity_published_date, b.mag_title, b.mag_issue,b.mag_published_date,b.mag_image_path, d.mag_type,a.image_path, e.id, e.art_id,e.mag_id,e.act_id from edu_activity a inner join edu_magazine b on a.mag_id=b.mag_id inner join edu_mag_type d on b.mag_type_id = d.mag_type_id inner join edu_annotation_bookmark e on e.act_id=a.activity_id inner join edu_bookmarkfolder f on e.foldnameid=f.id where a.activity_status=? and b.mag_status=? and d.mag_type_status= ? and e.bookmark_type=? and f.folder_color=? and e.act_id !=? and a.activity_title like ? group by e.mag_id")) {
	
	
		
	 $stmt->bind_param("sssssss", $param_status, $param_status2, $param_status3, $param_bookmark_type, $param_folder_color, $param_act_id, $param_article_title);
		 // Set parameters 
	 $param_status = $active;
	 $param_status2 = $active;
	 $param_status3 = $active;
	 $param_bookmark_type = $_POST['bmId'];
	 $param_folder_color = '#'.$_POST['fdcol'];
	 $param_act_id = 0;
	 $param_article_title = "%{$_POST['bm_search']}%";
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($article_path,$article_title, $article_published_date, $mag_title, $mag_issue, $mag_published_date, $mag_image_path, $mag_type, $article_image, $id, $article_id, $mag_id, $activity_id);
	  $stmt->store_result();
	 $total_rows = $stmt->num_rows;
	 
	if($total_rows != 0){echo "<p style='font-size:16px'>Activities(".$total_rows.")</p>";}
	 $sr =1;
	 echo "<div class='row'>";
	 while ($stmt->fetch()) {
	     if($mag_type=='i-Magazine') {$mag_type= 'i';}
	     echo  "<div class='col-md-2-5 normaltext' align='center' style='margin:0 20px 20px 0; padding:10px; background-color:#ffffff'><a href='activity-detail-admin.php?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id."'><img src='".$article_image."' width='200' height='265' style='border:1px solid #CCCCCC'></a><br><br>".$article_title."<br>".$mag_type.$mag_issue."
		 <div  align='right'><i class='material-icons md-10 annocom' id='indvbmDel' data-id='".$id."'>delete</i></div>
		 </div>";
		
		 $sr++;
	 }
    echo "</div>";    	
	}
}
?>
