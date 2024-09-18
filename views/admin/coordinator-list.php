<?php require 'views/admin/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin_profile.css">
    <link rel="stylesheet" href="../assets/css/sms_table.css">
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

                <div class="card">
                    <table class="sms-table">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Address</th>
                                <th>Age</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($coordinators as $coordinator) {
                                echo "
                                <tr>
                                    <td>{$coordinator['first_name']}</td>
                                    <td>{$coordinator['address']}</td>
                                    <td>{$coordinator['age']}</td>
                                </tr>
                            ";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
    <script src="../assets/js/admin_profile.js"></script>
</body>

</html>