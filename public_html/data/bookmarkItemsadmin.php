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

$bookMark = !empty($_POST['bookMark'])?$_POST['bookMark']:0;
$bmFolder = !empty($_POST['bmFolder'])?$_POST['bmFolder']:0;
$book_mark_type = !empty($_POST['book_mark_type'])?$_POST['book_mark_type']:'';
$bm_id = !empty($_POST['bm_id'])?$_POST['bm_id']:'';
$bmFolderselect = !empty($_POST['bmFolderselect'])?$_POST['bmFolderselect']:0;
$studId = !empty($_POST['studId'])?$_POST['studId']:0;
if($bookMark == 1)
{
	$stmt = $mysqli->prepare("SELECT id,bookmark_type FROM edu_bookmark_type where status=?  and created_by=?");
	/* Bind parameters */
	$stmt->bind_param("ss", $param_status,$param_created_by);
	/* Set parameters */
	
	$param_status = $active;
	$param_created_by = $_SESSION['id'];
	$stmt->execute();
	$stmt->bind_result($id,$bookmark_type);
	 $sr =1;
	 //echo "<select name='bookMarktype' id='bookMarktype' class='form-control' required>";	
	 echo "<input list='btype' id='bookMarktype' class='form-control' required /></label>"	;
	 echo "<datalist id='btype'>";				
	 // fetch values 
	 while ($stmt->fetch()) {
	      
		  echo "<option style='font-family:Arial, Helvetica, sans-serif !important;' value='" . $bookmark_type . "'>" . $bookmark_type . "</option>";
		  
		  
		  	$sr++;
	 }
	 echo "</datalist>";
}

if($bmFolder == 1)
{
	/*$stmt = $mysqli->prepare("SELECT b.bookmark_type, a.folder_color, COUNT(a.bookmark) as bookmarkno, a.bookmark_type FROM edu_annotation_bookmark a inner join edu_bookmark_type b on a.bookmark_type=b.id where a.status=? and a.anno_by =? GROUP BY b.bookmark_type,a.folder_color");
	
	$stmt->bind_param("ss", $param_status,$param_anno_by);
	
	
	$param_status = $active;
	$param_anno_by = $_SESSION['id'];	
	$stmt->execute();
	$stmt->bind_result($bookmark_type,$folder_color, $bookmarkno, $bookmark_typeid);
	 $sr =1;
	 					
	 // fetch values 
	 while ($stmt->fetch()) {
	      if($bookmarkno > 1){$varBm = 'bookmarks';} else { $varBm = 'bookmark';}
		  $folder_color1 = trim($folder_color,"#");
		  echo "<div class='col-lg-6' >
		            <div style='width:100%; color:#ffffff; min-height:100px;display: inline-block; margin:10px 10px; padding:10px 40px; border-radius: 8px; background-color: ".$folder_color."'>                         
					<a href='detail-bookmark.php?bmId=".$bookmark_typeid."&fdcol=".$folder_color1."' style='color:#ffffff;'>".$bookmark_type."</a>
					     <div class='row'>
						 <div style='margin:50px 0px 0px 0px; font-size:10px' class='col-lg-8'>".$bookmarkno." ".$varBm."</div>
						 <div class='col-lg-4' style='margin:50px 0px 0px 0px; font-size:10px' align='right'><i class='material-icons md-10 annocom' id='bmDel' data-id='" . $bookmark_typeid ."_".$folder_color. "'>delete</i></div>
						 </div>
					</div>
					
		        </div>";
		  
		  
		  	$sr++;
	 }*/
	 
	 $stmt = $mysqli->prepare("SELECT a.id,a.bookmark_type, b.folder_color,b.id,c.id, COUNT(c.bookmark) as bookmarkno FROM  edu_bookmark_type a inner join edu_bookmarkfolder b on a.id =b.foldnameid left outer join edu_annotation_bookmark c on c.foldnameid=b.id where  a.status=? and a.created_by =?  GROUP BY b.foldnameid,b.folder_color
");
	
	$stmt->bind_param("ss", $param_status,$param_created_by);	
	$param_status = $active;
	$param_created_by = $_SESSION['id'];	
	$stmt->execute();
	$stmt->bind_result($bookmark_typeid,$bookmark_type,$folder_color,$foldid,$bmIDmain,$bookmarkno);
	 $sr =1;
	 					
	 // fetch values 
	 while ($stmt->fetch()) {
	      if($bookmarkno > 1){$varBm = 'bookmarks';} else { $varBm = 'bookmark';}
		  /*<a href='detail-bookmark.php?bmId=".$bookmark_typeid."&fdcol=".$folder_color1."' style='color:#ffffff;'>".$bookmark_type."</a>*/
		  /*<div style='margin:50px 0px 0px 0px; font-size:10px' class='col-lg-8'>".$bookmarkno." ".$varBm."</div>*/
		  $folder_color1 = trim($folder_color,"#");
		  echo "<div class='col-lg-6' >
		            <div style='width:100%; color:#000000; min-height:100px;display: inline-block; margin:10px 10px; padding:10px 40px; border-radius: 8px; background-color: ".$folder_color."'>                         
					<a href='detail-bookmark-admin.php?fdId=".$foldid."&bmId=".$bookmark_typeid."&fdcol=".$folder_color1."&studID=0' style='color:#000000;'>".$bookmark_type."</a>
					     <div class='row'>
						 <div style='margin:50px 0px 0px 0px; font-size:10px' class='col-lg-8' >".$bookmarkno." ".$varBm."</div>
						 <div class='col-lg-4' style='margin:50px 0px 0px 0px; font-size:10px' align='right'><i class='material-icons md-10 annocom' id='bmDel' data-id='" . $bookmark_typeid ."_".$folder_color."_".$foldid. "'>delete</i></div>
						 </div>
					</div>
					
		        </div>";
		  
		  
		  	$sr++;
	 }
}

if($book_mark_type != '')
{
	
	$stmt = $mysqli->prepare("SELECT a.id FROM  edu_bookmark_type a inner join edu_bookmarkfolder b on a.id =b.foldnameid  where a.bookmark_type = ? and b.folder_color=?");
		   /* Bind parameters */
		   $stmt->bind_param("ss", $param_bookmark_type,$param_folder_color);
		   /* Set parameters */
		   $param_bookmark_type = $_POST['book_mark_type'];
		   $param_folder_color = $_POST['annoColor'];
		   $stmt->execute();
		   $stmt->store_result();
		   $stmt->bind_result($bm_id);
		   $stmt->fetch();
		   $numberofrowsbm_id = $stmt->num_rows;
		   $stmt->close();
	if($numberofrowsbm_id > 0)	 {
	  echo "<script type='text/javascript'>alert('Folder already Exist');
                       </script>";
	}
	else {
	   
	/* Select Query to check if bookmarked */
	$stmt = $mysqli->prepare("SELECT id FROM edu_bookmark_type where bookmark_type=? and created_by=?");
	/* Bind parameters */
	$stmt->bind_param("ss", $param_bookmark_type, $param_created_by);
	/* Set parameters */
	$param_bookmark_type = $_POST['book_mark_type'];
	$param_created_by = $_SESSION['id'];
	$stmt->execute();
	$stmt->bind_result($bookmarkID);
	$stmt->fetch();
	$stmt->close();
   if($bookmarkID == ""){
      $stmt = $mysqli->prepare("INSERT into edu_bookmark_type (bookmark_type,status,created_by,created_date) 
	            	values(?,?,?,?)");	
	  $stmt->bind_param("ssss", $param_bookmark_type,$param_status,$param_created_by,$param_created_date);  
	 
	  $param_bookmark_type = $_POST['book_mark_type'];
	  $param_status = $active;
	  $param_created_by= $_SESSION['id'];
	  $param_created_date=$todaysDate;
	  $stmt->execute();
	  $lastbookmark_type_id = $stmt->insert_id;
	  $stmt->close();
	  
	  $stmt = $mysqli->prepare("INSERT into edu_bookmarkfolder (foldnameid,folder_color,status,created_by,created_date) 
	            	values(?,?,?,?,?)");	
	  $stmt->bind_param("sssss", $param_foldnameid,$param_folder_color,$param_status,$param_created_by,$param_created_date);  
	 
	  $param_foldnameid = $lastbookmark_type_id;
	  $param_folder_color = $_POST['annoColor'];
	  $param_status = $active;
	  $param_created_by= $_SESSION['id'];
	  $param_created_date=$todaysDate;
	  if($stmt->execute()){
	   echo "<script type='text/javascript'>
	          $(document).ready(function(){
		        $('#successAll').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					        });
					        setTimeout(function(){
                                $('#successAll').modal('hide')
                             }, 2000);
							});
							
							setTimeout(function(){
                                window.location='all-bookmarks.php';
                             }, 2000);
                       </script>";
	  }
	  $stmt->close();
   
   }
   else{
     $stmt = $mysqli->prepare("INSERT into edu_bookmarkfolder (foldnameid,folder_color,status,created_by,created_date) 
	            	values(?,?,?,?,?)");	
	  $stmt->bind_param("sssss", $param_foldnameid,$param_folder_color,$param_status,$param_created_by,$param_created_date);  
	 
	  $param_foldnameid = $bookmarkID;
	  $param_folder_color = $_POST['annoColor'];
	  $param_status = $active;
	  $param_created_by= $_SESSION['id'];	
	  $param_created_date=$todaysDate;
	  if($stmt->execute()){
	   echo "<script type='text/javascript'>
	               $(document).ready(function(){
		        $('#successAll').modal({
										  backdrop: 'static',
										  keyboard: true, 
										 show: true
					        });
					        setTimeout(function(){
                                $('#successAll').modal('hide')
                             }, 2000);
							});
							
							setTimeout(function(){
                                window.location='all-bookmarks.php';
                             }, 2000);
                       </script>";
	  }
	  $stmt->close();
   }
   }
/*$stmt = $mysqli->prepare("INSERT into edu_annotation_bookmark (bookmark,status,anno_by,published_date,art_id,act_id,bookmark_type,folder_color) 
	            	values(?,?,?,?,?,?,?,?)");	
	  $stmt->bind_param("ssssssss", $param_bookmark,$param_status,$param_anno_by,$param_published_date,$param_art_id,$param_act_id,$param_bookmark_type,$param_folder_color);  
	 
	  $param_bookmark = 1;
	  $param_status = $active;	
	  $param_anno_by = $_SESSION['id'];	
	  $param_published_date = $todaysDate;
	  $param_art_id = $_POST['art_id'];
	  $param_act_id = $_POST['act_id'];
	  $param_bookmark_type = $_POST['book_mark_type'];
	  $param_folder_color = $_POST['annoColor']; 
	  $stmt->execute();
	  $stmt->close();*/


}


if($bm_id != '')
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

if($bmFolderselect==1){
if($_POST['bookmarkFrom']=="AD"){

$stmt = $mysqli->prepare("SELECT a.id,a.bookmark_type, b.folder_color,b.id,c.id, COUNT(c.bookmark) as bookmarkno FROM  edu_bookmark_type a inner join edu_bookmarkfolder b on a.id =b.foldnameid left outer join edu_annotation_bookmark c on c.foldnameid=b.id where  a.status=? and a.created_by =?  GROUP BY b.foldnameid,b.folder_color
");
	
	$stmt->bind_param("ss", $param_status,$param_created_by);	
	$param_status = $active;
	$param_created_by = $_SESSION['id'];	
	$stmt->execute();
	$stmt->bind_result($bookmark_typeid,$bookmark_type,$folder_color,$foldid,$bmIDmain,$bookmarkno);
	 $sr =1;
	 					
	 // fetch values 
	 while ($stmt->fetch()) {
	      if($bookmarkno > 1){$varBm = 'bookmarks';} else { $varBm = 'bookmark';}
		  /*<a href='detail-bookmark.php?bmId=".$bookmark_typeid."&fdcol=".$folder_color1."' style='color:#ffffff;'>".$bookmark_type."</a>*/
		  /*<div style='margin:50px 0px 0px 0px; font-size:10px' class='col-lg-8'>".$bookmarkno." ".$varBm."</div>*/
		  $folder_color1 = trim($folder_color,"#");
		  echo "<div class='col-lg-6' >
		            <div style='width:100%; color:#000000; min-height:100px;display: inline-block; margin:10px 10px; padding:10px 40px; border-radius: 8px; background-color: ".$folder_color."'>                         
					<a href='detail-bookmark-admin.php?fdId=".$foldid."&bmId=".$bookmark_typeid."&fdcol=".$folder_color1."&studID=0' style='color:#000000;'>".$bookmark_type."</a>
					     <div class='row'>
						 <div style='margin:50px 0px 0px 0px; font-size:10px' class='col-lg-8' >".$bookmarkno." ".$varBm."</div>
						 <div class='col-lg-4' style='margin:50px 0px 0px 0px; font-size:10px' align='right'><i class='material-icons md-10 annocom' id='bmDel' data-id='" . $bookmark_typeid ."_".$folder_color."_".$foldid. "'>delete</i></div>
						 </div>
					</div>
					
		        </div>";
		  
		  
		  	$sr++;
	 }
  }	 
}

if($studId !=0){
   $stmt = $mysqli->prepare("SELECT a.id,a.bookmark_type, b.folder_color,b.id,c.id, COUNT(c.bookmark) as bookmarkno FROM  edu_bookmark_type a inner join edu_bookmarkfolder b on a.id =b.foldnameid left outer join edu_annotation_bookmark c on c.foldnameid=b.id where  a.status=? and a.created_by =?  GROUP BY b.foldnameid,b.folder_color
");
	
	$stmt->bind_param("ss", $param_status,$param_created_by);	
	$param_status = $active;
	$param_created_by = $studId;	
	$stmt->execute();
	$stmt->bind_result($bookmark_typeid,$bookmark_type,$folder_color,$foldid,$bmIDmain,$bookmarkno);
	 $sr =1;
	 					
	 // fetch values 
	 while ($stmt->fetch()) {
	      if($bookmarkno > 1){$varBm = 'bookmarks';} else { $varBm = 'bookmark';}
		  /*<a href='detail-bookmark.php?bmId=".$bookmark_typeid."&fdcol=".$folder_color1."' style='color:#ffffff;'>".$bookmark_type."</a>*/
		  /*<div style='margin:50px 0px 0px 0px; font-size:10px' class='col-lg-8'>".$bookmarkno." ".$varBm."</div>*/
		  $folder_color1 = trim($folder_color,"#");
		  echo "<div class='col-lg-6' >
		            <div style='width:100%; color:#000000; min-height:100px;display: inline-block; margin:10px 10px; padding:10px 40px; border-radius: 8px; background-color: ".$folder_color."'>                         
					<a href='detail-bookmark-admin.php?fdId=".$foldid."&bmId=".$bookmark_typeid."&fdcol=".$folder_color1."&studID=".$studId."' style='color:#000000;'>".$bookmark_type."</a>
					     <div class='row'>
						 <div style='margin:50px 0px 0px 0px; font-size:10px' class='col-lg-8' >".$bookmarkno." ".$varBm."</div>
						 <div class='col-lg-4' style='margin:50px 0px 0px 0px; font-size:10px' align='right'><i class='material-icons md-10 annocom' id='bmDel' data-id='" . $bookmark_typeid ."_".$folder_color."_".$foldid."_".$studId. "'>delete</i></div>
						 </div>
					</div>
					
		        </div>";
		  
		  
		  	$sr++;
	 }
}
?>
