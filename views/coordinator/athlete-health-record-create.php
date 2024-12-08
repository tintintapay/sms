<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athlete's Health Record</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/athlete-health-record-create.js"></script>
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
                    Create Health Record
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <form action="athlete-health-record-create" method="post">
                            <div class="msg" style="display:<?php echo !empty($flash['message']) ? 'block' : 'none' ?>">
                                <?php echo $flash['message'] ?? ''; ?>
                            </div>
                            <input type="hidden" name="athlete_id" id="athlete_id" value="<?= $params['athlete_id']?>">

                            <label for="status" class="label"><span style="color:red">*</span>Health Status:</label>
                            <select name="status" id="status" class="sms-input">
                                <option value="" selected disabled>- Please Select -</option>
                                <?php foreach ($healthStatus as $key => $value): ?>
                                    <option value="<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>"
                                        <?= (isset($request['status']) && $request['status'] === $key) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <label for="remarks" class="label"><span style="color:red">*</span>Remarks:</label>
                            <textarea name="remarks" id="remarks" class="sms-input" rows="5"
                                style="resize: vertical; font-size:1rem;"><?= $request['remarks'] ?? '' ?></textarea>

                            <button type="submit" id="submit" class="button button-success">Save</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>