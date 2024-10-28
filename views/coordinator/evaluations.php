<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluations</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../vendor/fontawesome-6.5.1/css/all.min.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/evaluations.js"></script>
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
                    <?= $gameSched['game_title'] ?>
                </div>
                <hr>
                <?php foreach ($evaluations as $evaluation): ?>
                    <div class="section"
                        style="display: flex; justify-content: space-between; align-items: flex-start; padding: 20px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">

                        <!-- Left Section: Athlete Information -->
                        <div class="athlete-info" style="width: 45%; padding-right: 20px; border-right: 1px solid #ddd;">
                            <div class="athlete-name" style="font-weight: bold; font-size: 18px; margin-bottom: 10px;">
                                <i class="fas fa-user" style="margin-right: 5px;"></i>
                                <?= $evaluation['full_name'] ?>
                            </div>
                            <div class="athlete-email" style="color: #555; margin-bottom: 5px;">
                                <i class="fas fa-envelope" style="margin-right: 5px;"></i>
                                <?= $evaluation['email'] ?>
                            </div>
                            <div class="athlete-age" style="margin-bottom: 5px;">
                                <i class="fas fa-calendar-alt" style="margin-right: 5px;"></i>
                                <?= Helper::getAge($evaluation['birthday']) ?> years old
                            </div>
                            <div class="athlete-year-course" style="color: #777;">
                                <i class="fas fa-graduation-cap" style="margin-right: 5px;"></i>
                                <?= $evaluation['year_level'] . ' ' . $evaluation['course'] ?>
                            </div>
                        </div>

                        <!-- Right Section: Documents & Buttons -->
                        <div class="documents" style="width: 50%; padding-left: 20px;">
                            <!-- Approval Status -->
                            <div class="approval-status" style="margin-bottom: 15px;">
                                <?php if ($evaluation['status'] == EvaluationStatus::APPROVED): ?>
                                    <span style="padding: 5px 10px; background-color: #28a745; color: white; border-radius: 5px;">
                                        <i class="fas fa-check-circle"></i> Approved
                                    </span>
                                <?php elseif ($evaluation['status'] == EvaluationStatus::DISAPPROVED): ?>
                                    <span style="padding: 5px 10px; background-color: #dc3545; color: white; border-radius: 5px;">
                                        <i class="fas fa-times-circle"></i> Disapproved
                                    </span>
                                <?php endif; ?>
                            </div>

                            <?php if ($evaluation['eligibility_form']): ?>
                                <ul class="documents-list" style="list-style: none; padding: 0;">
                                    <li style="margin-bottom: 5px;">
                                        Date of Contract: <strong><?= Helper::formatDate($evaluation['contract_date'], 'F j, Y') ?></strong>
                                    </li>
                                    <li style="margin-bottom: 5px;">
                                        <i class="fas fa-file-alt" style="margin-right: 5px;"></i>
                                        <a href="/assets/uploads/evaluation/<?= $evaluation['athlete_id'] ?>/<?= $evaluation['eligibility_form'] ?>"
                                            target="_blank" style="color: #007bff;"
                                            download="<?= $evaluation['full_name'] . ' Eligibility Form' ?>">Eligibility
                                            Form</a>
                                    </li>
                                    <li style="margin-bottom: 5px;">
                                        <i class="fas fa-file-alt" style="margin-right: 5px;"></i>
                                        <a href="/assets/uploads/evaluations/<?= $evaluation['athlete_id'] ?>/<?= $evaluation['tryout_form'] ?>"
                                            target="_blank" style="color: #007bff;"
                                            download="<?= $evaluation['full_name'] . ' Try-out Form' ?>">Try-out Form</a>
                                    </li>
                                    <li style="margin-bottom: 5px;">
                                        <i class="fas fa-file-medical" style="margin-right: 5px;"></i>
                                        <a href="/assets/uploads/evaluations/<?= $evaluation['athlete_id'] ?>/<?= $evaluation['med_cert'] ?>"
                                            target="_blank" style="color: #007bff;"
                                            download="<?= $evaluation['full_name'] . ' Medical Certification' ?>">Medical
                                            Certification</a>
                                    </li>
                                    <li style="margin-bottom: 5px;">
                                        <i class="fas fa-file-alt" style="margin-right: 5px;"></i>
                                        <a href="/assets/uploads/evaluations/<?= $evaluation['athlete_id'] ?>/<?= $evaluation['cor'] ?>"
                                            target="_blank" style="color: #007bff;"
                                            download="<?= $evaluation['full_name'] . ' Certification of Registration (COR)' ?>">Certification
                                            of
                                            Registration (COR)</a>
                                    </li>
                                    <li>
                                        <i class="fas fa-file-alt" style="margin-right: 5px;"></i>
                                        <a href="/assets/uploads/evaluations/<?= $evaluation['athlete_id'] ?>/<?= $evaluation['grades'] ?>"
                                            target="_blank" style="color: #007bff;"
                                            download="<?= $evaluation['full_name'] . ' Copy of Grades' ?>">Copy of Grades</a>
                                    </li>
                                </ul>
                                <?php if (($evaluation['status'] === EvaluationStatus::SUBMITTED) && ($gameSched['status'] !== GameStatus::COMPLETED)):?>
                                <!-- Buttons: Approve and Disapprove -->
                                <div class="action-buttons" style="margin-top: 20px;">
                                    <button class="approve-evaluation" data-id="<?= $evaluation['id']?>"
                                        style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; margin-right: 10px;">
                                        <i class="fas fa-check" style="margin-right: 5px;"></i> Approve
                                    </button>
                                    <button class="disapprove-evaluation" data-id="<?= $evaluation['id'] ?>"
                                        style="padding: 10px 20px; background-color: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer;">
                                        <i class="fas fa-times" style="margin-right: 5px;"></i> Disapprove
                                    </button>
                                </div>
                                    
                                <?php endif;?>
                            <?php else: ?>
                                <h3 style="color: red;">
                                    <i class="fas fa-exclamation-circle" style="margin-right: 5px;"></i>Not yet submitted
                                </h3>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</body>

</html>