<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athlete's Health Record</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <?php include 'views/common/datatables.php'; ?>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/health-records.js"></script>
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
                    Athlete's Health Record
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <table id="myTable" style="display:none">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Campus</th>
                                    <th>Sport</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($athletes as $athlete): ?>
                                    <tr>
                                        <td>
                                            <?= Helper::athleteWithHealthStatus($athlete['user_id'], $athlete['full_name']) ?>
                                        </td>
                                        <td><?= $athlete['email'] ?></td>
                                        <td><?= School::getDescription($athlete['school']) ?></td>
                                        <td><?= Sport::getDescription($athlete['sport']) ?></td>
                                        <td>
                                            <a href="athlete-health-records?id=<?= $athlete['user_id'] ?>"
                                                class="button button-primary button-xs">Details</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>