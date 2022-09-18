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
	$stmt = $mysqli->prepare("SELECT id,wordbank_type FROM edu_wordbank_type where status=? and created_by=?");
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

if($_POST['wbFolder'] == 1)
{
	
	 $stmt = $mysqli->prepare("SELECT a.id,a.wordbank_type, b.folder_color,b.id,c.id, COUNT(c.wname) as wordbankno FROM edu_wordbank_type a inner join edu_wordfolder b on a.id =b.foldnameid left outer join edu_wordbank c on c.foldnameid=b.id where a.status=? and b.created_by =? GROUP BY b.foldnameid,b.folder_color 
");
	
	$stmt->bind_param("ss", $param_status,$param_created_by);	
	$param_status = $active;
	$param_created_by = $_SESSION['id'];
	$stmt->execute();
	$stmt->bind_result($wordbank_typeid,$wordbank_type,$folder_color,$foldid,$wbIDmain,$wordbankno);
	 $sr =1;
	 					
	 // fetch values 
	 while ($stmt->fetch()) {
	      if($wordbankno > 1){$varBm = 'Words';} else { $varBm = 'Word';}
		  /*<a href='detail-bookmark.php?bmId=".$bookmark_typeid."&fdcol=".$folder_color1."' style='color:#ffffff;'>".$bookmark_type."</a>*/
		  /*<div style='margin:50px 0px 0px 0px; font-size:10px' class='col-lg-8'>".$bookmarkno." ".$varBm."</div>*/
		  $folder_color1 = trim($folder_color,"#");
		  echo "<div class='col-lg-6' >
		            <div style='width:100%; color:#000000; min-height:100px;display: inline-block; margin:10px 10px; padding:10px 40px; border-radius: 8px; background-color: ".$folder_color."'>                         
					<a href='detail-wordbank.php?fdId=".$foldid."&wbId=".$wordbank_typeid."&fdcol=".$folder_color1."' style='color:#000000;'>".$wordbank_type."</a>
					     <div class='row'>
						 <div style='margin:50px 0px 0px 0px; font-size:10px' class='col-lg-8' >".$wordbankno." ".$varBm."</div>
						 <div class='col-lg-4' style='margin:50px 0px 0px 0px; font-size:10px' align='right'><i class='material-icons md-10 annocom' id='wbDel' data-id='" . $wordbank_typeid ."_".$folder_color."_".$foldid. "'>delete</i></div>
						 </div>
					</div>
					
		        </div>";
		  
		  
		  	$sr++;
	 }
}

if($_POST['word_bank_type'] != '')
{
	
	$stmt = $mysqli->prepare("SELECT a.id FROM  edu_wordbank_type a inner join edu_wordfolder b on a.id =b.foldnameid  where a.wordbank_type = ? and b.folder_color=? and b.created_by=?");
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
                                window.location='wordbank.php';
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
                                window.location='wordbank.php';
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


if($_POST['wb_id'] != '')
{
    $wb_id = explode("_",$_POST['wb_id']);
	$stmt = $mysqli->prepare("delete FROM edu_wordbank where wordbank_typeid=? and foldnameid=?");
	$stmt->bind_param("ss", $param_wordbank_type, $param_foldnameid);
	$param_wordbank_type = $wb_id[0];
	$param_foldnameid = $wb_id[2];
	$stmt->execute();
	$stmt->close();
	
	$stmt = $mysqli->prepare("delete FROM edu_wordfolder where folder_color=? and id=?");
	$stmt->bind_param("ss", $param_folder_color, $param_foldnameid);
	$param_folder_color = $wb_id[1];
	$param_foldnameid = $wb_id[2];
	$stmt->execute();
	$stmt->close();
	
}
?>
