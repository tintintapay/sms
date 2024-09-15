<?php
// Database connection settings
$servername = "localhost";  // Most likely, this will be "localhost"
$username = "root";         // Default XAMPP username is "root"
$password = "";             // Default XAMPP password is an empty string
$dbname = "bsu_sms";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
