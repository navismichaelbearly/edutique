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
$aidsLog = !empty($_POST['aidsLog'])?$_POST['aidsLog']:0;
$aidsLogschool = !empty($_POST['aidsLogschool'])?$_POST['aidsLogschool']:0;
$aidsLogmag = !empty($_POST['aidsLogmag'])?$_POST['aidsLogmag']:0;
$caIDvar = !empty($_POST['caID'])?$_POST['caID']:0;
$extVal = !empty($_POST['extVal'])?$_POST['extVal']:'';

if($_SESSION["utypeid"]==$admconst){
   if($aidsLog == 1)
	{
			
			
			if ($stmt = $mysqli->prepare("SELECT article_title,content_aid_title,content_aid_file_path,supplementary_aid,uploaded_by,uploadded_date, first_name, last_name, a.art_id, a.act_id, a.mag_id,embedvideo,a.id  FROM edu_aid a inner join edu_users b on a.uploaded_by=b.user_id inner join edu_article c on a.art_id=c.article_id and a.mag_id=c.mag_id   where status=? and uploaded_by !=? and act_id =? UNION SELECT activity_title,content_aid_title,content_aid_file_path,supplementary_aid,uploaded_by,uploadded_date, first_name, last_name, a.art_id, a.act_id, a.mag_id,embedvideo,a.id FROM edu_aid a inner join edu_users b on a.uploaded_by=b.user_id inner join edu_activity c on a.act_id=c.activity_id and a.mag_id=c.mag_id   where status=? and uploaded_by !=? and act_id !=?")) {    
			 
			  
			 $stmt->bind_param("ssssss", $param_noti_status, $param_added_by, $param_act_id, $param_noti_status2, $param_added_by2, $param_act_id2);
			 $param_noti_status = $active;	
			 $param_added_by = 1;
			 $param_act_id = 0;
			 $param_noti_status2 = $active;	
			 $param_added_by2 = 1;
			 $param_act_id2 = 0;
			 $stmt->execute();
			 /* bind variables to prepared statement */
			 $stmt->bind_result($article_title,$content_aid_title,$content_aid_file_path,$supplementary_aid,$uploaded_by,$uploadded_date,$first_name, $last_name,$article_id,$activity_id,$mag_id, $embedvideo, $caID );
			 $sr =1;
			 echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
												<thead>
													<tr><th><input type='checkbox' id='select_all'> Select </th>
                                                        <th>No.</th>
														<th>Article/Activity</th>
														<th>Title</th>
														<th>Content Aid</th>
														<th>Supplementary Aid</th>
														<th>Uploaded By</th>
														<th>Date Uploaded</th>
													</tr>
												</thead>
												<tbody>
												";
													
			 /* fetch values */
			 while ($stmt->fetch()) { $newDate = date("d M Y", strtotime($uploadded_date));
			      if($_SESSION["utypeid"]==$admconst){
				   $pagearT = 'article-detail-admin.php';
				   $pageacT = 'activity-detail-admin.php';
				}else{
				    $pagearT = 'article-detail.php';
				   $pageacT = 'activity-detail.php';
				}  
			  if($activity_id == 0){
			     $magLink = $pagearT."?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id;
				 $varType= "Art: ";
			  }else{
			     $magLink = $pageacT."?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id;
				 $varType= "Act: ";
			  }
			  
			  if($content_aid_file_path !="" || $embedvideo !=""){
			    $ext = pathinfo($content_aid_file_path, PATHINFO_EXTENSION);
			    if($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'ppt' || $ext == 'pptx' || $ext == 'xls' || $ext == 'xlsx'){
				   $cap="<a href='".$content_aid_file_path."' target='_blank'>".$content_aid_title."</a>";
				}else if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'){
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}else if($ext == 'mpeg' || $ext == 'mp3' || $ext == 'mpeg'){ 
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}else if($ext == 'mov' || $ext == 'mp4'){ 
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}else if($embedvideo !=""){ 
				   $ext ="";
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}
			  }
				  echo "<tr>";
					
				       echo "<td><input type='checkbox' class='rev_checkbox' data-rev-id='" . $caID . "'>";
		               echo "<td>" . $sr . "</td>";	
					   echo "<td class='normaltext'>".$varType."<a href='".$magLink."'>" . $article_title . "</a></td>";
					   echo "<td class='normaltext'>" . $content_aid_title ."</td>";
					    echo "<td class='normaltext'>".$cap."</td>";
					   echo "<td class='normaltext'>" . $supplementary_aid."</td>"; 
					   echo "<td class='normaltext'>".$last_name. " ".$first_name."</td>";
					   echo "<td class='normaltext'>" . $newDate ."</td>";
				 
					 echo "</tr>" ;
							$sr++;
			}
			
			echo "
												</tbody>    
											  </table>";
	 }									
	 
	}
	
	if($aidsLogschool == 1){
		if($_POST['schoolid']=='Allschool'){
		  $var ="SELECT article_title,content_aid_title,content_aid_file_path,supplementary_aid,uploaded_by,uploadded_date, first_name, last_name, a.art_id, a.act_id, a.mag_id,embedvideo,a.id  FROM edu_aid a inner join edu_users b on a.uploaded_by=b.user_id inner join edu_article c on a.art_id=c.article_id and a.mag_id=c.mag_id   where status=? and uploaded_by !=? and act_id =? UNION SELECT activity_title,content_aid_title,content_aid_file_path,supplementary_aid,uploaded_by,uploadded_date, first_name, last_name, a.art_id, a.act_id, a.mag_id,embedvideo,a.id FROM edu_aid a inner join edu_users b on a.uploaded_by=b.user_id inner join edu_activity c on a.act_id=c.activity_id and a.mag_id=c.mag_id   where status=? and uploaded_by !=? and act_id !=?";
		}else {
		  $var ="SELECT article_title,content_aid_title,content_aid_file_path,supplementary_aid,uploaded_by,uploadded_date, first_name, last_name, a.art_id, a.act_id, a.mag_id,embedvideo,a.id  FROM edu_aid a inner join edu_users b on a.uploaded_by=b.user_id inner join edu_article c on a.art_id=c.article_id and a.mag_id=c.mag_id inner join edu_user_school_level_class d on b.user_id=d.user_id  where status=? and uploaded_by !=? and act_id =? and d.school_id=? UNION SELECT activity_title,content_aid_title,content_aid_file_path,supplementary_aid,uploaded_by,uploadded_date, first_name, last_name, a.art_id, a.act_id, a.mag_id,embedvideo,a.id  FROM edu_aid a inner join edu_users b on a.uploaded_by=b.user_id inner join edu_activity c on a.act_id=c.activity_id and a.mag_id=c.mag_id  inner join edu_user_school_level_class d on b.user_id=d.user_id where status=? and uploaded_by !=? and act_id !=? and d.school_id=?";
		}
		if ($stmt = $mysqli->prepare($var)) {    
			 
			  if($_POST['schoolid']=='Allschool'){
				   $stmt->bind_param("ssssss", $param_noti_status, $param_added_by, $param_act_id, $param_noti_status2, $param_added_by2, $param_act_id2);
					 $param_noti_status = $active;	
					 $param_added_by = 1;
					 $param_act_id = 0;
					 $param_noti_status2 = $active;	
					 $param_added_by2 = 1;
					 $param_act_id2 = 0;
				}else {
				    $stmt->bind_param("ssssssss", $param_noti_status, $param_added_by, $param_act_id, $param_school_id1, $param_noti_status2, $param_added_by2, $param_act_id2,$param_school_id2);
					 $param_noti_status = $active;	
					 $param_added_by = 1;
					 $param_act_id = 0;
					 $param_noti_status2 = $active;	
					 $param_added_by2 = 1;
					 $param_act_id2 = 0;
					 $param_school_id1 = $_POST['schoolid'];
					 $param_school_id2 = $_POST['schoolid'];
				}
			
				
			 
			 
			 $stmt->execute();
			 /* bind variables to prepared statement */
			$stmt->bind_result($article_title,$content_aid_title,$content_aid_file_path,$supplementary_aid,$uploaded_by,$uploadded_date,$first_name, $last_name,$article_id,$activity_id,$mag_id, $embedvideo, $caID );
			 $sr =1;
			 echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
												<thead>
													<tr><th><input type='checkbox' id='select_all'> Select </th>
                                                        <th>No.</th>
														<th>Article/Activity</th>
														<th>Title</th>
														<th>Content Aid</th>
														<th>Supplementary Aid</th>
														<th>Uploaded By</th>
														<th>Date Uploaded</th>
													</tr>
												</thead>
												<tbody>
												";
													
			 /* fetch values */
			while ($stmt->fetch()) { $newDate = date("d M Y", strtotime($uploadded_date));
			     if($_SESSION["utypeid"]==$admconst){
				   $pagearT = 'article-detail-admin.php';
				   $pageacT = 'activity-detail-admin.php';
				}else{
				    $pagearT = 'article-detail.php';
				   $pageacT = 'activity-detail.php';
				}  
			  if($activity_id == 0){
			     $magLink = $pagearT."?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id;
				 $varType= "Art: ";
			  }else{
			     $magLink = $pageacT."?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id;
				 $varType= "Act: ";
			  }
			  
			  if($content_aid_file_path !="" || $embedvideo !=""){
			    $ext = pathinfo($content_aid_file_path, PATHINFO_EXTENSION);
			    if($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'ppt' || $ext == 'pptx' || $ext == 'xls' || $ext == 'xlsx'){
				   $cap="<a href='".$content_aid_file_path."' target='_blank'>".$content_aid_title."</a>";
				}else if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'){
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}else if($ext == 'mpeg' || $ext == 'mp3' || $ext == 'mpeg'){ 
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}else if($ext == 'mov' || $ext == 'mp4'){ 
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}else if($embedvideo !=""){ 
				   $ext ="";
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}
			  }
				  echo "<tr>";
					
				        echo "<td><input type='checkbox' class='rev_checkbox' data-rev-id='" . $caID . "'>";
		               echo "<td>" . $sr . "</td>";	
					   echo "<td class='normaltext'>".$varType."<a href='".$magLink."'>" . $article_title . "</a></td>";
					   echo "<td class='normaltext'>" . $content_aid_title ."</td>";
					    echo "<td class='normaltext'>".$cap."</td>";
					   echo "<td class='normaltext'>" . $supplementary_aid."</td>"; 
					   echo "<td class='normaltext'>".$last_name. " ".$first_name."</td>";
					   echo "<td class='normaltext'>" . $newDate ."</td>";
				 
					 echo "</tr>" ;
							$sr++;
			}
			
			echo "
												</tbody>    
											  </table>";
	 }									
	}
	
	if($aidsLogmag == 1){
	    $stmt2 = $mysqli->prepare("Select mag_id from edu_magazine a INNER JOIN edu_mag_type b on a.mag_type_id=b.mag_type_id where b.mag_type_id=?");
						
						/* Set parameters */
						$stmt2->bind_param("s", $param_magtid);
					    $param_magtid =$_POST['magazineid'];
						$stmt2->execute();
						$result2 = $stmt2->get_result();
                        $row2 = $result2->fetch_assoc();
		if($_POST['magazineid']=='Allmagazine'){
		  $var ="SELECT article_title,content_aid_title,content_aid_file_path,supplementary_aid,uploaded_by,uploadded_date, first_name, last_name, a.art_id, a.act_id, a.mag_id,embedvideo,a.id  FROM edu_aid a inner join edu_users b on a.uploaded_by=b.user_id inner join edu_article c on a.art_id=c.article_id and a.mag_id=c.mag_id   where status=? and uploaded_by !=? and act_id =? UNION SELECT activity_title,content_aid_title,content_aid_file_path,supplementary_aid,uploaded_by,uploadded_date, first_name, last_name, a.art_id, a.act_id, a.mag_id,embedvideo,a.id FROM edu_aid a inner join edu_users b on a.uploaded_by=b.user_id inner join edu_activity c on a.act_id=c.activity_id and a.mag_id=c.mag_id   where status=? and uploaded_by !=? and act_id !=?";
		}else {
		  $var ="SELECT article_title,content_aid_title,content_aid_file_path,supplementary_aid,uploaded_by,uploadded_date, first_name, last_name, a.art_id, a.act_id, a.mag_id,embedvideo,a.id  FROM edu_aid a inner join edu_users b on a.uploaded_by=b.user_id inner join edu_article c on a.art_id=c.article_id and a.mag_id=c.mag_id  where status=? and uploaded_by !=? and act_id =? and a.mag_id=? UNION SELECT activity_title,content_aid_title,content_aid_file_path,supplementary_aid,uploaded_by,uploadded_date, first_name, last_name, a.art_id, a.act_id, a.mag_id,embedvideo,a.id  FROM edu_aid a inner join edu_users b on a.uploaded_by=b.user_id inner join edu_activity c on a.act_id=c.activity_id and a.mag_id=c.mag_id where status=? and uploaded_by !=? and act_id !=? and a.mag_id=?";
		}
		if ($stmt = $mysqli->prepare($var)) {    
			 
			  if($_POST['magazineid']=='Allmagazine'){
				   $stmt->bind_param("ssssss", $param_noti_status, $param_added_by, $param_act_id, $param_noti_status2, $param_added_by2, $param_act_id2);
					 $param_noti_status = $active;	
					 $param_added_by = 1;
					 $param_act_id = 0;
					 $param_noti_status2 = $active;	
					 $param_added_by2 = 1;
					 $param_act_id2 = 0;
				}else {
				    $stmt->bind_param("ssssssss", $param_noti_status, $param_added_by, $param_act_id, $param_mag_id1, $param_noti_status2, $param_added_by2, $param_act_id2,$param_mag_id2);
					 $param_noti_status = $active;	
					 $param_added_by = 1;
					 $param_act_id = 0;
					 $param_noti_status2 = $active;	
					 $param_added_by2 = 1;
					 $param_act_id2 = 0;
					 $param_mag_id1 = $row2['mag_id'];
					 $param_mag_id2 = $row2['mag_id'];
				}
			
				
			 
			 
			 $stmt->execute();
			 /* bind variables to prepared statement */
			$stmt->bind_result($article_title,$content_aid_title,$content_aid_file_path,$supplementary_aid,$uploaded_by,$uploadded_date,$first_name, $last_name,$article_id,$activity_id,$mag_id, $embedvideo, $caID );
			 $sr =1;
			 echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
												<thead>
													<tr><th><input type='checkbox' id='select_all'> Select </th>
                                                        <th>No.</th>
														<th>Article/Activity</th>
														<th>Title</th>
														<th>Content Aid</th>
														<th>Supplementary Aid</th>
														<th>Uploaded By</th>
														<th>Date Uploaded</th>
													</tr>
												</thead>
												<tbody>
												";
													
			 /* fetch values */
			while ($stmt->fetch()) { $newDate = date("d M Y", strtotime($uploadded_date));
			  if($_SESSION["utypeid"]==$admconst){
				   $pagearT = 'article-detail-admin.php';
				   $pageacT = 'activity-detail-admin.php';
				}else{
				    $pagearT = 'article-detail.php';
				   $pageacT = 'activity-detail.php';
				}  
			  if($activity_id == 0){
			     $magLink = $pagearT."?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id;
				 $varType= "Art: ";
			  }else{
			     $magLink = $pageacT."?artID=".$article_id."&actID=".$activity_id."&magID=".$mag_id;
				 $varType= "Act: ";
			  }
			  
			  if($content_aid_file_path !="" || $embedvideo !=""){
			    $ext = pathinfo($content_aid_file_path, PATHINFO_EXTENSION);
				if($ext == 'pdf' || $ext == 'doc' || $ext == 'docx' || $ext == 'ppt' || $ext == 'pptx' || $ext == 'xls' || $ext == 'xlsx'){
				   $cap="<a href='".$content_aid_file_path."' target='_blank'>View</a>";
				}else if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png'){
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}else if($ext == 'mpeg' || $ext == 'mp3' || $ext == 'mpeg'){ 
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}else if($ext == 'mov' || $ext == 'mp4'){ 
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}else if($embedvideo !=""){ 
				   $ext ="";
			       $cap="<a href='view-content-aid.php?ext=".$ext."&caID=".$caID."'>".$content_aid_title."</a>";
				}
			  }
				  echo "<tr>";
					
				       echo "<td><input type='checkbox' class='rev_checkbox' data-rev-id='" . $caID . "'>";
		               echo "<td>" . $sr . "</td>";	
					   echo "<td class='normaltext'>".$varType."<a href='".$magLink."'>" . $article_title . "</a></td>";
					   echo "<td class='normaltext'>" . $content_aid_title ."</td>";
					    echo "<td class='normaltext'>".$cap."</td>";
					   echo "<td class='normaltext'>" . $supplementary_aid."</td>"; 
					   echo "<td class='normaltext'>".$last_name. " ".$first_name."</td>";
					   echo "<td class='normaltext'>" . $newDate ."</td>";
				 
					 echo "</tr>" ;
							$sr++;
			}
			
			echo "
												</tbody>    
											  </table>";
	 }									
	}
	
	

}

if($caIDvar > 0){
	   $stmt = $mysqli->prepare("Select content_aid_file_path,embedvideo from edu_aid where id=?");
			/* Bind parameters */
			$stmt->bind_param("s", $param_ca_id);
			/* Set parameters */
			$param_ca_id = $caIDvar;
			$stmt->execute();
			$stmt->bind_result($content_aid_file_path,$embedvideo);
			$stmt->fetch();
			$stmt->close();
	   if($extVal == 'jpg' || $extVal == 'jpeg' || $extVal == 'png'){
	      
	      echo "<img src='".$content_aid_file_path."' width='100%' height='100%'>";
	   }else if($extVal == 'mpeg' || $extVal == 'mp3' || $extVal == 'mpeg'){
	      echo "<div style='background:#FFFFFF; padding:10px' id='rLoud1'>
                            
                            <audio  preload='auto' controls style='width: 100%;'>
	                             <source src='".$content_aid_file_path."' type='audio/mpeg'>
	                        </audio>
                            </div>";
	   }else if($extVal == 'mov' || $extVal == 'mp4' ){
	      echo "<div style='background:#FFFFFF; padding:10px' id='rLoud1'>
                            
                           <video style='width: 100%;' controls>
							  <source src='".$content_aid_file_path."' type='video/mp4'>
							  <source src='".$content_aid_file_path."' type='video/mov'>
							  Your browser does not support HTML video.
							</video>
                            </div>";
	   }else if($embedvideo !="" ){
	      echo $embedvideo;
	   }
	
	}

?>
