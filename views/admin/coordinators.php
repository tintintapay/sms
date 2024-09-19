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
                    Coordinators
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <div class="action-bar">
                            <a href="coordinator-add" class="sms-btn">Add</a>
                        </div>
                        <table class="sms-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($coordinators as $coordinator): ?>
                                    <tr style="background-color: <?= ($coordinator['active']) ? '' : '#afafaf' ?>">
                                        <td><?= $coordinator['full_name'] ?></td>
                                        <td><?= $coordinator['email'] ?></td>
                                        <td><a href="coordinator?id=<?= $coordinator['user_id'] ?>">View</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script src="../assets/js/admin_profile.js"></script>
</body>

</html>