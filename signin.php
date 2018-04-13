<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sign In</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel=stylesheet href="style.css" type="text/css">
    
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-left" href="index.php"><img src="cg-logo.png" alt="cg.logo" height="100"></a>
    </div>
</nav>
<div class="signup">

    <form class="form-signup" action="" method="post">
        <h2 class="form-signup-heading">Sign In Now!</h2>
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="proceed">Sign In</button>
        
    </form>
</div> <!-- /container -->
<footer class="footer">
    <span class="text-muted">Made by Rishabh Chitlangia and Rohith Srivathsav</span>
</footer>
    
<?php
	require_once('config.php');
	if(isset($_POST['proceed'])){
		//$db = mysqli_connect('localhost','root','KISHOR@cp0220','clonestagram')
			//or die('Error connecting to MYSQL server.');
		
		$db = connectDatabase();
		$username = mysqli_real_escape_string($db, $_REQUEST['username']);
		$sql = "SELECT * FROM users WHERE username = '$username'" ;
		$result = mysqli_query($db, $sql);
        if($result){
			if(mysqli_num_rows($result) == 1){
				$row = mysqli_fetch_array($result);
                $fullname = $row['fullname'];
                $userid = $row['id'];
				$password = mysqli_real_escape_string($db, $_REQUEST['password']);
                $hash = md5($password);
                if($row['pwd']== $hash) {
					$_SESSION['username'] = $username;
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION[userid] = $userid;
					header("Location: home.php");
				}
				else
					echo "Wrong Password!". '<br />';
			}
			else
				echo "Wrong username!".'<br  />';
		}				
		else 
   			echo "ERROR: Unable to execute $sql. " . mysqli_error($db). '<br />'. '<br />';

		mysqli_close($db);
			
	}
?>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
