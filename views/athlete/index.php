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
                <div class="section">
                    <div class="card">
                        <h3>Announcement</h3>
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae dicta temporibus fugiat,
                                quibusdam placeat harum facere veritatis quis accusamus autem facilis fuga illo
                                cupiditate
                                quaerat, ipsa, blanditiis excepturi unde nemo?

                            </p>
                        </div>

                    </div>
                </div>
                <div class="section">
                    <div class="card">
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
                                        <?php if ($schedule['status'] === EvaluationStatus::PENDING):?>
                                        <div class="game-action">
                                            <div class="game-schedule">Submission until:
                                                <?php
                                                $scheduleDate = new DateTime($schedule['schedule']);
                                                $deadlineDate = (clone $scheduleDate)->modify('-7 days');
                                                echo $deadlineDate->format('Y-m-d');
                                                ?>
                                            </div>
                                            <a href="submit-evaluation?game-id=<?= $schedule['id'] ?>"
                                                class="button button-success">Submit Evaluation</a>
                                        </div>
                                        <!-- SUBMITTED -->
                                        <?php elseif($schedule['status'] === EvaluationStatus::SUBMITTED): ?>
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

            </div>
        </div>
    </div>
</body>

</html>