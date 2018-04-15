<?php
    session_start();
   	$username = $_SESSION['username'];
    $userid = $_SESSION['userid'];
    if($username=="") {
        session_destroy();
        header("Location: signin.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Clonestagram Photos</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel=stylesheet href="style.css" type="text/css">
    
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    
      <a class="navbar-left" href="home.php"><img src="cg-logo.png" alt="cg.logo" height="100"></a>
   
    <ul class="nav navbar-nav">
      <li class="active"><a href="home.php">Home</a></li>
      <li><a href="#">Search by Hashtag</a></li>
    </ul>
    <form class="navbar-form navbar-left" method="post" action="">
      <div class="form-group">
        <input type="text" name="usearch" id="inputName" class="form-control" placeholder="Enter Username">
      </div>
      <button type="submit" class="btn btn-default" name="search">Search</button>
    </form>
    <a class="btn btn-primary navbar-btn navbar-right" href="logout.php">Log Out</a>
    <?php 
        $username = $_SESSION['username'];
        echo "<p class='navbar-text navbar-right''>Signed in as " . $username . "<br></p>";
    ?>
  </div>
</nav> 
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Feed</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Profile</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
  	<?php
  		require_once('config.php');
  	
  		$fullname = $_SESSION['fullname'];
        echo "<h2 class='card-title'>" . $fullname . "</h2>";
		      	
      	$username = $_SESSION['username'];
        echo "<h4 class='card-title'>" . $username . "</h4>";
        
        $db = connectDatabase();
        
        //Followee
        $sql = "SELECT COUNT(*) AS follower_count FROM follows WHERE followee_id=(SELECT id FROM users WHERE username='$username')";
        $result = mysqli_query($db, $sql);
		
        if($result){
			if(mysqli_num_rows($result) == 1){
				$row = mysqli_fetch_array($result);
                $follower_count = $row['follower_count'];
                $followersModal = "followersModal";
                $followers = "followers";
                echo "<h4 id=\"followers\" onclick='displayModal(\"$followersModal\", \"$followers\")'>Followers: " .$follower_count . "</h4>
                <div id=\"followersModal\" class=\"modal\">
  					<div class=\"modal-content\">
    					<span id=\"close1\" class=\"close\">&times;</span>
    					<table id=\"followersTable\"></table>
 		 			</div>
				</div>";
            }
		}				
		 else {
		    	echo "ERROR: Not able to execute $sql. " . mysqli_error($db). '<br />'. '<br />';
		}
		
		//Follows
		$sql = "SELECT COUNT(*) AS following_count FROM follows WHERE follower_id=(SELECT id FROM users WHERE username='$username')";
        $result = mysqli_query($db, $sql);
		
        if($result){
			if(mysqli_num_rows($result) == 1){
				$row = mysqli_fetch_array($result);
                $following_count = $row['following_count'];
                $followingModal = "followingModal";
                $following = "following";
                
                echo "<h4 id=\"following\" onclick='displayModal(\"$followingModal\", \"$following\")'>Following: " .$following_count . "</h4>
                <div id=\"followingModal\" class=\"modal\">
  					<div class=\"modal-content\">
    					<span id=\"close2\" class=\"close\">&times;</span>
    					<table id=\"followingTable\"></table>
 		 			</div>	
				</div>";
            }
		}				
		 else {
		    	echo "ERROR: Not able to execute $sql. " . mysqli_error($db). '<br />'. '<br />';
		}
		
		mysqli_close($db);
 
  	?>
  	<a href="" class="btn btn-primary" id="editProfileBtn">Edit Profile</a>
    <form class="addimage" action="" method="post">
        <input type="text" class="form-control enterurl" placeholder="Enter Image URL" name="url" autofocus required>
      <br />
      <button type="submit" class="btn btn-default addbtn" name="add">Add Photo</button>
  </form>

	<div class="container-fluid">
		<div class="row text-center">
		    <h3 class="headermessage">Posts</h3>
		</div>
    <div class="row">
        <?php
        require_once('config.php');
		$db = connectDatabase();
		
		//Show photos
		$sql = "SELECT * FROM photos WHERE user_id = $userid" ;
		$result = mysqli_query($db, $sql);
        if($result) {
            $num_rows = mysqli_num_rows($result);
            for($i=0;$i<$num_rows;$i++) {
                $row = mysqli_fetch_array($result);
                $url = $row['image_url'];
                $photoid = $row['id'];
                echo "<a href='viewphoto.php?id=".$photoid."' title=''>
                <div class='image-block col-sm-4' style='background: url(".$url.") no-repeat center top;background-size:cover;'>
                <p>Click To View</p>
                </div>
                </a>";
            }
        }
        
        //Add new photos to db
        if(isset($_POST['add'])){
        	$url = mysqli_real_escape_string($db, $_REQUEST['url']);
			$sql = "INSERT INTO photos(user_id, image_url) VALUES($userid,'$url')" ;
			$result = mysqli_query($db, $sql);
		    if(mysqli_affected_rows($db) > 0) {
		        header("Location: profile.php");
			}
			 else {
					echo "ERROR: Not able to execute $sql. " . mysqli_error($db). '<br />'. '<br />';
			}
        }
        
	if(isset($_POST['search'])){
		//$db = mysqli_connect('localhost','root','KISHOR@cp0220','clonestagram')
			//or die('Error connecting to MYSQL server.');
		
		$usearch = mysqli_real_escape_string($db, $_REQUEST['usearch']);
		$sql = "SELECT * FROM users WHERE username = '$usearch'" ;
		$result = mysqli_query($db, $sql);
        if($result){
			if(mysqli_num_rows($result) == 1){
				$row = mysqli_fetch_array($result);
			$searchUserid = $row['id'];
                 $_SESSION[searchUserid] = $searchUserid;
                 $_SESSION['searchUsername'] = $usearch;
                 $_SESSION['searchFullname'] = $row['fullname'];
                header("Location: userprofile.php");
                }
		else 
   			echo "ERROR: Unable to execute $sql. " . mysqli_error($db). '<br />'. '<br />';
   	
   	}
   }
	
		mysqli_close($db);
	
?>

        
    </div>
  </div>
  </div>
</div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
     <script src="js/modal.js"></script>
     <script src="js/search.js"></script>
</body>
</html>
