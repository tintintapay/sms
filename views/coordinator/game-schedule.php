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
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <?php include 'views/common/datatables.php'; ?>
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
                    Game Schedule | <?= $game['game_title']?>
                    <div class="header-action">
                        <button href="game-schedules-create" class="button button-primary button-md delete-game-schedule">Delete</button>
                    </div>
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <div class="text-right">
                            <a href="evaluations?game-id=<?= $game['id'] ?>" class="button button-warning button-xs">Show submission</a>
                        </div>
                        <form action="game-schedule" method="post">
                            <div class="msg" style="display:<?php echo !empty($flash['message']) ? 'block' : 'none' ?>">
                                <?php echo $flash['message'] ?? ''; ?>
                            </div>
                            <div id="targetAthletes">
                                <?php foreach ($athletes as $athlete):?>
                                    <input class="athlete-selected" type="hidden" name="athletes[]" id="athlete-<?= $athlete?>" value="<?= $athlete ?>">
                                    
                                <?php endforeach;?>
                            </div>
                            <input type="hidden" name="id" id="id" value="<?= $game['id']?>">
                            <label for="game_title" class="label">Game Title:</label>
                            <input type="text" class="sms-input text-only" id="game_title" name="game_title"
                                value="<?= $game['game_title']?>" autocomplete="off">

                            <label for="schedule" class="label">Schedule:</label>
                            <input type="date" class="sms-input" id="schedule" name="schedule"
                                value="<?= $game['schedule']?>" min="<?= $game['schedule']?>" autocomplete="off">

                            <label for="sport" class="label">Sport:</label>
                            <select name="sport" id="sport" class="sms-input">
                                <option value="" selected disabled>- Please Select -</option>
                                <?php foreach ($sports as $key => $value): ?>
                                    <option value="<?= $key ?>" <?= $key === $game['sport'] ? 'selected' : ''?>><?= $value ?></option>
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
                                        <th>Email</th>
                                        <th>Phone Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>

                            <button type="submit" class="button buttom-primary">Save</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>