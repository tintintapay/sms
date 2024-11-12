<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <?php include 'views/common/datatables.php'; ?>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/announcements.js"></script>
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
                    Announcements
                    <div class="header-action">
                        <a href="announcements-create" class="button button-success button-md ">Add</a>
                    </div>
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <table id="myTable" style="display:none">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($announcements as $announcement): ?>
                                    <tr>
                                        <td><?= $announcement['title'] ?></td>
                                        <td><?= $announcement['created'] ?></td>
                                        <td><?= $announcement['created_at'] ?></td>
                                        <td>
                                            <a href="announcement?id=<?= $announcement['id'] ?>"
                                                class="button button-primary button-xs">View</a>
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