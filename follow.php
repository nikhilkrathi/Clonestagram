<?php
require_once('config.php');
session_start();
	$username = $_SESSION['username'];
	$searchUsername = $_SESSION['searchUsername'];
	$userid = $_SESSION['userid'];
	if($username=="") {
       		session_destroy();
      		header("Location: signin.php");
	}
	
function getFollowingData($username, $searchUsername){
	header("Content-Type: application/JSON; charset=UTF-8");
	$connection = connectDatabase();
	$sql = "SELECT COUNT(*) AS followsOrNot FROM follows WHERE follower_id IN (SELECT id FROM users WHERE username='$username') AND followee_id IN (SELECT id FROM users WHERE username='$searchUsername')";
	//$sql = "SELECT * FROM users WHERE username=$username";
	//$sql = "SELECT * FROM users WHERE username='$searchUsername'";
	
	$result = $connection->query($sql);
	if($result){ 
		$followersRecord = array();
		$followersRecord = $result->fetch_all(MYSQLI_ASSOC); 
		$json = json_encode($followersRecord);
		$connection->close();
		echo $json;
	}
	else if(mysqli_num_rows($result) == 0){
		echo "{\"following\": \"Not yet!\",\"userid\": 1,\"searchuserid\": $searchUserid}";
	}
	
    	else {
        echo "{\"Success\": \"False\",\"Error\": \"$connection->error\"}";
    	}
}



$request = getArgument("request");
switch($request) {
	case "following":
		getFollowingData($username, $searchUsername);
		break;
	case "":
		followeUser();
		break;
}

function getArgument($arg) {
    if(isset($_POST[$arg]))
            return $_POST[$arg];
    else if(isset($_GET[$arg]))
            return $_GET[$arg];
    else
        return ""; 
}
?>
