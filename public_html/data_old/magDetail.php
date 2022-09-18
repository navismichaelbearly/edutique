<?php
session_start();
/* Checks if user is logged in to the system if not then it will be redirected to login page - security */
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
	header("location: login.php");
	exit;
}

/* include files */
require_once "inc/config.php";
include "inc/constants.php";

error_reporting(E_ERROR | E_PARSE);

$stmt = $mysqli->prepare("SELECT b.school_id FROM edu_users a inner join edu_user_school_level_class b on a.user_id  = b.user_id  WHERE a.user_id = ? and a.user_status = ?");
/* Bind parameters */
$stmt->bind_param("ss", $param_uid, $param_urstatus);
/* Set parameters */
$param_uid = $_SESSION["id"];
$param_urstatus = $active;
$stmt->execute();
$stmt->bind_result($school_id);
$stmt->fetch();
$stmt->close();


$var = "";
// if ($_REQUEST['artID'] != 0 && $_REQUEST['next'] == 1) {
// 	$var = "and c.article_id = (select max(g.article_id) from edu_article g where g.article_id >?)";
// } elseif ($_REQUEST['artID'] != 0 && $_REQUEST['prev'] == 1) {
// 	$var = "and c.article_id = (select min(g.article_id) from edu_article g where g.article_id <?)";
// }

$stmt = $mysqli->prepare("SELECT DISTINCT(c.article_id),c.article_title, c.article_content, c.article_style, d.activity_title, d.activity_content, d.activity_style FROM edu_magazine b inner join edu_article c on b.mag_id = c.mag_id left join edu_activity d on c.article_id = d.article_id LEFT JOIN edu_school_subscription a on a.mag_id=b.mag_id and b.mag_id = ? and a.user_id=? and a.school_subscription_status=? " . $var . " limit 1");
/* Bind parameters */
// if ($_REQUEST['artID'] != 0) {
// 	$stmt->bind_param("ssss", $param_mag_id, $param_uid, $param_urstatus, $param_artid);
// } else {
// 	$stmt->bind_param("sss", $param_mag_id, $param_uid, $param_urstatus);
// }
$stmt->bind_param("sss", $param_mag_id, $param_uid, $param_urstatus);
/* Set parameters */
$param_mag_id = 3;

if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') {
	$param_mag_id = $_REQUEST['magID'];
} else {
	$param_mag_id = 0;
}
$param_uid = $_SESSION["id"];
$param_urstatus = $active;
$param_artid = 1;
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($article_id, $article_title, $article_content, $article_style, $activity_title, $activity_content, $activity_style);
$stmt->fetch();
$stmt->close();

/* Select Query to check if bookmarked */
$stmt = $mysqli->prepare("SELECT bookmark FROM edu_annotation_bookmark  WHERE art_id = ? and mag_id =? and anno_by=? and act_id=?");
/* Bind parameters */
$stmt->bind_param("ssss", $param_artid, $param_mgid, $param_anno_by, $param_actid);
/* Set parameters */
$param_artid = $article_id;
$param_mgid = $_REQUEST['magID'];
if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') {
	$param_mgid = $_REQUEST['magID'];
} else {
	$param_mgid = 0;
}
$param_anno_by = $_SESSION['id'];
$param_actid = 0;
$stmt->execute();
$stmt->bind_result($bookmark);
$stmt->fetch();
$stmt->close();


// $stmt = $mysqli->prepare("SELECT a.article_id as item_id,a.article_published_date as p_date, 'article' as p_type FROM edu_article a inner join edu_school_subscription b1 on a.article_id=b1.article_id WHERE a.mag_id = ? 
// UNION 
// SELECT b.activity_id as item_id, b.activity_published_date as p_date, 'activity' as p_type FROM edu_activity b inner join edu_school_subscription b2 on b.activity_id=b2.activity_id WHERE b.mag_id = ? ORDER BY p_date DESC");


$stmt = $mysqli->prepare("SELECT a.article_id as item_id,a.article_published_date as p_date, 'article' as p_type, 'none' as html, 'none' as src_id FROM edu_article a  WHERE a.mag_id = ? 
UNION 
SELECT b.activity_id as item_id, b.activity_published_date as p_date, 'activity' as p_type, b.activity_html as html, b.article_id as src_id FROM edu_activity b  WHERE b.mag_id = ? ");

/* Bind parameters */
$stmt->bind_param("ss", $param_mag_id, $param_mag_id);
/* Set parameters */
$param_mag_id = $_REQUEST['magID'];
if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') {
	$param_mgid = $_REQUEST['magID'];
} else {
	$param_mgid = 0;
}
$stmt->execute();
$res = $stmt->get_result();
// insert $row values to an array
$items = array();
while ($row = $res->fetch_assoc()) {
	$items[] = $row;
}

$stmt->close();

// split the items array based on the p_type
$articles = array();
$activities = array();
foreach ($items as $item) {
	if ($item['p_type'] == 'article') {
		$articles[] = $item;
	} else {
		$activities[] = $item;
	}
}

// // sort activities based on the p_date
// usort($activities, function ($a, $b) {
// 	return strtotime($a['p_date']) - strtotime($b['p_date']);
// });

// sort articles array based on the p_date
usort($articles, function ($a, $b) {
	return strtotime($a['p_date']) - strtotime($b['p_date']);
});

// merge the articles and activities arrays
$items = array_merge($articles, $activities);

// loop through articles array
$a = '';
$new_sorted = array();
foreach ($articles as $art) {
	// push art to new_sorted
	array_push($new_sorted, $art);
	$a .= ($art['item_id'] . " Art \n");
	$stmt = $mysqli->prepare("SELECT b.activity_id as item_id, b.activity_published_date as p_date, 'activity' as p_type, b.activity_html as html, b.article_id as src_id FROM edu_activity b  WHERE b.mag_id = ? and b.article_id = ? ORDER BY p_date DESC");
	$stmt->bind_param("ss", $param_mag_id, $art['item_id']);
	$stmt->execute();
	$res = $stmt->get_result();
	// insert $row values to an array
	$items = array();
	while ($row = $res->fetch_assoc()) {
		$items[] = $row;
		// push row into new_sorted
		$a .= ($row['item_id'] . " Act \n");
		array_push($new_sorted, $row);
	}

	$stmt->close();
}
$items = $new_sorted;

// if prev is passed to Request, set it to prev 
$current = 1;
// length of the items array as max_row
$max_row = count($items);

//echo ($max_row);
if (isset($_REQUEST['prev']) && $_REQUEST['prev'] != '') {
	$prev = $_REQUEST['prev'];
	$current = $prev;
} else {
	$prev = 1;
}
if (isset($_REQUEST['next']) && $_REQUEST['next'] != '') {
	$next = $_REQUEST['next'];
	$current = $next;
} else {
	$next = 1;
}


if ($stmt = $mysqli->prepare("SELECT a.audio_path from edu_article a inner join edu_school_subscription b on a.article_id=b.article_id  where a.article_status=? and b.school_subscription_status=? and b.school_id= ? and a.article_id=? and a.mag_id= ?")) {

	$stmt->bind_param("sssss", $param_article_status, $param_school_subscription_status, $param_school_id, $param_article_id, $param_mag_id);
	// Set parameters 
	$param_article_status = $active;
	$param_school_subscription_status = $active;
	$param_school_id = $school_id;
	$param_article_id = $article_id;
	$param_mag_id = $_REQUEST['magID'];
	if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') {
		$param_mag_id = $_REQUEST['magID'];
	} else {
		$param_mag_id = 0;
	}
	$stmt->execute();

	$stmt->bind_result($audio_path);
	$stmt->fetch();

	$stmt->close();
}

$audio_path = array();

if (isset($items) && count($items) > 0) {
	if ($items[$current - 1]['p_type'] == 'article') {

		$stmt = $mysqli->prepare("SELECT `path` FROM `edu_article_audio` WHERE `article_id` = " . $items[$current - 1]['item_id']);
		$stmt->execute();
		$res = $stmt->get_result();
		while ($row = $res->fetch_assoc()) {
			$audio_path[] = $row;
		}
		$stmt->close();
	} else if ($items[$current - 1]['p_type'] == 'activity') {
		$stmt = $mysqli->prepare("SELECT `path` FROM `edu_activity_audio` WHERE `activity_id` = " . $items[$current - 1]['item_id']);
		$stmt->execute();
		$res = $stmt->get_result();
		while ($row = $res->fetch_assoc()) {
			$audio_path[] = $row;
		}
		$stmt->close();
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
	<meta name="viewport" content="initial-scale=1.0,minimum-scale=.2,maximum-scale=1.0,user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<?php

	?>
	<title>Edutique System</title>

	<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="css/metisMenu.min.css" rel="stylesheet">

	<!-- Timeline CSS -->
	<link href="css/timeline.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="css/startmin.css" rel="stylesheet">

	<!-- Morris Charts CSS -->
	<link href="css/morris.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

	<link href='lib/main.css' rel='stylesheet' />
	<link href='css/audioplayer.css' rel='stylesheet' />
	<!--<script src="TextTip.js"></script>
	    <link rel="stylesheet" href="TextTip.css">-->
	<!--<link rel="stylesheet" href="assets1/css/main11.css?version=1" />
        <link rel="stylesheet" href="assets1/css/html5sticky.css?version=1" />-->
	<style>
		.inp {
			border: none;
			border-bottom: 1px solid #000000;

			outline: none;
			margin: 10px 0px;
			background: transparent;
		}

		[placeholder]:focus::-webkit-input-placeholder {
			transition: text-indent 0.4s 0.4s ease;
			text-indent: -100%;
			opacity: 1;
		}

		.modal-backdrop.in {

			opacity: .9;
		}

		article {
			/*background: white;*/
			/*border-radius: 4px;*/
			font-size: 13pt;
			margin: auto;
			/* padding: 30px;*/
			/* position: absolute;*/
			text-align: justify;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
		}

		h1 {
			font-size: 17pt;
			text-align: center;
			text-decoration-line: underline;
			text-decoration-color: yellow;
		}

		.dropbtn {
			background-color: transparent;
			padding: 0px;
			font-size: 16px;
			border: none;
			cursor: pointer;
		}



		.dropdown {
			position: relative;
			display: inline-block;
		}


		.dropdown-content {
			display: none;
			position: absolute;
			background-color: #fff;
			min-width: 70px;
			overflow: auto;
			/*box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);*/
			z-index: 1;
		}

		.dropdown-content a {
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
		}

		.dropdown-content2 {
			display: none;
			position: absolute;
			background-color: #fff;
			min-width: 150px;
			overflow: auto;
			/*box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);*/
			z-index: 1;
			font-size: 9px;
		}

		.dropdown-content2 a {
			color: black;
			padding: 5px 5px;
			text-decoration: none;
			display: block;
		}

		/*.dropdown a:hover {background-color: #ddd;}*/

		.show {
			display: block;
		}

		.colorbackviolet {
			background-color: #3f3a60;
			border: 5px solid #FFFFFF;
			cursor: pointer;
		}

		.colorbackyellow {
			background-color: #ffcc00;
			border: 5px solid #FFFFFF;
			cursor: pointer;
		}

		.colorbacklblue {
			background-color: #c2cfe0;
			border: 5px solid #FFFFFF;
			cursor: pointer;
		}

		.colorbackorange {
			background-color: #ef7739;
			border: 5px solid #FFFFFF;
			cursor: pointer;
		}

		.colorbackgreen {
			background-color: #18ce67;
			border: 5px solid #FFFFFF;
			cursor: pointer;
		}

		.colorbackpink {
			background-color: #d65d72;
			border: 5px solid #FFFFFF;
			cursor: pointer;
		}

		.tabcolor {
			border: 5px solid #FFFFFF
		}

		.annocom {
			cursor: pointer;
		}

		.colorbackviolet1 {
			display: inline-block;
			background-color: #3f3a60;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 40px;
			border-radius: 8px;
		}

		.colorbackyellow1 {
			display: inline-block;
			background-color: #ffcc00;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 40px;
			border-radius: 8px;
		}

		.colorbacklblue1 {
			display: inline-block;
			background-color: #c2cfe0;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 40px;
			border-radius: 8px;
		}

		.colorbackorange1 {
			display: inline-block;
			background-color: #ef7739;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 40px;
			border-radius: 8px;
		}

		.colorbackgreen1 {
			display: inline-block;
			background-color: #18ce67;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 40px;
			border-radius: 8px;
		}

		.colorbackpink1 {
			display: inline-block;
			background-color: #d65d72;
			border: 5px solid #FFFFFF;
			cursor: pointer;
			padding: 10px 40px;
			border-radius: 8px;
		}


		/* The sticky note itself */
		.sticky-content {
			/*background: linear-gradient(
				180deg,
				rgba(187, 235, 255, 1) 0%,
				rgba(187, 235, 255, 1) 12%,
				rgba(170, 220, 241, 1) 75%,
				rgba(195, 229, 244, 1) 100%
			);*/
			width: 100%;
			height: 100%;
			font-size: 12px;
			min-height: 150px;
			margin: 10px;
			padding: 8px;
			border-radius: 5px;
			box-shadow: 5px 5px 2px grey;
		}

		.highlight {
			background-color: yellow;
		}

		.highlight2 {
			background-color: #d1fbeb;
		}

		.diselect {
			background-color: transparent;
		}

		media="all and (-ms-high-contrast:none)">*::-ms-backdrop,
		.svg-img {
			width: 100%;
		}

		#SpeechSynthesis {
			background-color: #FFFFFF;
			padding: 20px 10px;
			margin-top: 20px;
		}


		#container-wrap {
			margin: 0;
			font-family: "Barlow", sans-serif;
			padding: 1em;
			font-size: 100%;
		}



		/* text highlight  */
		.tooltip {
			position: relative;
			display: inline-block;
			border-bottom: 1px dotted black;
		}

		.tooltip .tooltiptext {
			visibility: hidden;
			width: 120px;
			background-color: #555;
			color: #fff;
			text-align: center;
			border-radius: 6px;
			padding: 5px 0;
			position: absolute;
			z-index: 1;
			bottom: 125%;
			left: 50%;
			margin-left: -60px;
			opacity: 0;
			transition: opacity 0.3s;
		}

		.tooltip .tooltiptext::after {
			content: "";
			position: absolute;
			top: 100%;
			left: 50%;
			margin-left: -5px;
			border-width: 5px;
			border-style: solid;
			border-color: #555 transparent transparent transparent;
		}

		.tooltip:hover .tooltiptext {
			visibility: visible;
			opacity: 1;
		}

		/* text highlight end */

		#pagefullwidth {
			display: inline-block;
		}

		#rLoud {
			display: none;
		}

		/* Landscape phone to portrait tablet  show the button */
		@media (max-width: 767px) {

			#pagefullwidth {
				display: none;
			}

			#rLoud {
				display: none;
			}

		}
	</style>
	<style>
		<?php echo $article_style; ?>
	</style>

	<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&family=Source+Code+Pro:wght@200;600&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@200;600&display=swap" rel="stylesheet">
</head>

<body oncontextmenu="return false;">

	<div id="wrapper">

		<!-- Navigation -->
		<nav class="navbar-inverse navbar-fixed-top" role="navigation">

			<!-- toggle menu in mobile and tablet view -->
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- /.navbar-top-links -->

			<?php include 'inc/sidebar.php'; ?>
		</nav>

		<div id="page-wrapper">
			<div id="testback"></div>
			<div class="row">
				<div class="col-lg-12 searchbar toppad">
					<div class="sidebar-search">
						<!--<div class="input-group custom-search-form">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Global Search" style="border:none; box-shadow:none">                                    
                                </div>-->

						<i class="material-icons-outlined md-16 annocom" id="pagefullwidth" onclick="myTogglewidthfunction()">zoom_out_map</i>&nbsp;
						<i class="material-icons-outlined md-16 annocom" id="selectText">create</i>
						<!--<i class="material-icons-outlined md-16 annocom" id="modalPop">create</i>-->&nbsp;
						<div class="dropdown">
							<button onClick="myFunction()" class="dropbtn material-icons-outlined" id="modalPop2">sticky_note_2</button>
							<div id="myDropdown" class="dropdown-content">
								<table class="tabcolor">
									<tr>
										<td class="colorbackviolet"><a id="colorbackviolet">&nbsp;</a></td>
										<td class="colorbackyellow"><a id="colorbackyellow">&nbsp;</a></td>
									</tr>
									<tr>
										<td class="colorbacklblue"><a id="colorbacklblue">&nbsp;</a></td>
										<td class="colorbackorange"><a id="colorbackorange">&nbsp;</a></td>
									</tr>
									<tr>
										<td class="colorbackgreen"><a id="colorbackgreen">&nbsp;</a></td>
										<td class="colorbackpink"><a id="colorbackpink">&nbsp;</a></td>
									</tr>
								</table>



							</div>
						</div>&nbsp;
						<div class="dropdown"><?php #if(isset($_COOKIE['name'])) {echo $_COOKIE['name'];}  
												?>
							<?php if ($bookmark != 1) { ?>
								<button onClick="myFunction2()" class="dropbtn material-icons-outlined" id="modalPop3">star</button>
							<?php } else { ?>
								<button class="dropbtn material-icons-outlined" style="color:#FF0000; cursor:default">star</button>
							<?php } ?>
							<div id="myDropdown2" class="dropdown-content2">
								<span style="padding:5px 0px 0px 5px">Save to Bookmark Folder</span>
								<div id="dataBookmarkfolder"></div><br>
								<span id="openModalpop" style="padding:10px;"><span class="material-icons md-16 annocom">add_box</span>Create New Folder</span>
							</div>
						</div>
					</div>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<div class="container-fluid">
				<div id="dataCommentsview1" style="background-color:#99FF00"></div>
				<!--Error-->
				<div id="error_message" class="ui floating negative message" style="display: none">
					<div class="header"></div>
					<p class="message"></p>
				</div>
				<?php
				// ternary statement
				if (!is_array($items)) {
					$nextc = 0;
					$prevc = 0;
				} else {
					$nextc = ($current + 1);
					$prevc = ($current - 1);
					if ($nextc == 0) {
						$nextc = count($items);
					}
					if ($prevc == 0) {
						$prevc = count($items);
					}

					if ($nextc > count($items)) {
						$nextc = $nextc - count($items);
					}
					if ($prevc > count($items)) {
						$prevc = $prevc - count($items);
					}
				}

				// MagId - constant
				// Article Id - next article id
				// activity Id - If next is art 0, else activity Id of next article
				$artid = $actid = 0;
				$magid = $_REQUEST['magID'];
				if ($items[$current]['p_type'] == 'activity') {
					$activity_id = $items[$current]['item_id'];
					$article_id = $items[$current]['src_id'];
				} else {
					$activity_id = 0;
					$article_id = $items[$current]['item_id'];
				}


				$next_url = "magDetail.php?magID=" . $_REQUEST['magID'] . "&artID=" . $article_id . "&actID=" . $activity_id . "&next=" . $nextc;

				$artid = $actid = 0;
				if ($items[$current - 2]['p_type'] == 'activity') {
					$activity_id = $items[$current - 2]['item_id'];
					$article_id = $items[$current - 2]['src_id'];
				} else {
					$activity_id = 0;
					$article_id = $items[$current - 2]['item_id'];
				}

				$prev_url = "magDetail.php?magID=" . $_REQUEST['magID'] . "&artID=" . $article_id . "&actID=" . $activity_id . "&prev=" . $prevc;
				?>
				<div class="row">
					<div class="col-lg-1" style="margin-top:200px;<?php if ($current <= 1) echo ('display:none'); ?>"><a href="<?php echo ($prev_url); ?>" style="text-decoration:none;color:#333333;"><span class='material-icons-outlined' style="font-size: 68px;">keyboard_arrow_left</a></div>
					<div class="col-lg-7" id="test123" onMouseUp="GetSelectedText ()">
						<div id="rLoud">
							<br>
							<div style="background:#FFFFFF; padding:10px">
								<audio preload='auto' controls>
									<source src='<?php echo $audio_path; ?>'>
								</audio>
								<center>Read aloud with me!</center>
							</div>
							<br>
						</div>
						<article>
							<div id="container-wrap">
								<?php
								// print_r items
								//print_r($items);
								if (count($items) > 0) {
									if ($items[$current - 1]['p_type'] == 'activity') {
										$activity_id = $items[$current - 1]['item_id'];
										$query = "SELECT * FROM edu_activity WHERE activity_id = '$activity_id' limit 1";
										$stmt = $mysqli->prepare($query);
										$stmt->execute();
										$res = $stmt->get_result();
										$result1 = array();
										while ($row = $res->fetch_assoc()) {
											$result1[] = $row;
										}
										echo $result1[0]['activity_content'];
										$art_id = $result1[0]['article_id'];

										echo ("<br>");
										echo ("<br>");
										echo ("<br>");
										// echo form element
										echo ("<form action='#' id='submitResult' method='post'>");
										echo ("<input type='hidden' name='activity_id' value='$activity_id'>");
										echo ("<input type='hidden' name='article_id' value=' $art_id'>");
										// echo activity type id

										// if $result1[0]['activity_result'] is not null
										if ($result1[0]['activity_result'] != null) {
											$act_result_disp = htmlspecialchars($result1[0]['activity_result']);
											echo ("<input type='hidden' name='activity_result' value='" . $act_result_disp . "'>");
											echo ("<input type='hidden' name='activity_type_id' value='" . $result1[0]['activity_type_id'] . "'>");
											echo ("<input type='hidden' name='user_id' value='$param_uid'>");
											$act_html = $result1[0]['activity_html'];
											// replace scrabble words with blank spaces
											$act_html = str_replace("Scrambled:", " ", $act_html);
											echo $act_html;

											//echo $result1[0]['activity_html'];
											// echo submit button
											echo ("<input type='submit' value='Submit' class='btn btn-info'/>");
										}
										echo ("</form>");
									} else if ($items[$current - 1]['p_type'] == 'article') {
										$article_id = $items[$current - 1]['item_id'];
										$query = "SELECT * FROM edu_article WHERE article_id = '$article_id' limit 1";
										$stmt = $mysqli->prepare($query);
										$stmt->execute();
										$res = $stmt->get_result();
										$result2 = array();
										while ($row = $res->fetch_assoc()) {
											$result2[] = $row;
										}
										echo $result2[0]['article_content'];
									}
								} else {

									echo ("<br> <h2>No items found</h2>");
								}

								?>

							</div>
						</article>
						<div align="right">
							<?php if ($col1 == $admtchconst) { ?><span><a href="assign.php" class="btn btn-default btn-xl" style="margin-bottom:20px; border:1px solid #999999; padding:5px 10px">Assign/Lock</a></span><?php } ?>
							<span id='dataReadarticle' class="btn btn-default btn-xs" style="background-color:#f9f9f9; color:#333333; margin-bottom:20px; border:1px solid #999999; padding:5px 10px"></span>
						</div>

					</div>
					<div class="col-lg-1" style="margin-top:200px; <?php if ($current > (count($item))) echo ('display:none'); ?>"><a href="<?php echo ($next_url); ?>" style="text-decoration:none;color:#333333;"><span class='material-icons-outlined' style="font-size: 68px;">keyboard_arrow_right</span></a></div>
					<!-- /.col-lg-8 -->
					<div class="col-lg-3" id="rightsidebar">
						<!--<br><br>
                            <i class="material-icons-outlined md-16 annocom" id="selectText">create</i>
                            <i class="material-icons-outlined md-16 annocom" id="modalPop">create</i>&nbsp;
                            <div class="dropdown">
                              <button onClick="myFunction()" class="dropbtn material-icons-outlined" id="modalPop2" >sticky_note_2</button>
                              <div id="myDropdown" class="dropdown-content">
                                <table class="tabcolor">
                                      <tr><td class="colorbackviolet"><a id="colorbackviolet" >&nbsp;</a></td><td class="colorbackyellow"><a id="colorbackyellow">&nbsp;</a></td></tr>
                                      <tr><td class="colorbacklblue"><a id="colorbacklblue">&nbsp;</a></td><td class="colorbackorange"><a id="colorbackorange">&nbsp;</a></td></tr>
                                      <tr><td class="colorbackgreen"><a id="colorbackgreen">&nbsp;</a></td><td class="colorbackpink"><a id="colorbackpink">&nbsp;</a></td></tr>
                                </table>      
                                
                                
                                
                              </div>
                            </div>&nbsp;
                            <div class="dropdown"><?php #if(isset($_COOKIE['name'])) {echo $_COOKIE['name'];}  
													?>
                              <?php #if($bookmark!=1) {
								?>
                              <button onClick="myFunction2()" class="dropbtn material-icons-outlined" id="modalPop3" >star</button>
                              <?php #}else {
								?>
                              <button class="dropbtn material-icons-outlined" style="color:#FF0000; cursor:default"  >star</button>
                              <?php #}
								?>
                              <div id="myDropdown2" class="dropdown-content2">
                                <span style="padding:5px 0px 0px 5px" >Save to Bookmark Folder</span>
                                <div id="dataBookmarkfolder"></div><br>
                                <span id="openModalpop" style="padding:10px;"><span class="material-icons md-16 annocom" >add_box</span>Create New Folder</span>
                              </div>
                            </div>-->
						<!--<i class="material-icons-outlined md-16 annocom" >star</i>-->
						<br>
						<?php
						// foreach $audio_path loop 
						foreach ($audio_path as $key => $value) {
						?>
							<div style="background:#FFFFFF; padding:10px" id="rLoud1">
								<audio preload='auto' controls>
									<source src='<?php echo $value['path']; ?>'>
								</audio>
								<center>Read aloud with me!</center>
							</div>
						<?php } ?>
						<br>

						<div id="dataComments"></div><br>

						<div id="dataStickyview"></div>
						<!--<div id="main">
                                   <a href="#" id="addnote"><img src="assets1/img/add.png" alt="Add Sticky Note" title="Add a new sticky note"></a>
                                   <a href="#" id="removenotes"><img src="assets1/img/remove.png" alt="Remove all sticky notes" title="Remove all sticky notes"></a>
                                   <div class="clear">&nbsp;</div>
                               </div>-->


					</div>
					<!-- /.col-lg-4 -->
				</div>
				<!-- /.row -->
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->




	<!-- Modal popup form to change password -->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<!--<div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Change Your Password</h4>
                      <p class="normaltext"><?php #echo $passwordStrengthtext;
											?>.</p>
                  </div>-->
				<div class="modal-body">
					<h4 class="modal-title">Add Comments</h4>
					<p class="normaltext"><?php #echo $passwordStrengthtext;
											?></p>
					<form role="form" action="" method="post">
						<fieldset>

							<div class="form-group <?php #echo (!empty($new_password_err)) ? 'has-error' : ''; 
													?>">
								<textarea class="form-control" placeholder="Comments" name="anno_comments" id="anno_comments" required></textarea>
								<span id="anno_comments-info" class="info"></span>
							</div>

							<input type="hidden" name="keytoken" value="<?php echo $keytoken; ?>">
							<input type="hidden" name="email" value="<?php echo $email; ?>">
							<input type="hidden" name="passaction" value="reset">
							<input type="button" id="closeModalpop" value="cancel" class="btn btn-lg btn-success btn-block">
							<input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveAnnotationcomments">
						</fieldset>
					</form>
				</div>
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>


	<!-- Modal popup form for toottip -->
	<div class="modal fade" id="myModaltooltip" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content" style="padding: 5px 10px; margin-top:50px">

				<div class="modal-header" style="border-bottom:none; padding: 5px 10px;">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

					<!--<span onClick="myFunction3()" id="wordBanksave">Save to Word bank</span>-->
					<div class="dropdown">

						<a onClick="myFunction3()" id="modalPop4" style="color:#333333; text-decoration:none;" class="annocom">Save to Wordbank</a>

						<div id="myDropdown3" class="dropdown-content2">
							<span style="padding:5px 0px 0px 5px">Save to Wordbank Folder</span>
							<div id="dataWordbankfolder"></div><br>
							<span id="openModalpopWB" style="padding:10px;"><span class="material-icons md-16 annocom">add_box</span>Create New Folder</span>
						</div>
					</div>
					&nbsp;&nbsp;&nbsp;<span class="annocom">Look Up</span>&nbsp;&nbsp;&nbsp;<span id="hihLighttext" class="annocom">Highlight</span>&nbsp;&nbsp;&nbsp;<span id="modalPop" class="annocom">Comment</span>

				</div>
				<!--<div class="modal-body">
                      
                 </div>-->
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>




	<!-- Modal popup form to change password -->
	<div class="modal fade" id="myModalviewcomment" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<!--<div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Change Your Password</h4>
                      <p class="normaltext"><?php #echo $passwordStrengthtext;
											?>.</p>
                  </div>-->
				<div class="modal-body">
					<h4 class="modal-title">Your Comment</h4>
					<p class="normaltext"><?php #echo $passwordStrengthtext;
											?></p>
					<form role="form" action="" method="post">
						<fieldset>

							<div class="form-group <?php #echo (!empty($new_password_err)) ? 'has-error' : ''; 
													?>">
								<textarea class="form-control" placeholder="Comments" name="anno_comments" id="dataCommentsview" required></textarea>
								<span id="anno_comments-info" class="info"></span>
							</div>

							<input type="button" id="closeModalpop2" value="cancel" class="btn btn-lg btn-success btn-block">
						</fieldset>
					</form>
				</div>
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>

	<!-- Modal popup form to change password -->
	<div class="modal fade" id="myModalcolor" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content" id="modal-content">


				<div class="modal-header" style="border-bottom:none">
					<button type="button" class="close" data-dismiss="modal">&times;</button>

				</div>

				<div class="modal-body">

					<form role="form" action="" method="post">
						<fieldset>

							<div class="form-group">
								<textarea class="form-control" placeholder="Add Notes" name="anno_sticky" id="anno_sticky" required style="outline: none !important;
    border:1px solid #000000;"></textarea>
								<span id="anno_sticky-info" class="info"></span>
							</div>

							<input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveAnnotationsticky" style="background-color:#000000">
						</fieldset>
					</form>
				</div>
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>


	<!-- Modal popup form to create new bookmark folder -->
	<div class="modal fade" id="myModalBK" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header" style="border-bottom:none">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Create a new Bookmark folder</h4>
				</div>
				<div class="modal-body">

					<form role="form" action="" method="post">
						<fieldset>
							<label>Folder Name</label>
							<div class="form-group">
								<span id="dataBookmarktype"></span>
								<span id="dataBookmarkfolderexists"></span>

							</div>
							<label>Folder Colour</label>
							<div class="form-group">
								<table class="tabcolor">
									<tr>
										<td><input type="button" value="" id="colorbackviolet1" class="colorbackviolet1"></td>
										<td><input type="button" value="" id="colorbackyellow1" class="colorbackyellow1"></td>
										<td><input type="button" value="" id="colorbackgreen1" class="colorbackgreen1"></td>
									</tr>
									<tr>
										<td><input type="button" value="" id="colorbacklblue1" class="colorbacklblue1"></td>
										<td><input type="button" value="" id="colorbackorange1" class="colorbackorange1"></td>
										<td><input type="button" value="" id="colorbackpink1" class="colorbackpink1"> </td>
									</tr>
								</table>
							</div>
							<input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveFolder">
						</fieldset>
					</form>
				</div>
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>

	<!-- Modal popup form to create wordbank new folder -->
	<div class="modal fade" id="myModalWB" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header" style="border-bottom:none">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Create a new Wordbank folder</h4>
				</div>
				<div class="modal-body">

					<form role="form" action="" method="post">
						<fieldset>
							<label>Folder Name</label>
							<div class="form-group">
								<span id="dataWordbanktype"></span>
								<span id="dataWordbankfolderexists"></span>

							</div>
							<label>Add Definition</label>
							<div class="form-group">
								<textarea id="definition" class="form-control"></textarea>
							</div>
							<label>Folder Colour</label>
							<div class="form-group">
								<table class="tabcolor">
									<tr>
										<td><input type="button" value="" id="colorbackviolet2" class="colorbackviolet1"></td>
										<td><input type="button" value="" id="colorbackyellow2" class="colorbackyellow1"></td>
										<td><input type="button" value="" id="colorbackgreen2" class="colorbackgreen1"></td>
									</tr>
									<tr>
										<td><input type="button" value="" id="colorbacklblue2" class="colorbacklblue1"></td>
										<td><input type="button" value="" id="colorbackorange2" class="colorbackorange1"></td>
										<td><input type="button" value="" id="colorbackpink2" class="colorbackpink1"> </td>
									</tr>
								</table>
							</div>
							<input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveWBFolder">
						</fieldset>
					</form>
				</div>
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>

	<!-- Modal popup form to create wordbank new folder -->
	<div class="modal fade" id="myModalsaveexistWB" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header" style="border-bottom:none">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Add Definition</h4>
				</div>
				<div class="modal-body">

					<form role="form" action="" method="post">
						<fieldset>


							<div class="form-group">
								<textarea id="definition2" class="form-control"></textarea>
							</div>

							<input type="submit" class="btn btn-lg btn-success btn-block" value="Save" id="saveexistWBFolder">
						</fieldset>
					</form>
				</div>
				<!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </div>-->
			</div>

		</div>
	</div>
	<!-- Modal popup form for success -->
	<div class="modal fade" id="successAll" role="dialog" align="center">
		<div class="modal-dialog" style="margin-top:150px;">

			<!-- Modal content-->
			<div class="modal-content1">

				<div class="modal-body1">

					<img src="images/tick-icon.png" width="100" height="100" style="width:100px; height:100px;">
					<div>
						<h2 style="color:#f9f9f9" id="successMessage"></h2>
					</div>
					<div>
						<h2 style="color:#f9f9f9; background-color:darkgreen" id="successclose">Click Here to Exit</h2>
					</div>

				</div>
				<!--<div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                         </div>-->
			</div>

		</div>
	</div>

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->





	<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script-->

	<!-- <script>!window.jQuery && document.write(unescape('%3Cscript src="assets1/js/jquery1.6.2.js"%3E%3C/script%3E'))</script>-->

	<!--script src="assets1/js/respond.min.js"></script>
    <script src="assets1/js/modernizr.custom.23610.js"></script>
    <script src="assets1/js/html5sticky.js"></script>
    <script src="assets1/js/prettyDate.js"></script>
	<script src="magfile/compatibility.min.js"></script>
        <script src="magfile/theViewer.min.js"></script>
        <script>
              try{
                 theViewer.defaultViewer = new theViewer.Viewer({});
              }catch(e){}
        </script-->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/metisMenu.min.js"></script>
	<script src="js/startmin.js"></script>
	<script src='lib/main.js'></script>
	<script src="js/audioplayer.js"></script>
	<!--Scripts-->
	<!--Required for Annotator.js-->
	<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script-->

	<script>
		$(function() {
			$('audio').audioPlayer();
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {


			// when form with id submitResult is submitted, call the function submitResult()
			$("#submitResult").submit(function(e) {
				e.preventDefault();
				// fetch formdata in var
				var formData = new FormData($(this)[0]);
				// ajax call to submitResult.php
				$.ajax({
					url: "data/submitActivityResult.php",
					type: "POST",
					data: formData,
					async: false,
					cache: false,
					contentType: false,
					processData: false,
					success: function(data) {
						// if success, call the function submitResult()
						//submitResult();
						console.log(data);
						// add data to div with id successMessage

						$('#successMessage').text(data);
						$('#submitResult')[0].reset();
						setTimeout(function() {
							$('#successAll').modal('hide');
						}, 10000);
						setTimeout(function() {
							//window.location = 'activities.php';
						}, 10000);

					}
				});
				console.log('a')
				//$('#submitResult')[0].reset();
				$('#successAll').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				setTimeout(function() {
					$('#successAll').modal('hide');
				}, 10000);
				setTimeout(function() {
					//window.location = 'activities.php';
				}, 10000);
			});
			// on click of successclose id
			$(document).on("click", "#successclose", function() {
				$('#successAll').modal('hide');
			});

			//-----------read article  --------------------------------------
			function readArticlefunc() {
				var readArticlechecked = 1;
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var magazineID = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
									else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/extra/readArtact2.php',
					data: {
						readArticlechecked: readArticlechecked,
						art_id: art_id,
						magazineID: magazineID
					},
					cache: false,
					success: function(data) {
						$("#dataReadarticle").html(data);

					}
				});
				event.preventDefault();
			}
			$(window).on('load', function() {

				readArticlefunc();

			});
			$(document).on("click", "#readArticle", function() { // onclic function

				var readArticlenew = 1
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var mag_id = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
								else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/extra/readArtact.php',
					data: {
						readArticlenew: readArticlenew,
						art_id: art_id,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						$('#successAll').modal({
							backdrop: 'static',
							keyboard: true,
							show: true
						});
						setTimeout(function() {
							$('#successAll').modal('hide');
						}, 2000);
						readArticlefunc();

					}
				});
				event.preventDefault();
			});
			//-----------get article detail --------------------------------------
			$(window).on('load', function() {
				var artDetail = 1;
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var artDetailcss = '';
				var mag_id = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
								else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/getArtact.php',
					data: {
						artDetail: artDetail,
						art_id: art_id,
						artDetailcss: artDetailcss,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						$("#container-wrap").html(data);

					}
				})

				var artDetail = '';
				var art_id = <?php echo $_REQUEST['artID']; ?>;
				var artDetailcss = 1;
				var mag_id = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
								else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/getArtact.php',
					data: {
						artDetail: artDetail,
						art_id: art_id,
						artDetailcss: artDetailcss,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						$("#dataArticlecss").html(data);

					}
				})
			});

			//-------------------sticky notes annotations-------------------------
			var varColor;
			$('#colorbackviolet').on('click', function() {
				varColor = '#3f3a60';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#3f3a60',
				});
				$('#anno_sticky').css({
					'background-color': '#3f3a60',
				});
				stickyNotessave(varColor);
			});
			$('#modalcClose').on('click', function() {
				$('#colorbackviolet').modal('hide');
			});
			$('#colorbackyellow').on('click', function() {
				varColor = '#ffcc00';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#ffcc00',
				});
				$('#anno_sticky').css({
					'background-color': '#ffcc00',
				});
				stickyNotessave(varColor);
			});
			$('#colorbacklblue').on('click', function() {
				varColor = '#c2cfe0';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#c2cfe0',
				});
				$('#anno_sticky').css({
					'background-color': '#c2cfe0',
				});
				stickyNotessave(varColor);
			});
			$('#colorbackorange').on('click', function() {
				varColor = '#ef7739';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#ef7739',
				});
				$('#anno_sticky').css({
					'background-color': '#ef7739',
				});
				stickyNotessave(varColor);
			});
			$('#colorbackgreen').on('click', function() {
				varColor = '#18ce67';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#18ce67',
				});
				$('#anno_sticky').css({
					'background-color': '#18ce67',
				});
				stickyNotessave(varColor);
			});
			$('#colorbackpink').on('click', function() {
				varColor = '#d65d72';
				$('#myModalcolor').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#modal-content').css({
					'background-color': '#d65d72',
				});
				$('#anno_sticky').css({
					'background-color': '#d65d72',
				});
				stickyNotessave(varColor);
			});
			$('#modalPop').on('click', function() {
				$('#myModal').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				$('#myModaltooltip').modal('hide');

			});

			function displayStickynotes() {
				var annoColor = '';
				var anno_sticky = '';
				var art_id = <?php echo $article_id; ?>;
				var act_id = 0;
				var sticky_id = '';
				var sticky_id_view = '';
				var mag_id = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
								else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/saveAnnotationsticky.php',
					data: {
						anno_sticky: anno_sticky,
						art_id: art_id,
						act_id: act_id,
						sticky_id: sticky_id,
						sticky_id_view: sticky_id_view,
						annoColor: annoColor,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {

						$("#dataStickyview").html(data);


					}
				});
				event.preventDefault();
			}

			$('#saveAnnotationsticky').on('click', function() {
				var annoColor = varColor;
				var anno_sticky = $("#anno_sticky").val();
				var art_id = <?php echo $article_id; ?>;
				var act_id = 0;
				var sticky_id = '';
				var sticky_id_view = '';
				var mag_id = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
								else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/saveAnnotationsticky.php',
					data: {
						anno_sticky: anno_sticky,
						art_id: art_id,
						act_id: act_id,
						sticky_id: sticky_id,
						sticky_id_view: sticky_id_view,
						annoColor: annoColor,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						$('#successAll').modal({
							backdrop: 'static',
							keyboard: true,
							show: true
						});
						setTimeout(function() {
							$('#successAll').modal('hide');
						}, 2000);
						$('#anno_sticky').val('');
						// window.location='article-detail.php?artID=<?php #echo $_REQUEST['artID'];
																		?>';
						//$("#dataStickyview").html(data); 
						$('#myModalcolor').modal('hide');
						displayStickynotes();

					}
				});
				event.preventDefault();
			});

			$(window).on('load', function() {

				displayStickynotes();
			});

			$(document).on("click", "#stickyDel", function(e) { // onclic function
				e.preventDefault();
				var annoColor = '';
				var anno_sticky = '';
				var art_id = <?php echo $article_id; ?>;
				var act_id = 0;
				var sticky_id = $(this).data('id');
				var sticky_id_view = '';
				var mag_id = '';
				var result = confirm("Are you sure you want to delete the Sticky Note?");
				if (result) {
					$.ajax({
						type: 'POST',
						url: 'data/saveAnnotationsticky.php',
						data: {
							anno_sticky: anno_sticky,
							art_id: art_id,
							act_id: act_id,
							sticky_id: sticky_id,
							sticky_id_view: sticky_id_view,
							annoColor: annoColor
						},
						cache: false,
						success: function(data) {
							$('#successAll').modal({
								backdrop: 'static',
								keyboard: true,
								show: true
							});
							setTimeout(function() {
								$('#successAll').modal('hide');
							}, 2000);
							displayStickynotes();

						}
					});
				}
			});

			$('#closeModalpop').on('click', function() {
				$('#myModal').modal('hide');
			});

			//---------------comments Annotations-------------------------
			function displayComment() {
				var anno_comments = '';
				var art_id = <?php echo $article_id; ?>;
				var act_id = 0;
				var com_id = '';
				var com_id_view = '';
				var highlightText = '';
				var mag_id = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
								else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/saveAnnotationcomments.php',
					data: {
						anno_comments: anno_comments,
						art_id: art_id,
						act_id: act_id,
						com_id: com_id,
						com_id_view: com_id_view,
						selText: selText,
						highlightText: highlightText,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						$("#dataComments").html(data);


					}
				});
				event.preventDefault();
			}
			$(document).on("click", "#modalPopviewcomment", function() {
				$('#myModalviewcomment').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				var anno_comments = '';
				var art_id = '';
				var act_id = '';
				var com_id = '';
				var highlightText = '';
				var mag_id = '';
				var com_id_view = $(this).data('id');
				$.ajax({
					type: 'POST',
					url: 'data/saveAnnotationcomments.php',
					data: {
						anno_comments: anno_comments,
						art_id: art_id,
						act_id: act_id,
						com_id: com_id,
						com_id_view: com_id_view,
						selText: selText,
						highlightText: highlightText,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						$("#dataCommentsview").html(data);

					}
				});


			});
			$('#closeModalpop2').on('click', function() {
				$('#myModalviewcomment').modal('hide');

			});

			$(document).on("click", "#modalPopviewcomment", function() {

				var anno_comments = '';
				var art_id = '';
				var act_id = '';
				var com_id = '';
				var com_id_view = $(this).data('id');
				var highlightText = 1;
				var mag_id = '';
				$.ajax({
					type: 'POST',
					url: 'data/saveAnnotationcomments.php',
					data: {
						anno_comments: anno_comments,
						art_id: art_id,
						act_id: act_id,
						com_id: com_id,
						com_id_view: com_id_view,
						selText: selText,
						highlightText: highlightText,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						$('#spanHigh').removeClass('highlight').addClass('diselect');
						$("#spanHigh").attr("id", "newId");
						highlight(data.trimStart());
					}
				});


			});
			$(window).on('load', function() {

				displayComment();
			});
			$('#saveAnnotationcomments').on('click', function() {
				var anno_comments = $("#anno_comments").val();

				var art_id = <?php echo $article_id; ?>;
				var act_id = 0;
				var com_id = '';
				var com_id_view = '';
				var highlightText = '';
				var mag_id = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
								else echo 0; ?>;
				if (anno_comments == "") {
					$("#anno_comments-info").html("Please enter the comment.");
					$("#anno_comments").addClass("input-error");
					return false;
				} else {
					$.ajax({
						type: 'POST',
						url: 'data/saveAnnotationcomments.php',
						data: {
							anno_comments: anno_comments,
							art_id: art_id,
							act_id: act_id,
							com_id: com_id,
							com_id_view: com_id_view,
							selText: selText,
							highlightText: highlightText,
							mag_id: mag_id
						},
						cache: false,
						success: function(data) {
							$('#successAll').modal({
								backdrop: 'static',
								keyboard: true,
								show: true
							});
							setTimeout(function() {
								$('#successAll').modal('hide');
							}, 2000);
							$('#anno_comments').val('');
							$('#myModal').modal('hide');
							// window.location='article-detail.php?artID=<?php echo $_REQUEST['artID']; ?>';
							displayComment();

						}
					});
					event.preventDefault();
				}
			});

			$(document).on("click", "#comDel", function(e) { // onclic function
				e.preventDefault();
				var anno_comments = '';
				var art_id = '';
				var act_id = '';
				var com_id = $(this).data('id');
				var com_id_view = '';
				var highlightText = '';
				var mag_id = '';
				var result = confirm("Are you sure you want to delete the comment?");
				if (result) {
					$.ajax({
						type: 'POST',
						url: 'data/saveAnnotationcomments.php',
						data: {
							anno_comments: anno_comments,
							art_id: art_id,
							act_id: act_id,
							com_id: com_id,
							com_id_view: com_id_view,
							selText: selText,
							highlightText: highlightText,
							mag_id: mag_id
						},
						cache: false,
						success: function(data) {
							$('#successAll').modal({
								backdrop: 'static',
								keyboard: true,
								show: true
							});
							setTimeout(function() {
								$('#successAll').modal('hide');
							}, 2000);
							//window.location='article-detail.php';
							displayComment();

						}
					});
				}
			});

			//--------------------------------------book marks------------------------------------------------

			$('#openModalpop').on('click', function() {
				$('#myModalBK').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
			});



			$(window).on('load', function() { // onload jQuery Ajax Calls in PHP Script
				var bookMark = 1;
				var annoColor = '';
				var book_mark_type = '';
				var art_id = 0;
				var act_id = 0;
				var bmFolder = 0;
				var idColorbookmark = '';
				var magazineID = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
									else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/bookMarkannotations.php',
					data: {
						book_mark_type: book_mark_type,
						bookMark: bookMark,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						bmFolder: bmFolder,
						idColorbookmark: idColorbookmark,
						magazineID: magazineID
					},
					cache: false,
					success: function(data) {
						$("#dataBookmarktype").html(data);

					}
				})

			});

			var varColor1;

			$('#colorbackviolet1').on('click', function() {
				varColor1 = '#3f3a60';
			});
			$('#colorbackyellow1').on('click', function() {
				varColor1 = '#ffcc00';
			});
			$('#colorbacklblue1').on('click', function() {
				varColor1 = '#c2cfe0';
			});
			$('#colorbackorange1').on('click', function() {
				varColor1 = '#ef7739';
			});
			$('#colorbackgreen1').on('click', function() {
				varColor1 = '#18ce67';
			});
			$('#colorbackpink1').on('click', function() {
				varColor1 = '#d65d72';
			});


			$('#saveFolder').on('click', function() { // onclic function
				var annoColor = varColor1;
				var book_mark_type = $("#bookMarktype").val();
				var art_id = <?php echo $article_id; ?>;
				var act_id = 0;
				var bmFolder = 0;
				var bookMark = '';
				var idColorbookmark = '';
				var magazineID = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
									else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/bookMarkannotations.php',
					data: {
						book_mark_type: book_mark_type,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						bmFolder: bmFolder,
						bookMark: bookMark,
						idColorbookmark: idColorbookmark,
						magazineID: magazineID
					},
					cache: false,
					success: function(data) {
						$('#myModalBK').modal('hide');
						// alert('Bookmark added to the New Folder successfully');
						// window.location='article-detail.php?artID=<?php echo $_REQUEST['artID']; ?>&magID=<?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
																												else echo 0; ?>';
						$("#dataBookmarkfolderexists").html(data);
					}
				});
				event.preventDefault();

			});

			$('#modalPop3').on('click', function() { // onload jQuery Ajax Calls in PHP Script
				var bookMark = '';
				var annoColor = '';
				var book_mark_type = '';
				var art_id = 0;
				var act_id = 0;
				var bmFolder = 1;
				var idColorbookmark = '';
				var magazineID = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
									else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/bookMarkannotations.php',
					data: {
						book_mark_type: book_mark_type,
						bookMark: bookMark,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						bmFolder: bmFolder,
						idColorbookmark: idColorbookmark,
						magazineID: magazineID
					},
					cache: false,
					success: function(data) {
						$("#dataBookmarkfolder").html(data);

					}
				});

			});

			$(document).on("click", "#saveTofolder", function(e) { // onclic function
				e.preventDefault();
				var bookMark = '';
				var annoColor = '';
				var book_mark_type = '';
				var art_id = <?php echo $article_id; ?>;
				var act_id = 0;
				var bmFolder = '';
				var idColorbookmark = $(this).data('id');
				var magazineID = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
									else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/bookMarkannotations.php',
					data: {
						book_mark_type: book_mark_type,
						bookMark: bookMark,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						bmFolder: bmFolder,
						idColorbookmark: idColorbookmark,
						magazineID: magazineID
					},
					cache: false,
					success: function(data) {
						$('#successAll').modal({
							backdrop: 'static',
							keyboard: true,
							show: true
						});
						setTimeout(function() {
							$('#successAll').modal('hide');
						}, 2000);
						setTimeout(function() {
							window.location = 'article-detail.php?artID=<?php echo $article_id; ?>&actID=0&magID=<?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
																													else echo 0; ?>';
						}, 2000);


					}
				});

			});
			//--------------------------------------word bank------------------------------------------------
			$('#openModalpopWB').on('click', function() {
				$('#myModalWB').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
			});

			$(window).on('load', function() { // onload jQuery Ajax Calls in PHP Script
				var wordBank = 1;
				var annoColor = '';
				var word_bank_type = '';
				var art_id = 0;
				var act_id = 0;
				var wbFolder = 0;
				var idColorwordbank = '';
				var definition = '';
				var pageT = '';
				var magazineID = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
									else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/addWordbank.php',
					data: {
						word_bank_type: word_bank_type,
						wordBank: wordBank,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						wbFolder: wbFolder,
						idColorwordbank: idColorwordbank,
						magazineID: magazineID,
						selText: selText,
						definition: definition,
						pageT: pageT
					},
					cache: false,
					success: function(data) {
						$("#dataWordbanktype").html(data);

					}
				})

			});

			var varColor2;

			$('#colorbackviolet2').on('click', function() {
				varColor2 = '#3f3a60';
			});
			$('#colorbackyellow2').on('click', function() {
				varColor2 = '#ffcc00';
			});
			$('#colorbacklblue2').on('click', function() {
				varColor2 = '#c2cfe0';
			});
			$('#colorbackorange2').on('click', function() {
				varColor2 = '#ef7739';
			});
			$('#colorbackgreen2').on('click', function() {
				varColor2 = '#18ce67';
			});
			$('#colorbackpink2').on('click', function() {
				varColor2 = '#d65d72';
			});

			$('#saveWBFolder').on('click', function() { // onclic function
				var annoColor = varColor2;
				var word_bank_type = $("#wordBanktype").val();
				var art_id = <?php echo $article_id; ?>;
				var act_id = 0;
				var wbFolder = 0;
				var wordBank = '';
				var idColorwordbank = '';
				var magazineID = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
									else echo 0; ?>;
				var definition = $("#definition").val();
				var pageT = 'art';
				$.ajax({
					type: 'POST',
					url: 'data/addWordbank.php',
					data: {
						word_bank_type: word_bank_type,
						wordBank: wordBank,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						wbFolder: wbFolder,
						idColorwordbank: idColorwordbank,
						magazineID: magazineID,
						selText: selText,
						definition: definition,
						pageT: pageT
					},
					cache: false,
					success: function(data) {
						$('#myModalWB').modal('hide');
						// alert('Bookmark added to the New Folder successfully');
						// window.location='article-detail.php?artID=<?php echo $_REQUEST['artID']; ?>&magID=<?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
																												else echo 0; ?>';
						$("#dataWordbankfolderexists").html(data);
					}
				});
				event.preventDefault();

			});

			$('#modalPop4').on('click', function() { // onload jQuery Ajax Calls in PHP Script
				var wordBank = '';
				var annoColor = '';
				var word_bank_type = '';
				var art_id = 0;
				var act_id = 0;
				var wbFolder = 1;
				var idColorwordbank = '';
				var magazineID = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
									else echo 0; ?>;
				var definition = '';
				var pageT = '';
				$.ajax({
					type: 'POST',
					url: 'data/addWordbank.php',
					data: {
						word_bank_type: word_bank_type,
						wordBank: wordBank,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						wbFolder: wbFolder,
						idColorwordbank: idColorwordbank,
						magazineID: magazineID,
						selText: selText,
						definition: definition,
						pageT: pageT
					},
					cache: false,
					success: function(data) {
						$("#dataWordbankfolder").html(data);

					}
				});

			});

			$(document).on("click", "#saveTowbfolder", function(e) { // onclic function 

				$('#myModalsaveexistWB').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
				var idColorwordbank11 = $(this).data('id');


				$('#saveexistWBFolder').on('click', function() {

					saveexistingFolder(idColorwordbank11);

				});

			});

			function saveexistingFolder(idColorwordbank11) {
				var wordBank = '';
				var annoColor = '';
				var word_bank_type = '';
				var art_id = <?php echo $article_id; ?>;
				var act_id = 0;
				var wbFolder = '';
				var idColorwordbank = idColorwordbank11;
				var magazineID = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
									else echo 0; ?>;
				var definition = $("#definition2").val();
				var pageT = '';
				$.ajax({
					type: 'POST',
					url: 'data/addWordbank.php',
					data: {
						word_bank_type: word_bank_type,
						wordBank: wordBank,
						annoColor: annoColor,
						art_id: art_id,
						act_id: act_id,
						wbFolder: wbFolder,
						idColorwordbank: idColorwordbank,
						magazineID: magazineID,
						selText: selText,
						definition: definition,
						pageT: pageT
					},
					cache: false,
					success: function(data) {
						$('#successAll').modal({
							backdrop: 'static',
							keyboard: true,
							show: true
						});
						setTimeout(function() {
							$('#successAll').modal('hide');
						}, 2000);
						setTimeout(function() {
							window.location = 'article-detail.php?artID=<?php echo $article_id; ?>&actID=0&magID=<?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
																													else echo 0; ?>';
						}, 2000);


					}
				});
				event.preventDefault();
			}
			//------------------------highlight text ------------------------------------------------------
			function highlightTextviewfunc() {
				var textHighlight = '';
				var art_id = <?php echo $article_id; ?>;
				var act_id = 0;
				// var selText ='';
				var highlightTextview = 1;
				var mag_id = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
								else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/textHighlightannotations.php',
					data: {
						selText: selText,
						textHighlight: textHighlight,
						art_id: art_id,
						act_id: act_id,
						highlightTextview: highlightTextview,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						var valNew = data.split('00000000');

						for (i = 0; i < valNew.length; i++) {
							highlight2(valNew[i].trimStart());
						}


						//highlight2(data.trimStart());

					}
				});
			}
			$(window).on('load', function() { // onclic function

				highlightTextviewfunc();

			});

			$('#hihLighttext').on('click', function() {

				$('#myModaltooltip').modal('hide');
				var textHighlight = 1;
				var art_id = <?php echo $article_id; ?>;
				var act_id = 0;
				var highlightTextview = '';
				var mag_id = <?php if (isset($_REQUEST['magID']) && $_REQUEST['magID'] != '') echo ($_REQUEST['magID']);
								else echo 0; ?>;
				$.ajax({
					type: 'POST',
					url: 'data/textHighlightannotations.php',
					data: {
						selText: selText,
						textHighlight: textHighlight,
						art_id: art_id,
						act_id: act_id,
						highlightTextview: highlightTextview,
						mag_id: mag_id
					},
					cache: false,
					success: function(data) {
						//alert('Bookmark added to the New Folder successfully');
						highlightTextviewfunc();
					}
				})

			});



		});


		/* When the user clicks on the button, 
		toggle between hiding and showing the dropdown content */
		function myFunction() {
			document.getElementById("myDropdown").classList.toggle("show");
		}

		function myFunction2() {
			document.getElementById("myDropdown2").classList.toggle("show");
		}

		function myFunction3() {
			document.getElementById("myDropdown3").classList.toggle("show");
		}

		// Close the dropdown if the user clicks outside of it
		window.onclick = function(event) {
			if (!event.target.matches('.dropbtn')) {
				var dropdowns = document.getElementsByClassName("dropdown-content");
				var i;
				for (i = 0; i < dropdowns.length; i++) {
					var openDropdown = dropdowns[i];
					if (openDropdown.classList.contains('show')) {
						openDropdown.classList.remove('show');
					}
				}
			}
		}

		var selText = "";

		function GetSelectedText() {
			// var selText = "";
			if (window.getSelection) { // all browsers, except IE before version 9
				if (document.activeElement &&
					(document.activeElement.tagName.toLowerCase() == "textarea" ||
						document.activeElement.tagName.toLowerCase() == "input")) {
					var text = document.activeElement.value;
					selText = text.substring(document.activeElement.selectionStart,
						document.activeElement.selectionEnd);
				} else {
					var selRange = window.getSelection();
					selText = selRange.toString();
				}
			} else {
				if (document.selection.createRange) { // Internet Explorer
					var range = document.selection.createRange();
					selText = range.text;
				}
			}
			if (selText !== "") {
				//$("#selectText").hide();
				// $("#modalPop").show();

				$('#myModaltooltip').modal({
					backdrop: 'static',
					keyboard: true,
					show: true
				});
			}

		}

		$(document).ready(function() {
			// $("#modalPop").hide();
			$('#selectText').click(function() {
				if (selText == "") {
					alert('Select Text to add comments');
				} else {
					// $("#selectText").hide();
				}
			});
			/* $(window).on('load', function() { alert('s')
			 $(window).scrollTop($("*:contains('Are you a Lib Dem or Tory'):last").offset().top);
			 });*/
		});

		function highlight(text1) {

			var pageContainer = document.getElementById("test123");
			var innerHTML = pageContainer.innerHTML;
			var index = innerHTML.indexOf(text1);

			if (index >= 0) {
				innerHTML = innerHTML.substring(0, index) + "<span class='highlight' id='spanHigh'>" + innerHTML.substring(index, index + text1.length) + "</span>" + innerHTML.substring(index + text1.length);
				pageContainer.innerHTML = innerHTML;
				document.getElementById('spanHigh').scrollIntoView();
				/*setTimeout(function(){
    $('#spanHigh').removeClass('highlight');
},5000);*/
			}
		}

		function highlight2(text1) {

			var pageContainer = document.getElementById("test123");
			var innerHTML = pageContainer.innerHTML;
			var index = innerHTML.indexOf(text1);

			if (index >= 0) {
				innerHTML = innerHTML.substring(0, index) + "<span class='highlight2' id='spanHigh2'>" + innerHTML.substring(index, index + text1.length) + "</span>" + innerHTML.substring(index + text1.length);
				pageContainer.innerHTML = innerHTML;
				// document.getElementById('spanHigh').scrollIntoView();
				/*setTimeout(function(){
    $('#spanHigh').removeClass('highlight');
},5000);*/
			}
		}

		//------------------------toggle full width-----------------------------
		function myTogglewidthfunction() {
			var x = document.getElementById("mySidebar");;
			if (x.style.display === "none") {
				x.style.display = "block";
				x.style.width = "250px";
				document.getElementById("page-wrapper").style.marginLeft = "250px";
				var element = document.getElementById("test123");
				var elementSide = document.getElementById("rightsidebar");
				element.classList.remove("col-lg-12");
				element.classList.add("col-lg-9");
				elementSide.classList.add("col-lg-3");
				elementSide.style.display = "block";
				document.getElementById("rLoud").style.display = "none";
				document.getElementById("rLoud1").style.display = "block";

			} else {
				x.style.display = "none";
				x.style.width = "0";
				document.getElementById("page-wrapper").style.marginLeft = "0";
				var element = document.getElementById("test123");
				var elementSide = document.getElementById("rightsidebar");
				element.classList.add("col-lg-12");
				element.classList.remove("col-lg-9");
				elementSide.classList.remove("col-lg-3");
				elementSide.style.display = "none";
				document.getElementById("rLoud").style.display = "block";
				document.getElementById("rLoud1").style.display = "none";
			}
		}
	</script>

</body>

</html>