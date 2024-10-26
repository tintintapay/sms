<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athlete Rating</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <?php include 'views/common/datatables.php'; ?>
    <script src="../assets/js/athlete-ratings.js"></script>
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
                    Game Schedules
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <table id="myTable" style="display:none">
                            <thead>
                                <tr>
                                    <th>Game Title</th>
                                    <th>Schedule</th>
                                    <th>Sport</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($gameScheds as $gameSched): ?>
                                        <tr class="<?= $gameSched['status'] ?>">
                                            <td><?= $gameSched['game_title'] ?></td>
                                            <td><?= $gameSched['schedule'] ?></td>
                                            <td><?= Sport::getDescription($gameSched['sport']) ?></td>
                                            <td><?= $gameSched['status'] ?></td>
                                            <td>
                                                <a href="athlete-rating?game_id=<?= $gameSched['id'] ?>"
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