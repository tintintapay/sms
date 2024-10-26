<?php require_once 'views/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="vendor/jquery/jquery-3.7.1.js"></script>
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
            <h2>Password Reset Code</h2>
            <form action="password-reset-validate" method="post" autocomplete="off">
                <input type="hidden" name="token" id="token" value="<?= $token ?>">
                <div class="msg" style="display:<?php echo !empty($flash['message']) ? 'block' : 'none' ?>; width:auto">
                    <?php echo $flash['message'] ?? ''; ?>
                </div>
                <!-- Code -->
                <label for="code">Code <span style="float:right; color:#a10101; font-size:.8rem;" id="timer"></span></label>
                <input type="text" id="code" name="code" placeholder="Enter 6 digit code" required>

                <small style="color: #6c757d; font-size: .875em;">Your reset password code has been sent to your email. Please check your inbox to proceed.</small>
                <hr>
                <!-- New Password -->
                <label for="password">New Password </label>
                <input type="password" id="password" name="password" placeholder="New Password" required>
                <!-- Confirm Password -->
                <label for="confirm_password">Confirm Password </label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="submit" style="margin-top: 15px;">Validate</button>
                <div class="links">
                    <a href="login">Login</a>
                </div>
            </form>
        </div>
    </div>
    <script>const startDate = '<?= $startDate; ?>';</script>
    <script src="assets/js/password-reset-validate.js"></script>
</body>

</html>