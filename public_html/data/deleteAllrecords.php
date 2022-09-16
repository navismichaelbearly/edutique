<?php
	//submit_rating.php

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

$idActdraft = !empty($_POST['idActdraft'])?$_POST['idActdraft']:0;
$idAct = !empty($_POST['idAct'])?$_POST['idAct']:0;
$idArtdraft = !empty($_POST['idArtdraft'])?$_POST['idArtdraft']:0;
$idArt = !empty($_POST['idArt'])?$_POST['idArt']:0;
$idMesslog = !empty($_POST['idMesslog'])?$_POST['idMesslog']:0;
$idMesslogtech = !empty($_POST['idMesslogtech'])?$_POST['idMesslogtech']:0;
$idViewMess = !empty($_POST['idViewMess'])?$_POST['idViewMess']:0;
$idQuesport = !empty($_POST['idQuesport'])?$_POST['idQuesport']:0;
$idAnnoucelog = !empty($_POST['idAnnoucelog'])?$_POST['idAnnoucelog']:0;
$idAidslog = !empty($_POST['idAidslog'])?$_POST['idAidslog']:0;
$idUsers123 = !empty($_POST['idUsers123'])?$_POST['idUsers123']:0;

if($idActdraft > 0){
	if(isset($_POST['idActdraft'])) {
		$id = trim($_POST['idActdraft']);
		//$count = count($id);
        //$placeholders = implode(',', array_fill(0, $count, '?'));
		//$sql = "DELETE FROM edu_review WHERE review_id in ($id)";
		$stmt = $mysqli->prepare("DELETE FROM edu_activity_dummy WHERE activity_id in ($id)");
		//$stmt->bind_param("s", $review_id);
		//$review_id = $placeholders;
		if($stmt->execute()){
		  $stmt1 = $mysqli->prepare("DELETE FROM edu_activity_audio_dummy WHERE activity_id in ($id)");
		   $stmt1->execute();
		   $stmt1->close(); 
		}
		$stmt->close();
		
		//if(mysqli_query($conn, $sql)){
			echo $id;
		//}
	}
}

if($idAct > 0){
	if(isset($_POST['idAct'])) {
		$id = trim($_POST['idAct']);
		//$count = count($id);
        //$placeholders = implode(',', array_fill(0, $count, '?'));
		//$sql = "DELETE FROM edu_review WHERE review_id in ($id)";
		$stmt = $mysqli->prepare("DELETE FROM edu_activity WHERE activity_id in ($id)");
		//$stmt->bind_param("s", $review_id);
		//$review_id = $placeholders;
		if($stmt->execute()){
		  $stmt1 = $mysqli->prepare("DELETE FROM edu_activity_audio WHERE activity_id in ($id)");
		   $stmt1->execute();
		   $stmt1->close(); 
		}
		$stmt->close();
		
		//if(mysqli_query($conn, $sql)){
			echo $id;
		//}
	}
}

if($idArtdraft > 0){
	if(isset($_POST['idArtdraft'])) {
		$id = trim($_POST['idArtdraft']);
		//$count = count($id);
        //$placeholders = implode(',', array_fill(0, $count, '?'));
		//$sql = "DELETE FROM edu_review WHERE review_id in ($id)";
		$stmt = $mysqli->prepare("DELETE FROM edu_article_dummy WHERE article_id in ($id)");
		//$stmt->bind_param("s", $review_id);
		//$review_id = $placeholders;
		if($stmt->execute()){
		  $stmt1 = $mysqli->prepare("DELETE FROM edu_article_audio_dummy WHERE article_id in ($id)");
		   $stmt1->execute();
		   $stmt1->close(); 
		}
		$stmt->close();
		
		//if(mysqli_query($conn, $sql)){
			echo $id;
		//}
	}
}

if($idArt > 0){
	if(isset($_POST['idArt'])) {
		$id = trim($_POST['idArt']);
		//$count = count($id);
        //$placeholders = implode(',', array_fill(0, $count, '?'));
		//$sql = "DELETE FROM edu_review WHERE review_id in ($id)";
		$stmt = $mysqli->prepare("DELETE FROM edu_article WHERE article_id in ($id)");
		//$stmt->bind_param("s", $review_id);
		//$review_id = $placeholders;
		if($stmt->execute()){
		  $stmt1 = $mysqli->prepare("DELETE FROM edu_article_audio WHERE article_id in ($id)");
		   $stmt1->execute();
		   $stmt1->close(); 
		}
		$stmt->close();
		
		//if(mysqli_query($conn, $sql)){
			echo $id;
		//}
	}
}	

if($idMesslog > 0){
	if(isset($_POST['idMesslog'])) {
		$id = trim($_POST['idMesslog']);
		//$count = count($id);
        //$placeholders = implode(',', array_fill(0, $count, '?'));
		//$sql = "DELETE FROM edu_review WHERE review_id in ($id)";
		$stmt = $mysqli->prepare("DELETE FROM edu_messages WHERE id in ($id)");
		//$stmt->bind_param("s", $review_id);
		//$review_id = $placeholders;
		if($stmt->execute()){
		   
		}
		$stmt->close();
		
		//if(mysqli_query($conn, $sql)){
			echo $id;
		//}
	}
}

if($idMesslogtech > 0){
	if(isset($_POST['idMesslogtech'])) {
		$id = trim($_POST['idMesslogtech']);
		//$count = count($id);
        //$placeholders = implode(',', array_fill(0, $count, '?'));
		//$sql = "DELETE FROM edu_review WHERE review_id in ($id)";
		$stmt = $mysqli->prepare("DELETE FROM edu_messages WHERE id in ($id)");
		//$stmt->bind_param("s", $review_id);
		//$review_id = $placeholders;
		if($stmt->execute()){
		   
		}
		$stmt->close();
		
		//if(mysqli_query($conn, $sql)){
			echo $id;
		//}
	}

}

if($idViewMess > 0){
	if(isset($_POST['idViewMess'])) {
		$id = trim($_POST['idViewMess']);
		//$count = count($id);
        //$placeholders = implode(',', array_fill(0, $count, '?'));
		//$sql = "DELETE FROM edu_review WHERE review_id in ($id)";
		$stmt = $mysqli->prepare("DELETE FROM edu_messages WHERE id in ($id)");
		//$stmt->bind_param("s", $review_id);
		//$review_id = $placeholders;
		if($stmt->execute()){
		   
		}
		$stmt->close();
		
		//if(mysqli_query($conn, $sql)){
			echo $id;
		//}
	}

}

if($idQuesport > 0){
	if(isset($_POST['idQuesport'])) {
		$id = trim($_POST['idQuesport']);
		//$count = count($id);
        //$placeholders = implode(',', array_fill(0, $count, '?'));
		//$sql = "DELETE FROM edu_review WHERE review_id in ($id)";
		$stmt = $mysqli->prepare("DELETE FROM edu_question_portal WHERE id in ($id)");
		//$stmt->bind_param("s", $review_id);
		//$review_id = $placeholders;
		if($stmt->execute()){
		   
		}
		$stmt->close();
		
		//if(mysqli_query($conn, $sql)){
			echo $id;
		//}
	}

}

if($idAnnoucelog > 0){
	if(isset($_POST['idAnnoucelog'])) {
		$id = trim($_POST['idAnnoucelog']);
		//$count = count($id);
        //$placeholders = implode(',', array_fill(0, $count, '?'));
		//$sql = "DELETE FROM edu_review WHERE review_id in ($id)";
		$stmt = $mysqli->prepare("DELETE FROM edu_noti WHERE noti_id in ($id)");
		//$stmt->bind_param("s", $review_id);
		//$review_id = $placeholders;
		if($stmt->execute()){
		   
		}
		$stmt->close();
		
		//if(mysqli_query($conn, $sql)){
			echo $id;
		//}
	}

}

if($idAidslog > 0){
	if(isset($_POST['idAidslog'])) {
		$id = trim($_POST['idAidslog']);
		//$count = count($id);
        //$placeholders = implode(',', array_fill(0, $count, '?'));
		//$sql = "DELETE FROM edu_review WHERE review_id in ($id)";
		$stmt = $mysqli->prepare("DELETE FROM edu_aid WHERE id in ($id)");
		//$stmt->bind_param("s", $review_id);
		//$review_id = $placeholders;
		if($stmt->execute()){
		   
		}
		$stmt->close();
		
		//if(mysqli_query($conn, $sql)){
			echo $id;
		//}
	}

}

if($idUsers123 > 0){
	if(isset($_POST['idUsers123'])) {
		$id = trim($_POST['idUsers123']);
		//$count = count($id);
        //$placeholders = implode(',', array_fill(0, $count, '?'));
		//$sql = "DELETE FROM edu_review WHERE review_id in ($id)";
		$stmt = $mysqli->prepare("DELETE FROM edu_users WHERE user_id in ($id)");
		//$stmt->bind_param("s", $review_id);
		//$review_id = $placeholders;
		if($stmt->execute()){
		   
		}
		$stmt->close();
		
		//if(mysqli_query($conn, $sql)){
			echo $id;
		//}
	}

}

?>