<?php
// fetch_athletes.php

// Database connection details (modify to match your setup)
$host = 'localhost'; // Adjust if not localhost
$dbname = 'bsu_sms';
$username = ''; // Leave blank if no username
$password = ''; // Leave blank if no password

try {
    // Create a PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get the filters sent via GET method (from JavaScript)
    $school = $_GET['school'];
    $sport = $_GET['sport'];

    // Prepare the SQL query to fetch athletes based on the selected school and sport
    // Concatenate first_name, middle_name, and last_name into a full name
    $stmt = $pdo->prepare("SELECT CONCAT(first_name, ' ', middle_name, ' ', last_name) AS full_name FROM athletes WHERE school = :school AND sport = :sport");
    $stmt->execute(['school' => $school, 'sport' => $sport]);

    // Fetch the results
    $athletes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the results as JSON
    echo json_encode($athletes);
} catch (PDOException $e) {
    // Handle any errors
    echo 'Database connection failed: ' . $e->getMessage();
}
?>
