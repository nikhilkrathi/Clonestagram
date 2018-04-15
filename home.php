<?php 
    session_start();
    $username = $_SESSION['username'];
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
    <title>Clonestagram Home</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel=stylesheet href="style.css" type="text/css">

</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    
      <a class="navbar-left" href="#"><img src="cg-logo.png" alt="cg.logo" height="100"></a>
   
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
      <li><a href="#">Search by Hashtag</a></li>
    </ul>
    <form class="navbar-form navbar-left">
      <div class="form-group">
        <input type="text" id="inputName" class="form-control" name ="finduser" placeholder="Enter Username">
      </div>
      <button type="submit" onclick="searchUser(document.getElementById('inputName').value)" class="btn btn-default">Submit</button>
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
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Feed</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
    </ul>
  </div>
  <div class="card-body" id="feedDiv">
  </div>
</div> 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/search.js"></script>
    <script src="js/feed.js"></script>
</body>
</html>
