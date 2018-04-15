<?php
    session_start();
   	$username = $_SESSION['username'];
    $photoid = $_GET['id'];
    $userid = $_SESSION[userid];
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
    <form class="navbar-form navbar-left">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Enter Username">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <a class="btn btn-primary navbar-btn navbar-right" href="logout.php">Log Out</a>
    <?php 
        $username = $_SESSION['username'];
        echo "<p class='navbar-text navbar-right''>Signed in as " . $username . "<br></p>";
    ?>
  </div>
</nav>
<div class="container-full">
 <?php
 		require_once('config.php');
		$db = connectDatabase();
		
		//Display Image
		$sql = "SELECT image_url FROM photos WHERE id = $photoid";
		$result = mysqli_query($db, $sql);
        if($result) {
            $row = mysqli_fetch_array($result);
                $url = $row['image_url'];
        }
        
        //Show number of likes
        $sql2 = "SELECT count(*) AS total_likes FROM likes WHERE photo_id=$photoid";
		$result2 = mysqli_query($db, $sql2);
        if($result2) {
            $row2 = mysqli_fetch_array($result2);
                $count = $row2['total_likes'];
        }
        
        
        echo "<table class=\"imgTable\">
			<tr>
				<td>" . $username . "</td>
			</tr>
			<tr>
				<td><img src='".$url."' class=\"tableImg\"></td>
			</tr>
			<tr>
				<td>".$count." likes</td>
			</tr> 
			<tr>
				<td><button>Like</button></td>
			</tr>  
        
        </table>";
        
        
        
        mysqli_close($db);
        ?>
    </div>
    
<footer class="footer">
    <span class="text-muted">Made by Rishabh Chitlangia and Rohith Srivathsav</span>
</footer>

    
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
