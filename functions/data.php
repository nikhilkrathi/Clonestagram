<?php
function connectDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "KISHOR@cp0220";
    $dbname = "clonestagram";
    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    return $connection;
}
        
function checkSession () {
	session_start();
	if (isset($_SESSION["login"])) {
		if ($_SESSION["login"] == "yes") {
			return true;
		}
	}
	return false;
}

function createSession ($user) {
	$_SESSION = $user;
	$_SESSION["login"] = "yes";
}

function generateSessionID () {
	$sessionID = "";
	$IDChars = array_merge(range('A','Z'), range('a', 'z'), range(0, 9));
	for ($i = 0; $i <= 22; $i++) {
		$sessionID .= $IDChars[array_rand($IDChars)];
	}
	return $sessionID;
}

?>
