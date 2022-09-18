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

if($_POST['wordBank'] != '')
{
	$stmt = $mysqli->prepare("SELECT id,wordbank_type FROM edu_wordbank_type where status=?  and created_by=?");
	/* Bind parameters */
	$stmt->bind_param("ss", $param_status,$param_created_by);
	/* Set parameters */
	
	$param_status = $active;
	$param_created_by = $_SESSION['id'];
	$stmt->execute();
	$stmt->bind_result($id,$wordbank_type);
	 $sr =1;
	 //echo "<select name='bookMarktype' id='bookMarktype' class='form-control' required>";	
	 echo "<input list='wtype' id='wordBanktype' class='form-control' required /></label>"	;
	 echo "<datalist id='wtype'>";				
	 // fetch values 
	 while ($stmt->fetch()) {
	      
		  echo "<option value='" . $wordbank_type . "'>" . $wordbank_type . "</option>";
		  
		  
		  	$sr++;
	 }
	 echo "</datalist>";
}

if($_POST['word_bank_type'] != '')
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
  $stmt = $mysqli->prepare("SELECT a.id FROM  edu_wordbank_type a inner join edu_wordfolder b on a.id =b.foldnameid  where a.wordbank_type = ? and b.folder_color=?  and b.created_by=?");
		   /* Bind parameters */
		   $stmt->bind_param("sss", $param_wordbank_type,$param_folder_color,$param_created_by);
		   /* Set parameters */
		   $param_wordbank_type = $_POST['word_bank_type'];
		   $param_folder_color = $_POST['annoColor'];
		   $param_created_by = $_SESSION['id'];
		   $stmt->execute();
		   $stmt->store_result();
		   $stmt->bind_result($wb_id);
		   $stmt->fetch();
		   $numberofrowswb_id = $stmt->num_rows;
		   $stmt->close();
	if($numberofrowswb_id > 0)	 {
	  echo "<script type='text/javascript'>alert('Folder already Exist');
                       </script>";
	}
	else {
	   
	/* Select Query to check if bookmarked */
	$stmt = $mysqli->prepare("SELECT id FROM edu_wordbank_type where wordbank_type=? and created_by=?");
	/* Bind parameters */
	$stmt->bind_param("ss", $param_wordbank_type, $param_created_by);
	/* Set parameters */
	$param_wordbank_type = $_POST['word_bank_type'];
	$param_created_by = $_SESSION['id'];
	$stmt->execute();
	$stmt->bind_result($wordbankID);
	$stmt->fetch();
	$stmt->close();
   if($wordbankID == ""){
      $stmt = $mysqli->prepare("INSERT into edu_wordbank_type (wordbank_type,status,created_by,created_date) 
	            	values(?,?,?,?)");	
	  $stmt->bind_param("ssss", $param_wordbank_type,$param_status,$param_created_by,$param_created_date);  
	 
	  $param_wordbank_type = $_POST['word_bank_type'];
	  $param_status = $active;
	  $param_created_by= $_SESSION['id'];
	  $param_created_date=$todaysDate;
	  $stmt->execute();
	  $lastwordbank_type_id = $stmt->insert_id;
	  $stmt->close();
	  
	  $stmt = $mysqli->prepare("INSERT into edu_wordfolder (foldnameid,folder_color,status,created_by,created_date) 
	            	values(?,?,?,?,?)");	
	  $stmt->bind_param("sssss", $param_foldnameid,$param_folder_color,$param_status,$param_created_by,$param_created_date);  
	 
	  $param_foldnameid = $lastwordbank_type_id;
	  $param_folder_color = $_POST['annoColor'];
	  $param_status = $active;
	  $param_created_by= $_SESSION['id'];
	  $param_created_date=$todaysDate;
	  if($stmt->execute()){
	    $lastsfoldID = $stmt->insert_id;
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
                                window.location='".$pageT."?artID=".$_POST['art_id']."&actID=".$_POST['act_id']."&magID=".$_POST['magazineID']."&idColorwordbank11=". $lastwordbank_type_id ."_".$lastsfoldID."&selectedText=".$_POST['selText']."';
                             }, 2000);
			        
					
                       </script>";
		 
	    
	  }
	  $stmt->close();
   
   }
   else{
     $stmt = $mysqli->prepare("INSERT into edu_wordfolder (foldnameid,folder_color,status,created_by,created_date) 
	            	values(?,?,?,?,?)");	
	  $stmt->bind_param("sssss", $param_foldnameid,$param_folder_color,$param_status,$param_created_by,$param_created_date);  
	 
	  $param_foldnameid = $wordbankID;
	  $param_folder_color = $_POST['annoColor'];
	  $param_status = $active;
	  $param_created_by= $_SESSION['id'];	
	  $param_created_date=$todaysDate;
	  if($stmt->execute()){
	    $lastsfoldID = $stmt->insert_id;
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
                                window.location='".$pageT."?artID=".$_POST['art_id']."&actID=".$_POST['act_id']."&magID=".$_POST['magazineID']."&idColorwordbank11=". $wordbankID ."_".$lastsfoldID."&selectedText=".$_POST['selText']."';
                             }, 2000);
                       </script>";
					   
		 
	    
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

if($_POST['wbFolder'] == 1)
{
	$stmt = $mysqli->prepare("SELECT a.id,a.wordbank_type, b.folder_color,b.id FROM  edu_wordbank_type a inner join edu_wordfolder b on a.id =b.foldnameid  where  a.status=? and b.created_by =?");
	/* Bind parameters */
	$stmt->bind_param("ss", $param_status,$param_created_by);
	/* Set parameters */
	
	$param_status = $active;
	$param_created_by = $_SESSION['id'];	
	$stmt->execute();
	$stmt->bind_result($wordbank_typeid,$wordbank_type,$folder_color, $foldID);
	 $sr =1;
	 					
	 // fetch values 
	 while ($stmt->fetch()) {
	     // if($bookmarkno > 1){$varBm = 'bookmarks';} else { $varBm = 'bookmark';}
		  $folder_color1 = trim($folder_color,"#");
		  echo "
		             <br>                        
					<span id='saveTowbfolder' class='annocom' data-id='" . $wordbank_typeid ."_".$foldID. "'><span style='padding: 6px 10px; margin:10px 10px; background-color:".$folder_color."'>&nbsp;&nbsp;</span> ".$wordbank_type."</span><br>
					     
					
					
		       ";
		  
		  
		  	$sr++;
	 }
}

if($_POST['idColorwordbank'] != '')
{
$idColorwordbank = explode("_",$_POST['idColorwordbank']);
$stmt = $mysqli->prepare("INSERT into edu_wordbank (wname,wdescription,wstatus,added_by,added_date,art_id,act_id,wordbank_typeid,mag_id,foldnameid) 
	            	values(?,?,?,?,?,?,?,?,?,?)");	
		  $stmt->bind_param("ssssssssss", $param_wname,$param_wdescription,$param_status,$param_added_by,$param_added_date,$param_art_id,$param_act_id,$param_wordbank_typeid,$param_mag_id,$param_foldnameid);  
	 
	   $param_wname = $_POST['selText'];
	  $param_wdescription = $_POST['definition'];
	  $param_status = $active;	
	  $param_added_by = $_SESSION['id'];	
	  $param_added_date = $todaysDate;
	  $param_art_id = $_POST['art_id'];
	  $param_act_id = $_POST['act_id'];
	  $param_wordbank_typeid = $idColorwordbank[0];
	  //$param_folder_color = $idColorbookmark[1]; 
	  $param_mag_id = $_POST['magazineID'];
	  $param_foldnameid =$idColorwordbank[1];
	  $stmt->execute();
	  $stmt->close();

}

?>