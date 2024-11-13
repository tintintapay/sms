<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../vendor/fontawesome-6.5.1/css/all.min.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../vendor/apexchart/apexcharts.js"></script>
    <script src="../assets/js/print.js"></script>
</head>

<body>
    <!-- Modal -->
    <div id="modal" class="modal">
        <div class="modal-content" style="max-width:500px">
            <h3>Population Filter by Campus<span class="close">&times;</span></h3>
            <hr>
            <div>
                <form action="">
                    <label for="school">Select Campus:</label>
                    <!-- <input type="text" class="sms-input" name="school" id="school"> -->
                    <select name="school" id="school" class="sms-input">
                        <option value="">- Please Select -</option>
                        <?php foreach ($schoolList as $key => $value): ?>
                            <option value="<?= $key?>"><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>

                    <button class="button button-primary button-sm">Filter</button>
                    <a href="home" class="button button-warning button-sm">Clear</a>
                </form>
            </div>
        </div>
    </div>

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
                    <?= $allowanceClaim; ?>
                </div>
                <div class="section">
                    <div style="display: flex;gap:15px;flex-wrap: wrap;">
                        <!-- Incoming Event -->
                        <div style="background-color:#fff; border-radius:10px; padding: 15px; flex:1">
                            <h3 style="margin: 0px 0px 15px 0px;">Incoming Events</h3>
                            <hr>
                            <div style="display:flex;flex-direction: column;flex-wrap: wrap;gap: 7px;">
                                <?php foreach ($events as $event): ?>
                                    <div class="bg-red"
                                        style="display:flex;justify-content: space-between;align-items:center; padding: 20px; width: auto; font-family: Arial, sans-serif; border: 1px solid #dee2e6; border-radius: 8px;">
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
                            <?php if ($announcement): ?>
                                <div class="announcement-card">
                                    <h3><?= $announcement['title'] ?></h3>
                                    <p><?= Helper::formatDate($announcement['created_at'], 'M y, Y') ?></p>
                                    <p><?= $announcement['description'] ?></p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Population -->
                        <div id="report_population"
                            style="background-color:#fff; border-radius:10px; padding: 15px; flex:0.6">
                            <h3 style="margin: 0px 0px 15px 0px;">Athlete Population
                                <span style="float:right">
                                    <button class="button button-white button-sm" onclick="openModal()">
                                        <i class="fa-solid fa-filter"></i>
                                    </button>
                                </span>
                            </h3>
                            <hr>
                            <?= $population; ?>
                        </div>
                    </div>
                </div>

                <div class="section">
                    <div style="display:flex;gap:15px;flex-wrap: wrap;">
                        <div id="report_top_rated"
                            style="background-color:#fff; border-radius:10px; padding: 15px; flex:0.6">
                            <h3 style="margin: 0px 0px 15px 0px;"><?= date('F') ?> Top-Rated Athletes</h3>
                            <hr>
                            <?= $topRatedAthletes ?? ''; ?>
                        </div>
                        <div id="report_game_highlight"
                            style="background-color:#fff; border-radius:10px; padding: 15px; flex:0.4">
                            <h3 style="margin: 0px 0px 15px 0px;"><?= date('F') ?> Game highlight
                                <span style="float:right">
                                    <button onclick="print_div('report_game_highlight')"><i
                                            class="fa-solid fa-print"></i></button>
                                </span>
                            </h3>
                            <hr>
                            <?= $gameHighlights; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/modal.js"></script>
</body>

</html>