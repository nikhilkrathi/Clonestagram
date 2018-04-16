<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sign Up</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel=stylesheet href="style.css" type="text/css">
    
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-left" href="index.php"><img src="cg-logo.png" alt="cg.logo" height="100"></a>
        <a class="btn btn-primary navbar-btn navbar-right" href="signin.php">Sign In</a><p class="navbar-right">Already have an account?<br></p>
    </div>
</nav>
<div class="signup">

    <form class="form-signup" action="" method="post">
        <h2 class="form-signup-heading">Sign Up to Get Started!</h2>
        <input type="text" name="fullname" class="form-control" placeholder="Full Name" required autofocus>
        <input type="text" name="username" class="form-control" placeholder="Username" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="proceed">Sign Up</button>
        
    </form>
</div> <!-- /container -->

<?php
	require_once('config.php');
	if(isset($_POST['proceed'])){
		//$db = mysqli_connect('localhost','root','KISHOR@cp0220','clonestagram')
		 //or die('Error connecting to MySQL server.');
		
		$db = connectDatabase();		
        $fullname = mysqli_real_escape_string($db, $_REQUEST['fullname']);
		$username = mysqli_real_escape_string($db, $_REQUEST['username']);
        $password = mysqli_real_escape_string($db, $_REQUEST['password']);
        $hash = md5($password);
        $sql = "INSERT INTO users(fullname, username, pwd) VALUES ('$fullname', '$username', '$hash')";

		$result = mysqli_query($db, $sql);
		
		if(mysqli_affected_rows($db) > 0) {
			header("Location: signin.php");
		}
		 else {
		    	echo "ERROR: Not able to execute $sql. " . mysqli_error($db). '<br />'. '<br />';
		}
		
		mysqli_close($db);
	}
	
?>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>


