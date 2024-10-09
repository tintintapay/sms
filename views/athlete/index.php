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
                <div class="page-title">
                    Dashboard
                </div>
                <hr>
                <div class="section flex gap-10">
                    <div class="w-half" style="overflow-y: auto;max-height: 500px; ">
                        <h3>Announcement</h3>
                        <?php foreach ($announcements as $announcement): ?>
                            <div
                                style="margin: 20px auto;padding: 20px;box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);background-color: #f9f9f9;font-family: Arial, sans-serif;">
                                <h2 style="font-size: 24px;color: #333;margin-bottom: 10px;font-weight: bold;">
                                    <?= $announcement['title'] ?>
                                </h2>
                                <p style="font-size: 14px;color: #666;margin-bottom: 15px;">
                                    <strong>Date:</strong>
                                    <?= (new DateTime($announcement['created_at']))->format('F j, Y, g:i A'); ?>
                                </p>
                                <p style="font-size: 14px;color: #666;margin-bottom: 15px;">
                                    <strong>Author:</strong> <?php echo $announcement['created']; ?>
                                </p>

                                <p style="font-size: 16px;color: #555;line-height: 1.6;">
                                    <?= $announcement['description'] ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="card w-half" style="overflow-y: auto;max-height: 500px; ">
                        <h3>Schedule</h3>
                        <div class="card-body">
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
                                                if (!$isDeadline):
                                                    ?>
                                                    <div class="game-schedule">Submission until:
                                                        <?= $deadlineDate->format('Y-m-d'); ?>
                                                    </div>
                                                    <a href="submit-evaluation?game-id=<?= $schedule['id'] ?>"
                                                        class="button button-success">Submit Evaluation</a>
                                                <?php else: ?>
                                                    Event Completed!
                                                <?php endif; ?>
                                            </div>
                                            <!-- SUBMITTED -->
                                        <?php elseif ($schedule['status'] === EvaluationStatus::SUBMITTED): ?>
                                            <div class="game-action">
                                                Submitted!
                                            </div>
                                            <!-- APPROVED -->
                                        <?php elseif ($schedule['status'] === EvaluationStatus::APPROVED): ?>
                                            <div class="game-action">
                                                Evaluation Approved!
                                            </div>
                                            <!-- DISAPPROVED -->
                                        <?php elseif ($schedule['status'] === EvaluationStatus::DISAPPROVED): ?>
                                            <div class="game-action">
                                                Evaluation Disapproved!
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>

                    </div>

                </div>
                <div class="section">

                </div>

            </div>
        </div>
    </div>
</body>

</html>