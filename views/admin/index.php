<?php
require 'views/admin/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin_profile.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    Dashboard
                </div>
                <hr>
                <div class="section">
                    <div style="display: flex;gap:15px;flex-wrap: wrap;">
                        <!-- Incoming Event -->
                        <div style="background-color:#fff; border-radius:10px; padding: 15px; flex:1">
                            <h3 style="margin: 0px 0px 15px 0px;">Incoming Events</h3>
                            <hr>
                            <div style="display:flex;flex-direction: column;flex-wrap: wrap;gap: 7px;">
                                <?php foreach ($events as $event): ?>
                                    <div
                                        style="display:flex;justify-content: space-between;align-items:center;background-color: #f8f9fa; padding: 20px; width: auto; font-family: Arial, sans-serif; border: 1px solid #dee2e6; border-radius: 8px;">
                                        <div>
                                            <div><?= $event['game_title'] ?></div>
                                            <div style="font-size: 0.8rem;"><?= Sport::getDescription($event['sport']) ?>
                                            </div>
                                        </div>
                                        <div><?= Helper::formatDate($event['schedule'], 'M y, Y') ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Latest Announcement -->
                        <div style="background-color:#fff; border-radius:10px; padding: 15px; flex:1">
                            <h3 style="margin: 0px 0px 15px 0px;">Latest Announcement</h3>
                            <hr>
                            <div class="announcement-card">
                                <h3><?= $announcement['title'] ?></h3>
                                <p><?= Helper::formatDate($announcement['created_at'], 'M y, Y') ?></p>
                                <p><?= $announcement['description'] ?></p>
                            </div>
                        </div>

                        <!-- Population -->
                        <div style="background-color:#fff; border-radius:10px; padding: 15px; flex:0.6">
                            <h3 style="margin: 0px 0px 15px 0px;">Athlete Population</h3>
                            <hr>

                            <?= $population; ?>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div style="display:flex;gap:15px;flex-wrap: wrap;">
                        <div style="background-color:#fff; border-radius:10px; padding: 15px; flex:0.6">
                            <h3 style="margin: 0px 0px 15px 0px;"><?= date('F') ?> Top-Rated Athletes</h3>
                            <hr>
                            <?= $topRatedAthletes; ?>
                        </div>
                        <div style="background-color:#fff; border-radius:10px; padding: 15px; flex:0.4">
                            <h3 style="margin: 0px 0px 15px 0px;"><?= date('F') ?> Game highlight</h3>
                            <hr>
                            <?= $gameHighlights; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/admin-dashboard.js"></script>
</body>

</html>