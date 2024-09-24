<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin_profile.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <?php include 'views/common/datatables.php'; ?>
    <script src="../assets/js/game-schedules-create.js"></script>
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
                    Create Game Schedule
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <form action="game-schedules-create" method="post">
                            <label for="game_title" class="label">Game Title:</label>
                            <input type="text" class="sms-input text-only" id="game_title" name="game_title"
                                value="<?= $request['game_title'] ?? '' ?>" required autocomplete="off">

                            <label for="schedule" class="label">Schedule:</label>
                            <input type="date" class="sms-input" id="schedule" name="schedule"
                                value="<?= $request['schedule'] ?? '' ?>" required autocomplete="off">

                            <label for="sport" class="label">Sport:</label>
                            <select name="sport" id="sport" class="sms-input">
                                <option value="" selected disabled>- Please Select -</option>
                                <?php foreach ($sports as $key => $value): ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="status" class="label">
                                <input type="checkbox" name="status" id="status">
                                Active this after creating
                            </label>
                            
                            <hr>

                            <h3>Target Athletes:</h3>
                            <table id="myTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Sport</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($athletes)): ?>
                                        <?php foreach ($athletes as $athlete): ?>
                                            <tr data-id="<?= $athlete['user_id']?>">
                                                <td></td>
                                                <td><?= $athlete['full_name'] ?></td>
                                                <td><?= $athlete['phone_number'] ?></td>
                                                <td><?= $athlete['sport'] ?></td>
                                                <td>
                                                    <a href="athlete?id=<?= $athlete['user_id'] ?>" class="button button-primary button-xs">View</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td style="text-align: center;">No record...</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>