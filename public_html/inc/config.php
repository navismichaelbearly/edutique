<?php
/* Database credentials. */
define('DB_SERVER', 'mysql');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'root');
define('DB_NAME', 'edusysdb');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
/* Check connection */
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

function fetch_user_last_activity($user_id, $mysqli)
{
	/*$query = "
	SELECT * FROM login_details 
	WHERE user_id = '$user_id' 
	ORDER BY last_activity DESC 
	LIMIT 1
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['last_activity'];
	}
	*/
	$stmt = $mysqli->prepare("SELECT last_activity FROM edu_login_details 
	WHERE user_id = ? 
	ORDER BY last_activity DESC 
	LIMIT 1");
    /* Bind parameters */
    $stmt->bind_param("s", $param_user_id);
    /* Set parameters */
    $param_user_id = $user_id;
    $stmt->execute();
    $result = $stmt->get_result();
    foreach($result as $row)
	{
		return $row['last_activity'];
	}
    //$stmt->close();
}

function fetch_user_chat_history($from_user_id, $to_user_id, $mysqli)
{
	/*$query = "
	SELECT * FROM chat_message 
	WHERE (from_user_id = '".$from_user_id."' 
	AND to_user_id = '".$to_user_id."') 
	OR (from_user_id = '".$to_user_id."' 
	AND to_user_id = '".$from_user_id."') 
	ORDER BY timestamp DESC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<ul class="list-unstyled">';
	foreach($result as $row)
	{
		$user_name = '';
		if($row["from_user_id"] == $from_user_id)
		{
			$user_name = '<b class="text-success">You</b>';
		}
		else
		{
			$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
		}
		$output .= '
		<li style="border-bottom:1px dotted #ccc">
			<p>'.$user_name.' - '.$row["chat_message"].'
				<div align="right">
					- <small><em>'.$row['timestamp'].'</em></small>
				</div>
			</p>
		</li>
		';
	}
	$output .= '</ul>';
	$query = "
	UPDATE chat_message 
	SET status = '0' 
	WHERE from_user_id = '".$to_user_id."' 
	AND to_user_id = '".$from_user_id."' 
	AND status = '1'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $output;*/
	
	$stmt = $mysqli->prepare("SELECT * FROM edu_chat_message 
	WHERE (from_user_id = ? 
	AND to_user_id = ?) 
	OR (from_user_id = ? 
	AND to_user_id = ?) 
	ORDER BY timestamp ASC");
    /* Bind parameters */
    $stmt->bind_param("ssss", $param_from_user_id, $param_to_user_id, $param_from_user_id1, $param_to_user_id1);
    /* Set parameters */
    $param_from_user_id=$from_user_id;
	$param_to_user_id=$to_user_id;
	$param_from_user_id1=$to_user_id;
	$param_to_user_id1=$from_user_id;
    $stmt->execute();
    $result = $stmt->get_result();
	$output = '<ul class="list-unstyled">';
    foreach($result as $row)
	{
		$user_name = '';
		if($row["from_user_id"] == $from_user_id)
		{
			$user_name = '<b class="text-success">You</b>';
			$output .= '
		<li style="border-bottom:1px dotted #ccc; padding:5px 0px">
			<div class="text-success">'.$user_name.' - '.$row["chat_message"].'
				<div align="left" style="color:#767776">
					<small><em>'.$row['timestamp'].'</em></small>
				</div>
			</div>
		</li>
		';
		}
		else
		{
			$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $mysqli).'</b>';
			$output .= '
		<li style="border-bottom:1px dotted #ccc; padding:5px 0px">
			<div class="text-danger" align="right">'.$user_name.' - '.$row["chat_message"].'
				<div align="right" style="color:#767776">
					<small><em>'.$row['timestamp'].'</em></small>
				</div>
			</div>
		</li>
		';
		}
		
	}
	$output .= '</ul>';
	$stmt = $mysqli->prepare("UPDATE edu_chat_message 
	SET status = ? 
	WHERE from_user_id = ? 
	AND to_user_id = ? 
	AND status = ?");	
	  $stmt->bind_param("ssss", $param_status,$param_from_user_id,$param_to_user_id,$param_status1);    
	  $param_status = '0';
	  $param_from_user_id = $to_user_id;
	  $param_to_user_id = $from_user_id;
	  $param_status1 = '1';
	  $stmt->execute();
	  return $output;
}

function get_user_name($user_id, $mysqli)
{
	/*$query = "SELECT username FROM login WHERE user_id = '$user_id'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['username'];
	}*/
	
	$stmt = $mysqli->prepare("SELECT username FROM edu_users WHERE user_id = ?");
    /* Bind parameters */
    $stmt->bind_param("s", $param_user_id);
    /* Set parameters */
    $param_user_id = $user_id;
    $stmt->execute();
    $result = $stmt->get_result();
    foreach($result as $row)
	{
		return $row['username'];
	}
}

function count_unseen_message($from_user_id, $to_user_id, $mysqli)
{
	/*$query = "
	SELECT * FROM chat_message 
	WHERE from_user_id = '$from_user_id' 
	AND to_user_id = '$to_user_id' 
	AND status = '1'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$count = $statement->rowCount();
	$output = '';
	if($count > 0)
	{
		$output = '<span class="label label-success">'.$count.'</span>';
	}
	return $output;*/
	
	$stmt = $mysqli->prepare("SELECT * FROM edu_chat_message 
	WHERE from_user_id = ? 
	AND to_user_id = ? 
	AND status = ?");
    $stmt->bind_param("sss", $param_from_user_id, $param_to_user_id, $param_status);
    // Set parameters 
    $param_from_user_id = $from_user_id;
    $param_to_user_id = $to_user_id;
    $param_status = '1';
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;
    $stmt->fetch();
	$output = '';
	if($count > 0)
	{
		$output = '<span class="label label-success">'.$count.'</span>';
	}
	return $output;
	
}

function fetch_is_type_status($user_id, $mysqli)
{
	/*$query = "
	SELECT is_type FROM login_details 
	WHERE user_id = '".$user_id."' 
	ORDER BY last_activity DESC 
	LIMIT 1
	";	
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		if($row["is_type"] == 'yes')
		{
			$output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
		}
	}
	return $output;*/
	
	$stmt = $mysqli->prepare("SELECT is_type FROM edu_login_details 
	WHERE user_id = ? 
	ORDER BY last_activity DESC 
	LIMIT 1");
    /* Bind parameters */
    $stmt->bind_param("s", $param_user_id);
    /* Set parameters */
    $param_user_id = $user_id;
    $stmt->execute();
    $result = $stmt->get_result();
	$output = '';
    foreach($result as $row)
	{
		if($row["is_type"] == 'yes')
		{
			$output = ' - <small><em><span class="text-muted">Typing...</span></em></small>';
		}
	}
	return $output;
}

function fetch_group_chat_history($mysqli)
{
	/*$query = "
	SELECT * FROM chat_message 
	WHERE to_user_id = '0'  
	ORDER BY timestamp DESC
	";

	$statement = $connect->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();

	$output = '<ul class="list-unstyled">';
	foreach($result as $row)
	{
		$user_name = '';
		if($row["from_user_id"] == $_SESSION["user_id"])
		{
			$user_name = '<b class="text-success">You</b>';
		}
		else
		{
			$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $connect).'</b>';
		}

		$output .= '

		<li style="border-bottom:1px dotted #ccc">
			<p>'.$user_name.' - '.$row['chat_message'].' 
				<div align="right">
					- <small><em>'.$row['timestamp'].'</em></small>
				</div>
			</p>
		</li>
		';
	}
	$output .= '</ul>';
	return $output;*/
	
	
	$stmt = $mysqli->prepare("SELECT * FROM edu_chat_message 
	WHERE to_user_id = ?  
	ORDER BY timestamp DESC");
    /* Bind parameters */
    $stmt->bind_param("s", $param_user_id);
    /* Set parameters */
    $param_user_id = '0';
    $stmt->execute();
    $result = $stmt->get_result();
    foreach($result as $row)
	{
		$user_name = '';
		if($row["from_user_id"] == $_SESSION["id"])
		{
			$user_name = '<b class="text-success">You</b>';
		}
		else
		{
			$user_name = '<b class="text-danger">'.get_user_name($row['from_user_id'], $mysqli).'</b>';
		}

		$output .= '

		<li style="border-bottom:1px dotted #ccc">
			<p>'.$user_name.' - '.$row['chat_message'].' 
				<div align="right">
					- <small><em>'.$row['timestamp'].'</em></small>
				</div>
			</p>
		</li>
		';
	}
	$output .= '</ul>';
	return $output;
}



?>