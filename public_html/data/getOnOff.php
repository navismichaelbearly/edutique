<?php
require_once "../inc/config.php";
include "../inc/constants.php";

session_start();


//print_r post data
// print_r($_POST);
// exit()


// check if post contains school_id
if (isset($_POST['school_id'])) {
    // select * from edu_onoff where school_id = $_POST['school_id']
    $sql = "SELECT * FROM edu_onoff WHERE school_id = " . $_POST['school_id'];
    $result = $mysqli->query($sql);
    // if exists then return the data in JSON else return empty
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo ("{'data':'0'}");
    }
} else {
    echo ("{'data':'0'}");
}
