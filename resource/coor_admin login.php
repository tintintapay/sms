<?php
// login.php

// Database connection (adjust these settings according to your database configuration)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bsu_sms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$username = isset($_POST['email']) ? $_POST['email'] : ''; // 'email' from form data
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Prepare and execute query
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

print_r($result);
die();
// Check if user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Verify password
    if (password_verify($password, $user['password'])) {
        // Check user role
        if ($user['role'] === 'admin' || $user['role'] === 'coordinator') {
            // Successful login
            echo json_encode([
                "status" => "success",
                "role" => $user['role'] // Include user role in response
            ]);
        } else {
            // Not an admin or coordinator
            echo "<script>alert('Unauthorized Access.'); window.location.href = 'login.html';</script>";
        }
        } else {
        // Incorrect password
        echo "<script>alert('Your Email Or Password is incorrect. Please Check!.'); window.location.href = 'coor_admin login.html';</script>";
        }
        } else {
    // Username does not exist
        echo "<script>alert('Your Account was not found.'); window.location.href = 'coor_admin login.html';</script>";
        }

// Close connection
$stmt->close();
$conn->close();
?>
