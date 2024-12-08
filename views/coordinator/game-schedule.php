<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <?php include 'views/common/datatables.php'; ?>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/game-schedule.js"></script>
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
                    Game Event | <?= $game['game_title'] ?>
                    <div class="header-action">
                        <button href="game-schedules-create"
                            class="button button-primary button-md delete-game-schedule">Delete</button>
                    </div>
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <div class="text-right">
                            <a href="evaluations?game-id=<?= $game['id'] ?>"
                                class="button button-warning button-xs">Show submission</a>
                        </div>
                        <form action="game-schedule" method="post" enctype="multipart/form-data">
                            <div class="msg" style="display:<?php echo !empty($flash['message']) ? 'block' : 'none' ?>">
                                <?php echo $flash['message'] ?? ''; ?>
                            </div>
                            <div id="targetAthletes">
                                <?php foreach ($athletes as $athlete): ?>
                                    <input class="athlete-selected" type="hidden" name="athletes[]"
                                        id="athlete-<?= $athlete ?>" value="<?= $athlete ?>">

                                <?php endforeach; ?>
                            </div>
                            <input type="hidden" name="id" id="id" value="<?= $game['id'] ?>">

                            <label for="status" class="label">
                                <input type="checkbox" name="status" id="status"
                                    <?= (($game['status'] === GameStatus::ACTIVE) || ($game['status'] === GameStatus::COMPLETED)) ? 'checked' : '' ?>>
                                Set as Active
                            </label>

                            <label for="game_title" class="label"><span style="color:red">*</span>Title:</label>
                            <input type="text" class="sms-input text-only" id="game_title" name="game_title"
                                value="<?= $game['game_title'] ?>" autocomplete="off">

                            <label for="venue" class="label"><span style="color:red">*</span>Venue:</label>
                            <input type="text" class="sms-input" id="venue" name="venue"
                                value="<?= $game['venue'] ?? '' ?>" autocomplete="off">

                            <label for="schedule" class="label"><span style="color:red">*</span>Schedule:</label>
                            <input type="date" class="sms-input" id="schedule" name="schedule"
                                value="<?= $game['schedule'] ?>" min="<?= $minimumDate ?>" autocomplete="off">

                            <label for="schedule_picture" class="label">Schedule Picture:</label>
                            <input type="file" class="sms-input" id="schedule_picture" name="schedule_picture"
                                accept="image/png, image/jpeg">

                            <label for="sport" class="label"><span style="color:red">*</span>Sport:</label>
                            <select name="sport" id="sport" class="sms-input">
                                <option value="" selected disabled>- Please Select -</option>
                                <?php foreach ($sports as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= $key === $game['sport'] ? 'selected' : '' ?>><?= $value ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <hr>

                            <h3><span style="color:red">*</span>Target Athletes:</h3>
                            <table id="myTable">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Campus</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <?php if ($game['status'] !== GameStatus::COMPLETED): ?>
                                <button type="submit" class="button button-success">Save</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>