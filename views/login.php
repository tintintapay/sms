<?php require_once 'views/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f4f4f9;
        }

        .background-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-image: url('assets/images/p.jpg');
            /* Add your background image URL */
            background-size: cover;
            background-position: center;
            filter: blur(4px);
            z-index: -1;
        }

        .dark-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            /* Adjust the opacity as needed */
            z-index: -1;
        }

        .container {
            display: flex;
            flex-direction: row;
            align-items: center;
            width: 80%;
            max-width: 1200px;
        }

        .sample-text {
            color: white;
            font-size: 24px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            flex: 1;
            margin-right: 20px;
        }

        .sample-text h1 {
            margin: 0 0 10px 0;
        }

        .sample-text p {
            margin: 0;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 0px 0px 10px 10px;
            padding: 30px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            flex: 0 0 auto;
            border-top: 9px solid red;
        }

        .login-container h2 {
            margin: 0 0 20px 0;
            color: #333;
            text-align: center;
        }

        .login-container label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        .login-container a {
            color: #007bff;
            text-decoration: none;
        }

        .login-container a:hover {
            text-decoration: underline;
        }

        .login-container .links {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <?php include_once 'common/nav.php'; ?>
    <div class="background-image"></div>
    <div class="dark-overlay"></div>
    <div class="container">
        <div class="sample-text">
            <h1>Welcome to Your Athletic Hub!</h1>
            <p>Welcome, Champions! We're thrilled to have you here. Whether you're a seasoned pro or an up-and-coming
                star. Let's make greatness happen together.</p>
        </div>
        <div class="login-container">
            <h2>Login</h2>
            <form action="login" method="post">
                <div class="msg" style="display:<?php echo !empty($flash['message']) ? 'block' : 'none' ?>; width:auto">
                    <?php echo $flash['message'] ?? ''; ?>
                </div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $email ?? '' ?>" required>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
                <div class="links">
                    <a href="#">Forgot Password?</a>
                    <a href="register">Register</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>