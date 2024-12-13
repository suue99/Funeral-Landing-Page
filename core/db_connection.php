<?php
$servername = "localhost";
$username = "revelukf_admin";
$password = "7Thunder$!56";
$dbname = "revelukf_tributes";

// Create and check database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
