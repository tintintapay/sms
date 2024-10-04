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
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <?php include 'views/common/datatables.php'; ?>
    <script src="../assets/js/manage-athlete.js"></script>
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
                    Manage Athlete
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <table id="myTable" style="display:none">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>School</th>
                                    <th>Sport</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($athletes)): ?>
                                    <?php foreach ($athletes as $athlete): ?>
                                        <tr class="<?= $athlete['status'] ?>">
                                            <td><?= $athlete['full_name'] ?></td>
                                            <td><?= $athlete['email'] ?></td>
                                            <td><?= $athlete['gender'] ?></td>
                                            <td><?= $athlete['age'] ?></td>
                                            <td><?= $athlete['phone_number'] ?></td>
                                            <td><?= $athlete['address'] ?></td>
                                            <td><?= $athlete['school'] ?></td>
                                            <td><?= $athlete['sport'] ?></td>
                                            <td><?= $athlete['status'] ?></td>
                                            <td>
                                                <a href="athlete?id=<?= $athlete['user_id'] ?>"
                                                    class="button button-primary button-xs">View</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="10" style="text-align: center;">No record...</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>