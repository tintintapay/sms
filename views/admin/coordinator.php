<?php require 'views/admin/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin_profile.css">
    <link rel="stylesheet" href="../assets/css/sms-table.css">
    <link rel="stylesheet" href="../vendor/fontawesome-6.5.1/css/all.min.css">
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
                    <div>
                        Coordinators <i class="fa-solid fa-chevron-right fa-2xs" style="color: #b0b0b0;"></i>
                        <small><?= $request['full_name'] ?></small>
                    </div>
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <div class="msg" style="display:<?= !empty($flash['message']) ? 'block' : 'none' ?>">
                            <?= $flash['message'] ?? ''; ?>
                        </div>
                        <form action="save-coordinator" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <?php include 'common/coordinator-form.php'; ?>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>