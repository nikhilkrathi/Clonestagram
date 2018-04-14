<?php
require_once('config.php');
session_start();
   	$username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
    if($username=="") {
        session_destroy();
        header("Location: signin.php");
    }
    
function getFollowersData($username){
	header("Content-Type: application/JSON; charset=UTF-8");
	$connection = connectDatabase();
	$sql = "SELECT * FROM users WHERE id IN(SELECT follower_id FROM follows WHERE followee_id IN(SELECT id FROM users WHERE username='$username'))";
	$result = $connection->query($sql);
	if($result){
		$followersRecord = array();
		$followersRecord = $result->fetch_all(MYSQLI_ASSOC); 
		$json = json_encode($followersRecord);
		$connection->close();
		echo $json;
	}
	else if(mysqli_num_rows($result) == 0){
		echo "{\"fullname\": \"No one yet!\"}";
	}
    else {
        echo "{\"Success\": \"False\",\"Error\": \"$connection->error\"}";
    }
}	

function getFollowingData($username){
	header("Content-Type: application/JSON; charset=UTF-8");
	$connection = connectDatabase();
	$sql = "SELECT * FROM users WHERE id IN(SELECT followee_id FROM follows WHERE follower_id IN(SELECT id FROM users WHERE username='$username'))";
	$result = $connection->query($sql);
	if($result){
		$followersRecord = array();
		$followersRecord = $result->fetch_all(MYSQLI_ASSOC); 
		$json = json_encode($followersRecord);
		$connection->close();
		echo $json;
	}
	else if(mysqli_num_rows($result) == 0){
		echo "{\"fullname\": \"No one yet!\"}";
	}
    else {
        echo "{\"Success\": \"False\",\"Error\": \"$connection->error\"}";
    }
}
		
$request = getArgument("request");
switch($request) {
	case "followers":
		getFollowersData($username);
		break;
	case "following":
		getFollowingData($username);
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
