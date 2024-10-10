<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/athlete-show.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/athlete.js"></script>
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
                    Athlete
                    <div class="header-action">
                        <?php echo $athlete['status'] === UserStatus::PENDING
                            ? '<button class="button button-success button-md approve-athlete">Approve</button>'
                            : ''; ?>
                        <button class="button button-primary button-md delete-athlete">Delete</button>
                    </div>
                </div>
                <hr>
                <div class="section">
                    <div class="profile-container">
                        <!-- Column 1: Basic Info -->
                        <div class="profile-column basic-info">
                            <img src="../assets/uploads/docs/<?= $athlete['user_id'] ?>/<?= $athlete['picture'] ?>"
                                alt="Student Photo" class="student-photo">
                            <h2 class="student-name"><?= $athlete['full_name'] ?></h2>
                            <p><strong>Email:</strong> <?= $athlete['email'] ?></p>
                            <p><strong>Gender:</strong> <?= $athlete['gender'] ?></p>
                            <p><strong>Age:</strong> <?= Helper::getAge($athlete['birthday']) ?></p>
                            <p><strong>Address:</strong> <?= $athlete['address'] ?></p>
                            <p><strong>Phone Number:</strong> <?= $athlete['phone_number'] ?></p>
                        </div>

                        <!-- Column 2: School Info & Documents -->
                        <div class="profile-column school-info">
                            <h2>School Information</h2>
                            <p><strong>School:</strong> <?= $athlete['school'] ?></p>
                            <p><strong>Course:</strong> <?= $athlete['course'] ?></p>
                            <p><strong>Year Level:</strong> <?= $athlete['year_level'] ?> Year</p>
                            <p><strong>Sport:</strong> <?= Sport::getDescription($athlete['sport']) ?></p>

                            <h3>Documents</h3>
                            <ul class="documents-list">
                                <li>Certificate of Registration (COR)
                                    <a href="../assets/uploads/docs/<?= $athlete['user_id'] ?>/<?= $athlete['cor'] ?>"
                                        target="_blank" class="button button-s button-danger"
                                        download="<?= $athlete['full_name'].'Certificate of Registration (COR)' ?>">Download
                                    </a>
                                </li>
                                <li>PSA Birth Certificate
                                    <a href="../assets/uploads/docs/<?= $athlete['user_id'] ?>/<?= $athlete['psa'] ?>"
                                        target="_blank" class="button button-s button-danger"
                                        download="<?= $athlete['full_name'].'PSA Birth Certificate' ?>">Download
                                    </a>
                                </li>
                                <li>Medical Certificate
                                    <a href="../assets/uploads/docs/<?= $athlete['user_id'] ?>/<?= $athlete['medical_cert'] ?>"
                                        target="_blank" class="button button-s button-danger"
                                        download="<?= $athlete['full_name'].'Medical Certificate' ?>">Download
                                    </a>
                                </li>
                                <li>2x2 Picture
                                    <a href="../assets/uploads/docs/<?= $athlete['user_id'] ?>/<?= $athlete['picture'] ?>"
                                        target="_blank" class="button button-s button-danger"
                                        download="<?= $athlete['full_name'].'2x2 Picture' ?>">Download
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <iframe id="downloadFrm" style="display:none;"></iframe>
            </div>
        </div>
    </div>

</body>

</html>