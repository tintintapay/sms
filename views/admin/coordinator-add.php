<?php require 'views/admin/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin_profile.css">
    <link rel="stylesheet" href="../assets/css/sms-table.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <script type="module" src="../assets/js/main.js"></script>
</head>

<body>
    <!-- HEADER -->
    <?php include 'common/header.php'; ?>
    <div class="container">
        <div class="main-content">
            <!-- SIDE NAVIGATION -->
            <?php include 'common/sidenav.php'; ?>

            <div class="right-panel" style="color:black">
                <div class="page-title">
                    Add Coordinator
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <div class="msg" style="display:<?php echo !empty($flash['message']) ? 'block' : 'none' ?>">
                            <?php echo $flash['message'] ?? ''; ?>
                        </div>
                        <form action="coordinator-add" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?php include 'common/coordinator-form.php';?>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script src="../assets/js/admin_profile.js"></script>
</body>

</html>