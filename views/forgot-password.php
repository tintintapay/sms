<?php require_once 'views/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Forgot Password</title>
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
            <h2>Forgot Password</h2>
            <form action="forgot-password" method="post" autocomplete="off">
                <div class="msg" style="display:<?php echo !empty($flash['message']) ? 'block' : 'none' ?>; width:auto">
                    <?php echo $flash['message'] ?? ''; ?>
                </div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter email address" value="<?php echo $email ?? '' ?>" required>
                
                <button type="submit">Next</button>
                <div class="links">
                    <a href="login">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>