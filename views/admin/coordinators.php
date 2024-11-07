<?php require 'views/admin/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinators</title>
    <link rel="stylesheet" href="../assets/css/admin_profile.css">
    <link rel="stylesheet" href="../assets/css/sms-table.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <?php include 'views/common/datatables.php'; ?>
    <script src="../assets/js/coordinators.js"></script>
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
                    <div class="header-action">
                        <a href="coordinator-add" class="button button-success button-md">Add</a>
                    </div>
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <table id="myTable" style="display:none">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $index = 1;
                                foreach ($coordinators as $coordinator): ?>
                                    <tr class="<?= $coordinator['status'] ?>">
                                        <td><?= $index ?></td>
                                        <td><?= $coordinator['full_name'] ?></td>
                                        <td><?= $coordinator['email'] ?></td>
                                        <td><?= $coordinator['gender'] ?></td>
                                        <td><?= $coordinator['age'] ?></td>
                                        <td><?= $coordinator['phone_number'] ?></td>
                                        <td><?= $coordinator['address'] ?></td>
                                        <td><?= $coordinator['status'] ?></td>
                                        <td>
                                            <a href="coordinator?id=<?= $coordinator['user_id'] ?>"
                                                class="button button-primary button-xs">View</a>
                                        </td>
                                    </tr>
                                    <?php
                                    $index++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- <script src="../assets/js/admin_profile.js"></script> -->
</body>

</html>