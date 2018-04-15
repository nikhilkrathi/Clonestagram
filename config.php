<?php
function connectDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "rohith=123";
    $dbname = "clonestagram";
    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    return $connection;
}	

?>
