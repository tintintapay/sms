<?php
// Database connection parameters
$host = 'localhost';       // Update with your MySQL host
$user = 'root';            // Update with your MySQL username
$password = '';            // Update with your MySQL password
$database = 'bsu_sms';     // Update with your database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve login data
$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']); // Consider hashing and verifying password securely

// Query to check the user credentials and status
$sql = "SELECT id, first_name, last_name, status FROM athletes WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found
    $row = $result->fetch_assoc();
    $status = $row['status'];
    
    if ($status === 'pending') {
        // Notify the user that their registration is pending
        echo "<script>alert('Your registration is still pending. Please wait for approval.'); window.location.href = 'athletes-login.html';</script>";
    } else {
        // Successful login
        echo "<script>alert('Login successful. Welcome, " . $row['first_name'] . " " . $row['last_name'] . "!');
        window.location.href = 'athletes_profile_html.php';</script>";
    }
} else {
    // Incorrect email or password
    echo "<script>alert('Invalid email or password. Please register or try again.'); window.location.href = 'register.html';</script>";
}

$conn->close();
?>
