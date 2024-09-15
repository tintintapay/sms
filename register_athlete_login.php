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

// Retrieve form data
$firstName = $conn->real_escape_string($_POST['first-name']);
$lastName = $conn->real_escape_string($_POST['last-name']);
$middleName = isset($_POST['middle-name']) ? $conn->real_escape_string($_POST['middle-name']) : null;
$sex = $conn->real_escape_string($_POST['sex']);
$yearCourse = $conn->real_escape_string($_POST['year-course']);
$address = $conn->real_escape_string($_POST['address']);
$email = $conn->real_escape_string($_POST['email']);
$school = $conn->real_escape_string($_POST['school']);
$guardian = $conn->real_escape_string($_POST['guardian']);
$password = $conn->real_escape_string($_POST['password']); // Consider hashing the password
$age = (int)$_POST['age'];
$sports = isset($_POST['sports']) ? $conn->real_escape_string($_POST['sports']) : null;
$phone = $conn->real_escape_string($_POST['phone']);

// Handle file uploads
$uploadDir = 'uploads/'; // Directory to save uploaded files
$cor = isset($_FILES['cor']['name']) ? $uploadDir . basename($_FILES['cor']['name']) : null;
$psa = isset($_FILES['psa']['name']) ? $uploadDir . basename($_FILES['psa']['name']) : null;
$medical = isset($_FILES['medical']['name']) ? $uploadDir . basename($_FILES['medical']['name']) : null;
$photo = isset($_FILES['photo']['name']) ? $uploadDir . basename($_FILES['photo']['name']) : null;

// Move uploaded files to the desired directory
foreach (['cor', 'psa', 'medical', 'photo'] as $file) {
    if (isset($_FILES[$file]) && $_FILES[$file]['error'] == UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES[$file]['tmp_name'], $$file);
    }
}

// Prepare the SQL statement
$sql = "INSERT INTO athletes (first_name, last_name, middle_name, sex, year_course, address, email, school, guardian, password, age, sports, phone, cor, psa, medical, photo, status)
VALUES ('$firstName', '$lastName', '$middleName', '$sex', '$yearCourse', '$address', '$email', '$school', '$guardian', '$password', $age, '$sports', '$phone', '$cor', '$psa', '$medical', '$photo', 'pending')";

// Check if the query was successful
if ($conn->query($sql) === TRUE) {
    // Output JavaScript to show alert and then redirect
    echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Registration Confirmation</title>
    <script>
        // Function to show an alert message and redirect
        function showAlertAndRedirect() {
            // Show an alert message
            alert('Your registration has been submitted successfully. Please wait 24 hours for approval.');

            // Redirect to the login page after 2 seconds (2000 milliseconds)
            setTimeout(function() {
                window.location.href = 'athletes-login.html';
            }, 2000); // 2000 milliseconds = 2 seconds
        }

        // Execute the function when the page loads
        window.onload = showAlertAndRedirect;
    </script>
</head>
<body>
    <!-- No additional content needed here -->
</body>
</html>";
} else {
    // Error handling
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
