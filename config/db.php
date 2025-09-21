<?php
$host = "localhost";
$user = "root";
$password = "AsusZenfone5";
$dbname = "perkuliahan";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>
