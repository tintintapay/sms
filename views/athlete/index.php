<?php require 'views/athlete/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/athlete-home.css">
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
                <div class="section">
                    <div class="allowance-box">
                        <h2>Allowance</h2>
                        <p><strong>Allowance Status:</strong> <span
                                style="color: #28a745;"><?= AllowanceStatus::getDescription($allowance['status']) ?></span>
                        </p>
                        <p><?= $allowance['message'] ?></p>
                        <p class="date-info"><?= Helper::formatDate($allowance['created_at'], 'Y-m-d') ?></p>
                        <?php if ($allowance['status'] === AllowanceStatus::AVAILABLE): ?>
                            <div style="text-align: right;">
                                <form action="claim-allowance" method="POST">
                                    <input type="hidden" name="id" id="id" value="<?= $_SESSION['user_id'] ?>">
                                    <button type="submit" class="button">Claim</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

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
                        <?php endforeach; ?>
                    </div>

                    <!-- SCHEDULE SECTION -->
                    <div class="w-half schedule" style="max-height: 500px; overflow-y: auto;">
                        <h3>Schedule</h3>
                        <div class="schedule-body">
                            <?php foreach ($schedules as $schedule): ?>
                                <div class="game-card">
                                    <div class="game-info">
                                        <div class="game-title"><?= $schedule['game_title'] ?></div>
                                        <div class="game-schedule"><?= $schedule['schedule'] ?></div>
                                    </div>
                                    <?php if ($schedule['is_included']): ?>
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
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>