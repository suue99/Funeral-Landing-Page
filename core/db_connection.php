<?php
// $servername = "localhost";
// $username = "revelukf_admin";
// $password = "7Thunder$!56";
// $dbname = "revelukf_tributes";


// local server
$servername = "localhost";
$username = "eoa_admin";
$password = "7Thunder$";
$dbname = "tributes_db";

// Create and check database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

