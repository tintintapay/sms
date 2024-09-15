<?php
session_start();
include 'db_connection.php'; // Ensure this contains your DB connection details

// Assuming user ID is stored in the session
$user_id = $_SESSION['user_id'];

// Fetch user information
$query = "SELECT name, role FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Return user info as JSON
echo json_encode($user);

$stmt->close();
$conn->close();
?>
