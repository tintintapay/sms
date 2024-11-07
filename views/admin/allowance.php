<?php require 'views/admin/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allowance</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <?php include 'views/common/datatables.php'; ?>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/allowance.js"></script>
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
                    Allowance
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <form id="send_allowance_notice">
                            <label for="msg" class="label">Message</label>
                            <textarea name="msg" id="msg" class="sms-input" rows="5"
                                style="resize: vertical; font-size:1.2rem;font-family: Arial, sans-serif;">Your allowance is now available for collection at the accounting department. Please ensure that you claim it within the next 5 days to avoid any inconvenience.</textarea>
                            <button type="submit" id="submit" class="button button-success">Send Notice</button>
                        </form>
                    </div>
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <div class="card-title">Advance Search</div>
                        <form action="allowance">

                            <label for="school" class="label">Campus</label>
                            <select name="school" id="school" class="sms-input">
                                <option value="">All</option>
                                <?php foreach ($schools as $key => $val): ?>
                                    <option value="<?= $key ?>" <?= isset($_GET['school']) && $_GET['school'] === $key ? 'selected' : '' ?>><?= $val ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <label for="sport" class="label">Sport</label>
                            <select name="sport" id="sport" class="sms-input">
                                <option value="">All</option>
                                <?php foreach ($sports as $key => $val): ?>
                                    <option value="<?= $key ?>" <?= isset($_GET['sport']) && $_GET['sport'] === $key ? 'selected' : '' ?>>
                                        <?= $val ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <label for="status" class="label">Status</label>
                            <select name="status" id="status" class="sms-input">
                                <option value="">All</option>
                                <option value="<?= AllowanceStatus::NOT_YET_CLAIMED ?>" <?= isset($_GET['status']) && $_GET['status'] === AllowanceStatus::NOT_YET_CLAIMED ? 'selected' : '' ?>>
                                    Not yet claimed</option>
                                <option value="<?= AllowanceStatus::CLAIMED ?>" <?= isset($_GET['status']) && $_GET['status'] === AllowanceStatus::CLAIMED ? 'selected' : '' ?>>
                                    Claimed</option>
                            </select>

                            <label for="date_from" class="label">Date From</label>
                            <input type="date" class="sms-input" name="date_from" id="date_from">

                            <label for="date_to" class="label">Date To</label>
                            <input type="date" class="sms-input" name="date_to" id="date_to">


                            <button type="submit" class="button button-success">Search</button>
                        </form>
                    </div>
                </div>
                <div class="section">
                    <div class="card">
                        <table id="myTable" style="display:none">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Athlete</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 1; ?>
                                <?php foreach ($allowances as $allowance): ?>
                                    <tr>
                                        <td><?= $index; ?></td>
                                        <td>
                                            <?= Helper::athleteWithHealthStatus($allowance['athlete_id'], $allowance['full_name']) ?>
                                        </td>
                                        <td><?= $allowance['phone_number'] ?></td>
                                        <td><?= $allowance['email'] ?></td>
                                        <td><?= AllowanceStatus::getDescription($allowance['status']) ?></td>
                                        <td><?= $allowance['created_at'] ?></td>
                                    </tr>
                                    <?php $index++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>