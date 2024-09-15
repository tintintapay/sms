<?php
session_start(); // Start the session to use session variables

// Database connection settings
$host = "localhost"; // Database host
$dbname = "bsu_sms"; // Your database name
$username = "root"; // Your database username
$password = ""; // Your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        header('Location: athletes-login.html'); // Redirect to login if not logged in
        exit();
    }
    
    // Fetch user data from the database
    $user_id = $_SESSION['user_id'];
    $stmt = $pdo->prepare("SELECT first_name, last_name, middle_name, sports FROM athletes WHERE id = :id");
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        echo "User not found.";
        exit();
    }

    // Process user data
    $fullName = $user['first_name'] . ' ' . $user['middle_name'] . ' ' . $user['last_name'];
    $sports = $user['sports'];

    // Include the HTML file and pass user data
    include 'athletes_profile_html.php';
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>
