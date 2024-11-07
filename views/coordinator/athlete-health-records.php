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
    <script src="../assets/js/athlete-health-records.js"></script>
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
                    Records
                    <div class="header-action">
                        <a href="athlete-health-record-create?athlete_id=<?= $params['id'] ?>" class="button button-success button-md approve-athlete">Add</a>
                    </div>
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <input type="hidden" id="full_name" value="<?= $athlete['full_name']?>">
                        <table id="myTable" style="display:none">
                            <thead>
                                <tr>
                                    <th style="width:15px">No.</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 1;?>
                                <?php foreach ($records as $record): ?>
                                    <tr>
                                        <td><?= $index ?></td>
                                        <td><?= HealthStatus::getPills($record['status']) ?></td>
                                        <td><?= $record['remarks'] ?></td>
                                        <td><?= $record['created_at'] ?></td>
                                    </tr>
                                    <?php $index++; ?>
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