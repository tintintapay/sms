<?php require 'views/athlete/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/athlete-home.css">
    <link rel="stylesheet" href="../assets/css/sms-table.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <script src="../assets/js/submit-evaluation.js"></script>
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
                    Submit Evaluation
                </div>
                <hr>
                <?php if ($eval['status'] === EvaluationStatus::SUBMITTED): ?>
                <div class="section">
                    <div class="card">
                        <h1>Evaluation already submitted</h1>
                        <input type="hidden" name="game_schedules_id" id="game_schedules_id" value="<?= $gameId ?>">
                    </div>
                </div>
                <?php elseif ($eval['status'] === EvaluationStatus::PENDING):?>
                <div class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="w-full mb-20">
                                <table class="sms-table">
                                    <thead>
                                        <tr>
                                            <th>Downloadable Files</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($files as $file): ?>
                                        <tr>
                                            <td>
                                                <a href="/sms/assets/downloadable/<?= $file?>" target="_blank"
                                                    class="" download="<?= $file?>"><?= $file?>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <form action="submit-evaluation" method="POST" enctype="multipart/form-data">
                                <div class="flex gap-10">
                                    <div class="w-full">
                                        <input type="hidden" name="game_schedules_id" id="game_schedules_id" value="<?= $gameId ?>">
                                        <input type="hidden" name="athlete_id" value="<?= $_SESSION['user_id'] ?>">

                                        <label class="label">Contract date:</label>
                                        <input type="date" class="sms-input text-only" name="contract_date" id="contract_date" required>

                                        <label class="label">Name:</label>
                                        <input type="text" class="sms-input text-only"
                                            value="<?= $_SESSION['full_name'] ?? '' ?>" readonly>

                                        <label class="label">Email:</label>
                                        <input type="text" class="sms-input"
                                            value="<?= $_SESSION['email'] ?? '' ?>" readonly>

                                        <label for="age" class="label">Age:</label>
                                        <input type="text" class="sms-input num-only" id="age" name="age"
                                            value="<?= $_SESSION['age'] ?? '' ?>" readonly>

                                        <label class="label">Year and Course:</label>
                                        <input type="text" class="sms-input text-only"
                                            value="<?= $_SESSION['year_level'] . ' ' . $_SESSION['course'] ?>" readonly>
                                    </div>
                                    <div class="w-full">
                                        <label class="label">Eligibility Form(3-in-1 form)</label>
                                        <input type="file" class="" name="eligibility_form" id="eligibility_form" required>

                                        <label class="label">Try-out Form</label>
                                        <input type="file" class="" name="tryout_form" id="tryout_form" required>

                                        <label class="label">Medical Certificate</label>
                                        <input type="file" class="" name="med_cert" id="med_cert" required>
                                        
                                        <label class="label">Certification of Registration(COR)</label>
                                        <input type="file" class="" name="cor" id="cor" required>
                                        
                                        <label class="label">Copy of latest grades</label>
                                        <input type="file" class="" name="grades" id="grades" required>
                                    </div>
                                </div>
                                <button type="submit" class="button button-success w-full">Submit</button>
                         </form>
                        </div>

                    </div>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</body>

</html>