<?php require 'views/athlete/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/athlete-home.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/athlete-dashboard.js"></script>
</head>

<body>
    <!-- HEADER -->
    <?php include 'common/header.php'; ?>

    <div class="container">
        <div class="main-content">
            <!-- SIDE NAVIGATION -->
            <?php include 'common/sidenav.php'; ?>

            <div class="right-panel">
                <div class="page-title">Dashboard</div>
                <hr>

                <!-- ALLOWANCE SECTION -->
                <?php if ($allowance): ?>
                    <div class="section">
                        <div class="allowance-box">
                            <h2>Allowance</h2>
                            <p><strong>Allowance Status:</strong> <span
                                    style="color: #28a745;"><?= AllowanceStatus::getDescription($allowance['status']) ?></span>
                            </p>
                            <p><?= $allowance['message'] ?></p>
                            <p class="date-info"><?= Helper::formatDate($allowance['created_at'], 'Y-m-d') ?></p>
                            <?php if ($allowance['status'] === AllowanceStatus::NOT_YET_CLAIMED): ?>
                                <div style="text-align: right;">
                                    <form action="claim-allowance" method="POST" id="allowance-claim-form">
                                        <input type="hidden" name="id" id="id" value="<?= $_SESSION['user_id'] ?>">
                                        <button type="button" class="button claim-button">Claim</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- ANNOUNCEMENTS SECTION -->
                <div class="section flex gap-10">
                    <div class="w-half announcement" style="max-height: 500px; overflow-y: auto;">
                        <h3>Announcements</h3>
                        <?php foreach ($announcements as $announcement): ?>
                            <div class="announcement-card">
                                <h2><?= $announcement['title'] ?></h2>
                                <p><strong>Date:</strong>
                                    <?= (new DateTime($announcement['created_at']))->format('F j, Y, g:i A'); ?></p>
                                <p><strong>Author:</strong> <?= $announcement['created']; ?></p>
                                <p><?= $announcement['description'] ?></p>
                            </div>
                            <hr>
                        <?php endforeach; ?>
                    </div>

                    <!-- SCHEDULE SECTION -->
                    <div class="w-half schedule" style="max-height: 500px; overflow-y: auto;">
                        <h3>Schedule</h3>
                        <div class="schedule-body">
                            <?php foreach ($schedules as $schedule): ?>
                                <?php if ($schedule['is_included']): ?>
                                    <div class="game-card">
                                        <div class="game-info">
                                            <div class="game-title"><?= $schedule['game_title'] ?></div>
                                            <div class="game-schedule"><?= $schedule['schedule'] ?></div>
                                            <?php if (!empty($schedule['schedule_picture'])): ?>
                                                <div class="game-schedule"><a target="_blank"
                                                        href="game-schedule?id=<?= $schedule['id'] ?>&file=<?= $schedule['schedule_picture'] ?>">Game
                                                        Schedule</a></div>
                                            <?php endif; ?>
                                        </div>

                                        <!-- PENDING -->
                                        <?php if ($schedule['status'] === EvaluationStatus::PENDING): ?>
                                            <div class="game-action">
                                                <?php
                                                $scheduleDate = new DateTime($schedule['schedule']);
                                                $deadlineDate = (clone $scheduleDate)->modify('-7 days');
                                                $isDeadline = ($deadlineDate < new DateTime()) ? true : false;
                                                if (!$isDeadline): ?>
                                                    <div class="game-schedule">Submission until: <?= $deadlineDate->format('Y-m-d'); ?>
                                                    </div>
                                                    <a href="submit-evaluation?game-id=<?= $schedule['id'] ?>"
                                                        class="button button-success">Submit Evaluation</a>
                                                <?php else: ?>
                                                    Event Completed!
                                                <?php endif; ?>
                                            </div>
                                        <?php elseif ($schedule['status'] === EvaluationStatus::SUBMITTED): ?>
                                            <div class="game-action">Submitted!</div>
                                        <?php elseif ($schedule['status'] === EvaluationStatus::APPROVED): ?>
                                            <div class="game-action">Evaluation Approved!</div>
                                        <?php elseif ($schedule['status'] === EvaluationStatus::DISAPPROVED): ?>
                                            <div class="game-action">Evaluation Disapproved!</div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>