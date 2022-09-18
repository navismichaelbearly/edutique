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

$addCLS = !empty($_POST['addCLS'])?$_POST['addCLS']:0;
$classVar = !empty($_POST['classVar'])?$_POST['classVar']:0;
$clsID = !empty($_POST['clsID'])?$_POST['clsID']:0;
$editCLS = !empty($_POST['editCLS'])?$_POST['editCLS']:0;
// If form is submitted 
if($addCLS == 1){
	if(isset($_POST['class_name']) )
	{ 
		// Get the submitted form data 
		$class_name = $_POST['class_name'];
		// Check whether submitted data is not empty 
		if(!empty($class_name) )
		{ 
		   $stmt = $mysqli->prepare("INSERT into edu_class (class_name,class_status, school_id, level_id) 
									values(?,?,?,?)");
							$stmt->bind_param("ssss", $param_class_name, $param_class_status,$param_school_id,$param_level_id);
							$param_class_name = $class_name;
							$param_class_status= $active;
							$param_school_id =$_POST['schoolID'];
							$param_level_id = $_POST['levelID'];
							  if($stmt->execute()){
							   
							  }
							  
							  $stmt->close(); 
			
			
		} 
	}	  
}

if($clsID > 0){
	 $stmt = $mysqli->prepare("SELECT class_name FROM edu_class where level_id=? and school_id=? and class_id=?");
                                                        /* Bind parameters */
                                                        $stmt->bind_param("sss", $param_level_id,$param_school_id,$param_class_id);
                                                        /* Set parameters */
                                                        $param_class_id =$clsID;
                                                        $param_level_id = $_REQUEST['levelIDs'];
														$param_school_id = $_REQUEST['schoolIDs'];
                                                        $stmt->execute();
                                                        $stmt->bind_result($class_name);
                                                        $stmt->fetch();
														echo "<input id='class_nameE' name='class_nameE' class='form-control formfield' type='text' value='".$class_name."'>";
														echo "<input id='class_idE' name='class_idE' class='form-control formfield' type='hidden' value='".$clsID."'>";
                                                        $stmt->close();	  
}

if($classVar == 1){
   if ($stmt = $mysqli->prepare("SELECT class_id,class_name FROM edu_class  where school_id=? and level_id=?")) {

		$stmt->bind_param("ss", $param_school_id, $param_level_id);
		// Set parameters 
		$param_school_id = $_POST['schoolIDs'];
		$param_level_id = $_POST['levelIDs'];

		$stmt->execute();
		/* bind variables to prepared statement */
		$stmt->bind_result($class_id,$class_name);
		$sr = 1;

		echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
		<thead>
			<tr><td>No.</td>
				<th>Classes</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		";

		while ($stmt->fetch()) {
  echo "<tr><td style='vertical-align:middle'>".$sr."</td>";
		       echo "<td class='normaltext'><a href='users.php?scID=".$_POST['schoolIDs']."&lvId=".$_POST['levelIDs']."&clId=".$class_id."'>" . $class_name ."</a></td>";
					   echo "<td class='normaltext' style='vertical-align:middle'><i class='material-icons-outlined md-16 annocom' id='editClass' data-id='" . $class_id . "'>create</i></td>";
		  echo "</tr>" ;
		
		 $sr++;
	 }
   }	 
}

if($editCLS == 1){
	if(isset($_POST['class_nameE']) )
	{ 
		// Get the submitted form data 
		$class_nameE = $_POST['class_nameE'];
		// Check whether submitted data is not empty 
		if(!empty($class_nameE) )
		{ 
		   $stmt = $mysqli->prepare("UPDATE edu_class SET class_name=? where school_id=? and level_id=? and class_id=?");
							$stmt->bind_param("ssss", $param_class_name, $param_school_id, $param_level_id, $param_class_id);
							$param_class_name = $class_nameE;
							$param_school_id = $_POST['schoolID'];
							$param_level_id = $_POST['levelID'];
							$param_class_id = $_POST['class_idE'];
							  if($stmt->execute()){
							   
							  }
							  
							  $stmt->close(); 
			
			
		} 
	}	  
}


?>