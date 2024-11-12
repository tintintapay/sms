<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athlete Rating</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../vendor/fontawesome-6.5.1/css/all.min.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/athlete-rating.js"></script>
</head>

<body>
    <input type="hidden" name="game_id" id="game_id" value="<?= $_GET['game_id'] ?>">
    <!-- HEADER -->
    <?php include 'common/header.php'; ?>
    <div class="container">

        <div class="main-content">
            <!-- SIDE NAVIGATION -->
            <?php include 'common/sidenav.php'; ?>
            <div class="right-panel">
                <div class="page-title">
                    Athlete Rating | <?= $gameSched['game_title'] ?>
                </div>
                <hr>
                <?php foreach ($evaluations as $evaluation): ?>
                    <div class="section"
                        style="align-items: flex-start; padding: 20px; margin-bottom: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">
                        <div style="float:right">
                            <?= HealthStatus::getPills(Helper::getHealthStatus($evaluation['athlete_id'])) ?>
                        </div>
                        <div class="athlete-name" style="font-weight: bold; font-size: 18px; margin-bottom: 10px;">
                            <i class="fas fa-user" style="margin-right: 5px;"></i>
                            <?= $evaluation['full_name'] ?>
                        </div>

                        <div class="msg msg_<?= $evaluation['id'] ?>" style="display:none">

                        </div>

                        <input type="hidden" name="athlete_id_<?= $evaluation['id'] ?>"
                            id="athlete_id_<?= $evaluation['id'] ?>" value="<?= $evaluation['athlete_id'] ?>">

                        <!-- Teamwork Field -->
                        <div style="margin-bottom: 10px;">
                            <label for="teamwork_<?= $evaluation['id'] ?>" style="font-weight: bold;">Teamwork</label>
                            <p style="font-size: 12px; margin-bottom: 5px;">Ability to collaborate effectively with others
                                to achieve shared
                                goals.</p>
                            <input type="number" id="teamwork_<?= $evaluation['id'] ?>"
                                name="teamwork_<?= $evaluation['id'] ?>"
                                style="width: 100%; max-width: 100px; padding: 5px;" min="1" max="10"
                                placeholder="Rate 1-10" value="<?= $evaluation['teamwork'] ?>">
                        </div>

                        <!-- Sportsmanship Field -->
                        <div style="margin-bottom: 10px;">
                            <label for="sportsmanship_<?= $evaluation['id'] ?>"
                                style="font-weight: bold;">Sportsmanship</label>
                            <p style="font-size: 12px; margin-bottom: 5px;">Respectful and fair behavior toward opponents,
                                teammates, and the
                                game itself.</p>
                            <input type="number" id="sportsmanship_<?= $evaluation['id'] ?>"
                                name="sportsmanship_<?= $evaluation['id'] ?>"
                                style="width: 100%; max-width: 100px; padding: 5px;" min="1" max="10"
                                placeholder="Rate 1-10" value="<?= $evaluation['sportsmanship'] ?>">
                        </div>

                        <!-- Technical Skills Field -->
                        <div style="margin-bottom: 10px;">
                            <label for="technical_skills_<?= $evaluation['id'] ?>" style="font-weight: bold;">Technical
                                Skills</label>
                            <p style="font-size: 12px; margin-bottom: 5px;">Proficiency in the core mechanics and techniques
                                required to excel
                                in the game.</p>
                            <input type="number" id="technical_skills_<?= $evaluation['id'] ?>"
                                name="technical_skills_<?= $evaluation['id'] ?>"
                                style="width: 100%; max-width: 100px; padding: 5px;" min="1" max="10"
                                placeholder="Rate 1-10" value="<?= $evaluation['technical_skills'] ?>">
                        </div>

                        <!-- Adaptability Field -->
                        <div style="margin-bottom: 10px;">
                            <label for="adaptability_<?= $evaluation['id'] ?>"
                                style="font-weight: bold;">Adaptability</label>
                            <p style="font-size: 12px; margin-bottom: 5px;">Capacity to quickly adjust strategies and
                                approaches in response to
                                changing conditions.</p>
                            <input type="number" id="adaptability_<?= $evaluation['id'] ?>"
                                name="adaptability_<?= $evaluation['id'] ?>"
                                style="width: 100%; max-width: 100px; padding: 5px;" min="1" max="10"
                                placeholder="Rate 1-10" value="<?= $evaluation['adaptability'] ?>">
                        </div>

                        <!-- Game Sense Field -->
                        <div style="margin-bottom: 10px;">
                            <label for="game_sense_<?= $evaluation['id'] ?>" style="font-weight: bold;">Game Sense</label>
                            <p style="font-size: 12px; margin-bottom: 5px;">Deep understanding of game strategy,
                                positioning, and timing to make
                                smart decisions.</p>
                            <input type="number" id="game_sense_<?= $evaluation['id'] ?>"
                                name="game_sense_<?= $evaluation['id'] ?>"
                                style="width: 100%; max-width: 100px; padding: 5px;" min="1" max="10"
                                placeholder="Rate 1-10" value="<?= $evaluation['game_sense'] ?>">
                        </div>

                        <!-- Remarks -->
                        <div style="margin-bottom: 10px;">
                            <label for="remarks_<?= $evaluation['id'] ?>"
                                style="font-weight: bold;display:block;margin-bottom: 10px;">Remarks</label>
                            <textarea id="remarks_<?= $evaluation['id'] ?>" rows="5" name="remarks_<?= $evaluation['id'] ?>"
                                style="width: 100%; max-width: 400px; padding: 5px; resize: vertical;"
                                placeholder="Performance remarks..."><?= $evaluation['remarks'] ?></textarea>
                        </div>



                        <!-- Save Changes Button -->
                        <button type="button" class="save-btn" data-id="<?= $evaluation['id'] ?>"
                            style="padding: 10px 15px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
                            Save Changes
                        </button>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</body>

</html>