<?php require 'views/admin/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/allowance.js"></script>
</head>

<body>
    <!-- HEADER -->
    <?php include 'common/header.php'; ?>
    <div class="container">

        <div class="main-content">
            <!-- SIDE NAVIGATION -->
            <?php include 'common/sidenav.php'; ?>
            <div class="right-panel">
                <div class="page-title">
                    Allowance
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <form id="send_allowance_notice">
                            <label for="msg" class="label">Message</label>
                            <textarea name="msg" id="msg" class="sms-input" rows="5"
                                style="resize: vertical; font-size:1.2rem;font-family: Arial, sans-serif;">Your allowance is now available for collection at the accounting department. Please ensure that you claim it within the next 5 days to avoid any inconvenience.</textarea>
                            <button type="submit" id="submit" class="button button-success">Send Notice</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>