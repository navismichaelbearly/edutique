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


if($_POST['folderV'] !='')
{
	//$stmt = $mysqli->prepare("SELECT b.bookmark_type, a.folder_color, COUNT(a.bookmark) as bookmarkno, a.bookmark_type FROM edu_annotation_bookmark a inner join edu_bookmark_type b on a.bookmark_type=b.id where a.status=? and a.anno_by =? and a.bookmark_type=? and a.folder_color=?");
	$stmt = $mysqli->prepare("SELECT a.id,a.wordbank_type, b.folder_color,b.id,c.id, COUNT(c.wname) as wordbankno FROM  edu_wordbank_type a inner join edu_wordfolder b on a.id =b.foldnameid left join edu_wordbank c on c.foldnameid=b.id where  a.status=? and a.created_by =? and c.added_by =? and a.id=? and b.id=? and b.folder_color=? 
");

	/* Bind parameters */
	$stmt->bind_param("ssssss", $param_status,$param_createdby,$param_added_by,$param_wbID,$param_fdID,$param_folder_color);
	/* Set parameters */
	
	$param_status = $active;
	$param_createdby = $_SESSION['id'];
	$param_added_by = $_SESSION['id'];
	$param_wbID = $_POST['wbId'];
	$param_fdID = $_POST['fdId'];
	$param_folder_color = '#'.$_POST['fdcol'];	
	$stmt->execute();
	$stmt->bind_result($wordbank_typeid,$wordbank_type,$folder_color,$foldid,$wbIDmain,$wordbankno);
	 $sr =1;
	 					
	 // fetch values 
	 while ($stmt->fetch()) {
	      if($wordbankno > 1){$varBm = 'words';} else { $varBm = 'word';}
		  echo "<div class='col-lg-12' >
		            <div style='width:100%; color:#000000; min-height:100px; display: inline-block; margin:10px 10px 40px 0px; padding:10px 40px; border-radius: 8px; background-color: #".$_POST['fdcol']."'>                         ".$wordbank_type."
					     <div class='row'>
						 <div style='margin:50px 0px 0px 0px; font-size:10px' class='col-lg-8'>".$wordbankno." ".$varBm."</div>
						 <div class='col-lg-4' style='margin:50px 0px 0px 0px; font-size:10px' align='right'><i class='material-icons md-10 annocom' id='wbDel' data-id='" .$_POST['wbId']."_#".$_POST['fdcol']."_".$_POST['fdId']. "'>delete</i></div>
						 </div>
					</div>
					
		        </div>";
		  
		  
		  	$sr++;
	 }
}



if($_POST['wb_id'] != '' && $_POST['wb_search'] == '')
{
    $wb_id = explode("_",$_POST['wb_id']);
	$stmt = $mysqli->prepare("delete FROM edu_wordbank where wordbank_typeid=? and foldnameid=?");
	$stmt->bind_param("ss", $param_wordbank_typeid, $param_foldnameid);
	$param_wordbank_typeid = $wb_id[0];
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

if($_POST['indvwb_del'] != '')
{
	$stmt = $mysqli->prepare("delete FROM edu_wordbank where id=?");
	$stmt->bind_param("s", $param_wordbank_id);
	$param_wordbank_id = $_POST['indvwb_del'];
	$stmt->execute();
	$stmt->close();
}




if($_POST['mag'] != '' && $_POST['wb_search'] == '')
{
  if ($stmt = $mysqli->prepare("SELECT a.wname,a.wdescription,a.id from edu_wordbank a inner join edu_wordfolder b on a.foldnameid=b.id where a.wstatus=?  and a.wordbank_typeid=? and b.folder_color=? ")) {
	
	
		
	 $stmt->bind_param("sss", $param_status, $param_wordbank_typeid, $param_folder_color);

		 // Set parameters 
	 $param_status = $active;
	 $param_wordbank_typeid = $_POST['wbId'];
	 $param_folder_color = '#'.$_POST['fdcol'];
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($wname,$wdescription, $wid);
	 $sr =1;
	 
	 while ($stmt->fetch()) {
	     
	     echo  "<div class='col-md-6 normaltext' style='padding:15px; font-size:14px'><div style='padding:15px; background-color:#ffffff'>".$wname."
		 <br><span style='font-size:12px'>".$wdescription."</span>
		 <div  align='right'><i class='material-icons md-10 annocom' id='indvwbDel' data-id='".$wid."'>delete</i></div>
		 </div></div>";
		
		 $sr++;
	 }
        	
	}
}

if($_POST['wb_search'] != '')
{
  if ($stmt = $mysqli->prepare("SELECT a.wname,a.wdescription,a.id from edu_wordbank a inner join edu_wordfolder b on a.foldnameid=b.id where a.wstatus=?  and a.wordbank_typeid=? and b.folder_color=? and a.wname like ?")) {
	
	
		
	 $stmt->bind_param("ssss", $param_status, $param_wordbank_typeid, $param_folder_color, $param_wordbankname);
		 // Set parameters 
	 $param_status = $active;
	 $param_status2 = $active;
	 $param_status3 = $active;
	 $param_wordbank_typeid = $_POST['wbId'];
	 $param_folder_color = '#'.$_POST['fdcol'];
	 $param_wordbankname = "%{$_POST['wb_search']}%";
	 
	 $stmt->execute();
		 /* bind variables to prepared statement */
	 $stmt->bind_result($wname,$wdescription, $wid);
	 $sr =1;
	 
	 while ($stmt->fetch()) {
	     
	     echo  "<div class='col-md-6 normaltext'  style='margin:0 20px 20px 0; padding:15px; background-color:#ffffff'>".$wname."
		 <br><span style='font-size:10px'>".$wdescription."</span>
		 <div  align='right'><i class='material-icons md-10 annocom' id='indvwbDel' data-id='".$wid."'>delete</i></div>
		 </div>";
		
		 $sr++;
	 }
        	
	}
}
?>
