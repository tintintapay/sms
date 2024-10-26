<?php require_once 'views/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Password Reset</title>
</head>

<body>
    <?php include_once 'common/nav.php'; ?>
    <div class="background-image"></div>
    <div class="dark-overlay"></div>
    <div class="container">
        <div class="welcome-msg">
            <img src="assets/images/sportan-logo.png" style="width:250px" alt="">
        </div>
        <div class="login-container">
            <h2>Password Changed!</h2>
            <p>Your password has been successfully changed. Welcome back to a more secure experience!</p>
            <p>Go back to <a href="login">login</a> page</p>
        </div>
    </div>
    <script>const startDate = '<?= $startDate; ?>';</script>
</body>

</html>