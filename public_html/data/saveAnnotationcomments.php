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
include '../inc/functions.php';
/* posted variables from Ajax call */
$anno_comments = $_POST['anno_comments'];
$art_id = $_POST['art_id'];
$act_id = $_POST['act_id'];
$com_id = $_POST['com_id'];
$com_id_view = $_POST['com_id_view'];
$selText = $_POST['selText'];
$highlightText= $_POST['highlightText'];
$mag_id = $_POST['mag_id'];
$topStyle = !empty($_POST['top'])?$_POST['top']:'';
$windowSize = !empty($_POST['windowsize'])?$_POST['windowsize']:0;
if($anno_comments != ''){
	  $stmt = $mysqli->prepare("INSERT into edu_annotation_comments (comments,status,anno_by,published_date,art_id, act_id, highlighted_text,mag_id,style)
	            	values(?,?,?,?,?,?,?,?,?)");
	  $stmt->bind_param("sssssssss", $param_comments,$param_status,$param_anno_by,$param_published_date,$param_art_id,$param_act_id,$param_highlighted_text,$param_mag_id,$style);
	  $param_comments = $anno_comments;
	  $param_status = $active;
	  $param_anno_by = $_SESSION['id'];
	  $param_published_date = $todaysDate;
	  $param_art_id = $art_id;
	  $param_act_id = $act_id;
	  $param_highlighted_text = $selText;
	  $param_mag_id = $mag_id;
	  $style = $topStyle;
	  $stmt->execute();
	  $stmt->close();
}
else{
     if ($stmt = $mysqli->prepare("SELECT comments,id,published_date,style from edu_annotation_comments where status=? and anno_by= ? and art_id=? and act_id=? and mag_id=?")) {
        $stmt->bind_param("sssss", $param_status, $param_anno_by, $param_art_id, $param_act_id,$param_mag_id);
	    // Set parameters
        $param_status = $active;
        $param_anno_by = $_SESSION['id'];
		$param_art_id = $art_id;
        $param_act_id =$act_id;
		$param_mag_id = $mag_id;
        $stmt->execute();
	    /* bind variables to prepared statement */
        $stmt->bind_result($comments,$id,$published_date,$style);
        $sr =1;
		$stmt->store_result();
		/*if($stmt->num_rows != 0){
            echo "<span class='pageTitlenew'>Comments</span>";
        }*/
		$style_res = [];
		$comments_res = [];
		$id_res = [];
		$date_res = [];
		$topStyle_res = [];

        while ($stmt->fetch()) {
        	$styleStmt = $mysqli->prepare("SELECT id as `aid`, style from edu_annotation_comments where id !=? and style=?");
        	$styleStmt->bind_param("ss", $id,$style);
        	$styleStmt->execute();
        	$styleStmt->bind_result($aid,$style);
        	$styleStmt->store_result();
        	$styleStmt->fetch();
        	/*if(($styleStmt->num_rows() >= 1) && ($id > $aid)){
        		$style = ($style + 20);
        	}*/
			if(in_array($style, $style_res, true)){
				$style= $style + 19;
			}
			array_push($style_res, $style);
        	$styleStmt->close();
			array_push($id_res, $id);
		    $comments = substr($comments, 0, 20);
			array_push($comments_res, $comments);
			$newDate = date("d M Y H:i A", strtotime($published_date));
			array_push($date_res, $newDate);
			$topStyle = '';

	        $sr++;
        }
		if($windowSize > '830'){
				foreach($style_res as $i=>$style_res_l){
					if($style_res_l < 280){
						$style_res[$i] = 280;
					}
				}
				//echo '<pre>'; print_r($style_res); echo '</pre>';
				foreach($style_res as $style_l){
					$style_dup_keys = array_keys($style_res, $style_l);
					//echo '<pre>'; print_r($style_dup_keys); echo '</pre>';
					if(count($style_dup_keys)>1){
						for($i=1; $i<count($style_dup_keys); $i++){
							$style_key = $style_dup_keys[$i];
							$style_res[$style_key] = $style_res[$style_key] + ($i * 19);

						}
					}
				}

				for($i = 0;$i< count($style_res); $i++){
						$topStyle = 'position:absolute;top:'.$style_res[$i].'px';
						array_push($topStyle_res, $topStyle);
						echo  "<div style='background-color:transparent;width:100%;".$topStyle_res[$i].";display:flex;'>
								  <div width='80%' title='".$date_res[$i]."'>".$comments_res[$i]."...</div>
								  <div width='20%' >
									  <i class='material-icons-outlined md-16 annocom' id='modalPopviewcomment' data-id='" . $id_res[$i] . "'  >remove_red_eye</i>
									  <i class='material-icons-outlined md-16 annocom' id='comDel' data-id='" . $id_res[$i] . "'>delete</i>
								  </div>
							</div>";
						//echo '<pre>'; print_r($style_res); echo '</pre>';
				}
		//echo JSON_encode($comment_data);
		}
		else{
			for($i = 0;$i< count($style_res); $i++){

						echo  "<div style='background-color:transparent;width:100%; display:flex;'>
								  <div width='80%' title='".$date_res[$i]."'>".$comments_res[$i]."...</div>
								  <div width='20%' >
									  <i class='material-icons-outlined md-16 annocom' id='modalPopviewcomment' data-id='" . $id_res[$i] . "'  >remove_red_eye</i>
									  <i class='material-icons-outlined md-16 annocom' id='comDel' data-id='" . $id_res[$i] . "'>delete</i>
								  </div>
							</div>";
						//echo '<pre>'; print_r($style_res); echo '</pre>';
				}
		}
    }
}
if($com_id != '')
{
$stmt = $mysqli->prepare("delete FROM edu_annotation_comments where id=?");
$stmt->bind_param("s", $param_com_id);
$param_com_id = $com_id;
$stmt->execute();
$stmt->close();
}
if($com_id_view != '' && $highlightText == '')
{
$stmt = $mysqli->prepare("SELECT comments,highlighted_text FROM  edu_annotation_comments  WHERE id = ?");
/* Bind parameters */
$stmt->bind_param("s", $param_com_id);
$param_com_id = $com_id_view;
$stmt->execute();
$stmt->bind_result($comments, $highlighted_text);
$stmt->fetch();
echo $comments;
$stmt->close();
}
if($highlightText != '')
{
$stmt = $mysqli->prepare("SELECT highlighted_text FROM  edu_annotation_comments  WHERE id = ?");
/* Bind parameters */
$stmt->bind_param("s", $param_com_id);
$param_com_id = $com_id_view;
$stmt->execute();
$stmt->bind_result($highlighted_text);
$stmt->fetch();
$highlighted_text1= preg_replace('/\s+/', '', $highlighted_text);
echo $highlighted_text;
$stmt->close();
}
?>