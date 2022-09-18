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

if($_POST['bookMark'] != '')
{
	$stmt = $mysqli->prepare("SELECT id,bookmark_type FROM edu_bookmark_type where status=? and created_by=?");
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
	      
		  echo "<option value='" . $bookmark_type . "'>" . $bookmark_type . "</option>";
		  
		  
		  	$sr++;
	 }
	 echo "</datalist>";
}

if($_POST['book_mark_type'] != '')
{
 $pageT = $_POST['pageT'];
 if($pageT == 'act'){
    if($_SESSION["utypeid"]==$admconst){
	   $pageT = 'activity-detail-admin.php';
	}else{
       $pageT = 'activity-detail.php';
	}
 }
 if($pageT == 'art'){
    if($_SESSION["utypeid"]==$admconst){
	   $pageT = 'article-detail-admin.php';
	}else{
       $pageT = 'article-detail.php';
	}
 }
  $stmt = $mysqli->prepare("SELECT a.id FROM  edu_bookmark_type a inner join edu_bookmarkfolder b on a.id =b.foldnameid  where a.bookmark_type = ? and b.folder_color=? and b.created_by=?");
		   /* Bind parameters */
		   $stmt->bind_param("sss", $param_bookmark_type,$param_folder_color,$param_created_by);
		   /* Set parameters */
		   $param_bookmark_type = $_POST['book_mark_type'];
		   $param_folder_color = $_POST['annoColor'];
		   $param_created_by = $_SESSION['id'];
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
	$stmt->bind_param("ss", $param_bookmark_type,$param_created_by);
	/* Set parameters */
	$param_bookmark_type = $_POST['book_mark_type'];
	
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
	    $lastsfoldID = $stmt->insert_id;
		 $stmt = $mysqli->prepare("INSERT into edu_annotation_bookmark (bookmark,status,anno_by,published_date,art_id,act_id,bookmark_type,mag_id,foldnameid) 
	            	values(?,?,?,?,?,?,?,?,?)");	
		  $stmt->bind_param("sssssssss", $param_bookmark,$param_status,$param_anno_by,$param_published_date,$param_art_id,$param_act_id,$param_bookmark_type,$param_mag_id,$param_foldnameid);  
		 
		  $param_bookmark = 1;
		  $param_status = $active;	
		  $param_anno_by = $_SESSION['id'];	
		  $param_published_date = $todaysDate;
		  $param_art_id = $_POST['art_id'];
		  $param_act_id = $_POST['act_id'];
		  $param_bookmark_type = $lastbookmark_type_id;
		  //$param_folder_color = $idColorbookmark[1]; 
		  $param_mag_id = $_POST['magazineID'];
		  $param_foldnameid = $lastsfoldID;
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
                                window.location='".$pageT."?artID=".$_POST['art_id']."&actID=".$_POST['act_id']."&magID=".$_POST['magazineID']."';
                             }, 2000);
                       </script>";	   
	      }
		  $stmt->close();
	    
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
	    $lastsfoldID = $stmt->insert_id;
		 $stmt = $mysqli->prepare("INSERT into edu_annotation_bookmark (bookmark,status,anno_by,published_date,art_id,act_id,bookmark_type,mag_id,foldnameid) 
	            	values(?,?,?,?,?,?,?,?,?)");	
		  $stmt->bind_param("sssssssss", $param_bookmark,$param_status,$param_anno_by,$param_published_date,$param_art_id,$param_act_id,$param_bookmark_type,$param_mag_id,$param_foldnameid);  
		 
		  $param_bookmark = 1;
		  $param_status = $active;	
		  $param_anno_by = $_SESSION['id'];	
		  $param_published_date = $todaysDate;
		  $param_art_id = $_POST['art_id'];
		  $param_act_id = $_POST['act_id'];
		  $param_bookmark_type = $bookmarkID;
		  //$param_folder_color = $idColorbookmark[1]; 
		  $param_mag_id = $_POST['magazineID'];
		  $param_foldnameid = $lastsfoldID;
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
                                window.location='".$pageT."?artID=".$_POST['art_id']."&actID=".$_POST['act_id']."&magID=".$_POST['magazineID']."';
                             }, 2000);
							
		  
                       </script>";
	      }
		 // $stmt->close();
	    
	  }
	  $stmt->close();
   }
   }
/*$s
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

if($_POST['bmFolder'] == 1)
{
	$stmt = $mysqli->prepare("SELECT a.id,a.bookmark_type, b.folder_color,b.id FROM  edu_bookmark_type a inner join edu_bookmarkfolder b on a.id =b.foldnameid  where  b.status=? and b.created_by =?");
	/* Bind parameters */
	$stmt->bind_param("ss", $param_status,$param_anno_by);
	/* Set parameters */
	
	$param_status = $active;
	$param_anno_by = $_SESSION['id'];	
	$stmt->execute();
	$stmt->bind_result($bookmark_typeid,$bookmark_type,$folder_color, $foldID);
	 $sr =1;
	 					
	 // fetch values 
	 while ($stmt->fetch()) {
	     // if($bookmarkno > 1){$varBm = 'bookmarks';} else { $varBm = 'bookmark';}
		  $folder_color1 = trim($folder_color,"#");
		  echo "
		             <br>                        
					<span id='saveTofolder' class='annocom' data-id='" . $bookmark_typeid ."_".$foldID. "'><span style='padding: 6px 10px; margin:10px 10px; background-color:".$folder_color."'>&nbsp;&nbsp;</span> ".$bookmark_type."</span><br>
					     
					
					
		       ";
		  
		  
		  	$sr++;
	 }
}

if($_POST['idColorbookmark'] != '')
{
$idColorbookmark = explode("_",$_POST['idColorbookmark']);
$stmt = $mysqli->prepare("INSERT into edu_annotation_bookmark (bookmark,status,anno_by,published_date,art_id,act_id,bookmark_type,mag_id,foldnameid) 
	            	values(?,?,?,?,?,?,?,?,?)");	
	  $stmt->bind_param("sssssssss", $param_bookmark,$param_status,$param_anno_by,$param_published_date,$param_art_id,$param_act_id,$param_bookmark_type,$param_mag_id,$param_foldnameid);  
	 
	  $param_bookmark = 1;
	  $param_status = $active;	
	  $param_anno_by = $_SESSION['id'];	
	  $param_published_date = $todaysDate;
	  $param_art_id = $_POST['art_id'];
	  $param_act_id = $_POST['act_id'];
	  $param_bookmark_type = $idColorbookmark[0];
	  //$param_folder_color = $idColorbookmark[1]; 
	  $param_mag_id = $_POST['magazineID'];
	  $param_foldnameid =$idColorbookmark[1];
	  $stmt->execute();
	  $stmt->close();

}

?>