<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
    <script>
        // Function to show a confirmation message and redirect after a delay
        function showConfirmationAndRedirect() {
            // Show an alert message
            alert('Your registration has been submitted successfully. Please wait 24 hours for approval.');

            // Redirect to the login page after 5 seconds (5000 milliseconds)
            setTimeout(function() {
                window.location.href = 'athletes-login.html';
            }, 5000); // 5000 milliseconds = 5 seconds
        }

        // Execute the function when the page loads
        window.onload = showConfirmationAndRedirect;
    </script>
</head>
<body>
    <p>If you are not redirected automatically, <a href="athletes-login.html">click here</a>.</p>
</body>
</html>
