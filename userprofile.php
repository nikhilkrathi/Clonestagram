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
    <title>Clonestagram</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel=stylesheet href="style.css" type="text/css">

</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-left" href="#"><img src="cg-logo.png" alt="cg.logo" height="100"></a>
    </div>
</nav>
<div class="profile">
    <div class="row vertical-center-row">
		<div class="text-center col-md-3 col-md-offset-4">
			<div class="profile-sidebar">
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
                    <?php 
                        $username = $_SESSION['fullname'];
                        echo "<div class='profile-usertitle-name'>" . $username . "</div>";
                    ?>
                    <?php 
                        $username = $_SESSION['username'];
                        echo "<div class='profile-usertitle-username'>" . $username . "</div>";
                    ?>
				</div>
				<div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
				</div>

			</div>
		</div>
    </div>
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
