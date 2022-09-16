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
$articleDraft = !empty($_POST['articleDraft'])?$_POST['articleDraft']:0;
if($_SESSION["utypeid"]==$admconst){
   if($articleDraft  == 1)
	{
			
			
			if ($stmt = $mysqli->prepare("SELECT article_title, art_year,theme,genre,article_id,last_modified  FROM edu_article_dummy  order by last_modified DESC ")) {    
			 
			  
			 //$stmt->bind_param("s", $param_teach_id);
			// $param_teach_id = $_SESSION['id'];	
			 
			 $stmt->execute();
			 /* bind variables to prepared statement */
			 $stmt->bind_result($article_title,$art_year, $theme, $genre, $article_id, $last_modified);
			 $sr =1;
			 echo "<table id='example' class='table table-striped table-bordered' style='width:100%; margin-top:20px'>
												<thead>
													<tr><th><input type='checkbox' id='select_all'> Select </th><th>No.</th>
														<th>ArticleTitle</th>
														<th>Year</th>
														<th>Theme</th>
														<th>Last Modified</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
												";
													
			 /* fetch values */
			 while ($stmt->fetch()) {
				  echo "<tr>";
					
				 $draftLink = "save-article-draft.php?artID=".$article_id;
				 $newDate = date("d M Y", strtotime($art_year));
				       echo "<td><input type='checkbox' class='rev_checkbox' data-rev-id='" . $article_id . "'>";
					   echo "<td class='normaltext'>".$sr."</td>";
					   echo "<td class='normaltext'>" . $article_title . "</td>";
					   echo "<td class='normaltext'>" . $newDate . "</td>";
					   echo "<td class='normaltext'>" . $theme . "</td>";
					   echo "<td class='normaltext' >" . $last_modified ."</td>";
					   echo "<td class='normaltext'><a href='".$draftLink."'><i class='material-icons-outlined md-16 annocom' id='editDraft'>create</i></a>&nbsp;&nbsp;<i class='material-icons-outlined md-16 annocom' id='artDel' data-id='" . $article_id . "'>delete</i></td>";
				 
				  
					 echo "</tr>" ;
							$sr++;
			}
			
			echo "
												</tbody>    
											  </table>";
	 }									
	 
	}
	
}	
?>
