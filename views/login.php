<?php require_once 'views/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendor/fontawesome-6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/athletes-login.css"> <!-- Link to the external CSS file -->
    <!-- Link to the external JavaScript files in the 'js' folder -->
    <script src="assets/js/hideandshow.js" defer></script> <!-- Password visibility functionality -->
    <script src="assets/js/contactUs.js" defer></script> <!-- Contact Us functionality -->
    <title>Athletes Login</title>
</head>

<body>

    <div class="background-image"></div>

    <header class="header">
        <div class="title">Login</div>
        <div class="logo"><img src="logo.png" alt="Logo"></div>
        <div class="back">
            <button onclick="location.href='index'">Back</button>
        </div>
    </header>

    <div class="container">
        <div class="content">
            <img src="assets/images/p.jpg" alt="Your Image">
        </div>

        <div class="error-message">

        </div>


        <div class="form-container">
            <div class="msg" style="display:<?php echo !empty($flash['message']) ? 'block' : 'none'?>">
                <?php echo $flash['message'] ?? ''; ?>
            </div>
            
            <form method="post" action="login" id="login-form">
                <div class="form-field">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" value="<?php echo $email ?? ''?>">
                </div>
                <div class="form-field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password">
                    <i class="fas fa-eye" id="togglePassword"></i>
                </div>
                <div class="form-actions">
                    <div class="forgot-password">
                        <a href="forgot_password_athlete.html">Forgot Password?</a>
                    </div>
                    <button type="submit">Login</button>
                </div>
            </form>
            <div class="register">
                <p>Don't have an account? <a href="register">Register</a></p>
                <button class="contact-button" id="contactButton"><i class="fas fa-phone"></i></button>
            </div>
        </div>
        
        <!-- Chatbot Components -->
        <?php include_once 'common/chatbot.php'?>
    </div>

</body>

</html>