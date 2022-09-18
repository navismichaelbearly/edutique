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

$addLVL = !empty($_POST['addLVL'])?$_POST['addLVL']:0;
$levelVar = !empty($_POST['levelVar'])?$_POST['levelVar']:0;
$lvlID = !empty($_POST['lvlID'])?$_POST['lvlID']:0;
$editLVL = !empty($_POST['editLVL'])?$_POST['editLVL']:0;
// If form is submitted 
if($addLVL == 1){
	if(isset($_POST['level_name']) )
	{ 
		// Get the submitted form data 
		$level_name = $_POST['level_name'];
		// Check whether submitted data is not empty 
		if(!empty($level_name) )
		{ 
		   $stmt = $mysqli->prepare("INSERT into edu_levels (level,level_status, school_id) 
									values(?,?,?)");
							$stmt->bind_param("sss", $param_level, $param_level_status,$param_school_id);
							$param_level = $level_name;
							$param_level_status= $active;
							$param_school_id =$_POST['schoolID'];
							  if($stmt->execute()){
							   
							  }
							  
							  $stmt->close(); 
			
			
		} 
	}	  
}

if($lvlID > 0){
	 $stmt = $mysqli->prepare("SELECT level FROM edu_levels where level_id=? and school_id=?");
                                                        /* Bind parameters */
                                                        $stmt->bind_param("ss", $param_level_id,$param_school_id);
                                                        /* Set parameters */
                                                        
                                                        $param_level_id = $lvlID;
														$param_school_id = $_REQUEST['schoolIDs'];
                                                        $stmt->execute();
                                                        $stmt->bind_result($levelname);
                                                        $stmt->fetch();
														echo "<input id='level_nameE' name='level_nameE' class='form-control formfield' type='text' value='".$levelname."'>";
														echo "<input id='level_idE' name='level_idE' class='form-control formfield' type='hidden' value='".$lvlID."'>";
                                                        $stmt->close();	  
}

if($levelVar == 1){
   if ($stmt = $mysqli->prepare("SELECT level_id,level FROM edu_levels  where school_id=?")) {

		$stmt->bind_param("s", $param_school_id);
		// Set parameters 
		$param_school_id = $_POST['schoolIDs'];

		$stmt->execute();
		/* bind variables to prepared statement */
		$stmt->bind_result($level_id,$level);
		$sr = 1;

		echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
		<thead>
			<tr><td>No.</td>
				<th>Levels</th>
				<th>Classes</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		";

		while ($stmt->fetch()) {
  echo "<tr><td style='vertical-align:middle'>".$sr."</td>";
		       echo "<td class='normaltext'>" . $level ."</td>";
					   echo "<td class='normaltext' style='vertical-align:middle'><a href='classes.php?schoolID=".$_POST['schoolIDs']."&levelID=" . $level_id . "'><i class='material-icons-outlined md-16 annocom'  >visibility</i></a></td>";
					   echo "<td class='normaltext' style='vertical-align:middle'><i class='material-icons-outlined md-16 annocom' id='editLevel' data-id='" . $level_id . "'>create</i></td>";
		  echo "</tr>" ;
		
		 $sr++;
	 }
   }	 
}

if($editLVL == 1){
	if(isset($_POST['level_nameE']) )
	{ 
		// Get the submitted form data 
		$level_nameE = $_POST['level_nameE'];
		// Check whether submitted data is not empty 
		if(!empty($level_nameE) )
		{ 
		   $stmt = $mysqli->prepare("UPDATE edu_levels SET level=? where school_id=? and level_id=?");
							$stmt->bind_param("sss", $param_level, $param_school_id, $param_level_id);
							$param_level = $level_nameE;
							$param_school_id = $_POST['schoolID'];
							$param_level_id = $_POST['level_idE'];
							  if($stmt->execute()){
							   
							  }
							  
							  $stmt->close(); 
			
			
		} 
	}	  
}


?>