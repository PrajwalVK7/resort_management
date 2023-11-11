<?php
// Database configuration
$servername = "localhost"; 
$username = "root"; //username
$password = ""; //password
$database = "resort"; //database name
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
