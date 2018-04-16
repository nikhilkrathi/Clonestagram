<?php
    session_start();//session is a way to store information (in variables) to be used across multiple pages.  
    session_destroy();
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
        <a class="btn btn-primary navbar-btn navbar-right" href="signin.php">Sign In</a>
        <p class="navbar-right">Already have an account?<br /></p>
    </div>
</nav>

    
<div id="stage">
    <div id="stage-caption">
        <h1>SHARE YOUR PHOTOS PUBLICLY!</h1>
        <p>Clonestagram is an Internet-based photo-sharing application and service that allows users to share pictures publicly.</p>
        <a class="btn btn-lg btn-success" href="signup.php">Sign Up Now!</a>
    </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
