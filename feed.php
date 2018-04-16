<?php
require_once('config.php');
session_start();
$username = $_SESSION['username'];
$userid = $_SESSION['userid'];
if($username=="") {
    session_destroy();
    header("Location: signin.php");
}

function getFeedData($username){
	$db = connectDatabase();
	
	$url = array();
	$photoid = array();
	//Posts of followers
	$sql_f = "SELECT id, image_url FROM photos WHERE user_id IN (SELECT followee_id FROM follows WHERE follower_id IN (SELECT id FROM users WHERE username='$username')) ORDER BY created_at DESC;
";
	$result_f = $db->query($sql_f);
	while ($row = mysqli_fetch_assoc($result_f)){
		$url[] = $row['image_url'];
		$photoid[] = $row['id'];
	}
	
	//Self Posts
	$sql = "SELECT id, image_url FROM photos WHERE user_id IN (SELECT id FROM users WHERE username='$username') ORDER BY created_at DESC";
	$result = $db->query($sql);
	while ($row = mysqli_fetch_assoc($result)){
		$url[] = $row['image_url'];
		$photoid[] = $row['id'];
	}	
	
	//Likes
	$count = array();
	foreach($photoid as $item){
		$sql2 = "SELECT count(*) AS total_likes FROM likes WHERE photo_id='$item'";
		$result2 = $db->query($sql2);
	    $row2 = mysqli_fetch_assoc($result2);
		$count[] = $row2['total_likes'];
	}
	
	//Uploader
	$uid = array();
	foreach($photoid as $item2){
		$sql3 = "SELECT username FROM users WHERE id IN (SELECT user_id FROM photos WHERE id='$item2')";
		$result3 = $db->query($sql3);
		$row3 = mysqli_fetch_assoc($result3);
		$uid[] = $row3['username'];
	}
	
	$output = array('photoid'=>$photoid, 'username'=>$uid, 'photo_url'=>$url, 'likes'=>$count); 
	echo json_encode($output);
}

function getCurrentUserId($username){
	$db = connectDatabase();
	$sql4 = "SELECT id FROM users WHERE username='$username'";
	$result4 = $db->query($sql4);
	$row4 = mysqli_fetch_assoc($result4);
	$uid = $row4['id'];
	echo "{\"CurrentUserId\": \"$uid\"}";
}

function addLikes(){
	$connection = connectDatabase();
	$uname = getArgument("userId");
	$pid = getArgument("photoid");
	
	$sql = "INSERT INTO likes(user_id, photo_id) VALUES ('$uname','$pid')"; 
	if ($connection->query($sql) === TRUE) {
            echo "{\"Success\": \"True\"}";
        } 
    else {
        echo "{\"Success\": \"False\",\"Error\": \"$connection->error\"}";
    }
    $connection->close();
} 

function likedOrNot(){
	$db = connectDatabase();
	$uname = getArgument("userId");
	$pid = getArgument("photoid");
	$sql5 = "SELECT COUNT(*) AS likedOrNot FROM likes WHERE user_id='$uname' AND photo_id='$pid'"; 
	$result5 = $db->query($sql5);
	$row5 = mysqli_fetch_assoc($result5);
	$lon = $row5['likedOrNot'];
	echo "{\"likedOrNot\": \"$lon\"}";
    $db->close();

}

$request = getArgument("request");
switch($request) {
	case "feedData":
		getFeedData($username);
		break;
	case "CurrentUserId":
		getCurrentUserId($username);
		break;
	case "addlike":
		addLikes();
		break;
	case "likedOrNot":
		likedOrNot();
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
