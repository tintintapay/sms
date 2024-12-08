<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Event</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <?php include 'views/common/datatables.php'; ?>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/game-schedules.js"></script>
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
                    Game Event
                    <div class="header-action">
                        <a href="game-schedules-create" class="button button-success button-md">Add</a>
                    </div>
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <div class="card-title">Advance Search</div>
                        <form>
                            <label for="sport" class="label">Sport</label>
                            <select name="sport" id="sport" class="sms-input">
                                <option value="">All</option>
                                <?php foreach ($sports as $key => $val): ?>
                                    <option value="<?= $key ?>" <?= isset($_GET['sport']) && $_GET['sport'] === $key ? 'selected' : '' ?>><?= $val ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

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
                                    <th>Title</th>
                                    <th>Venue</th>
                                    <th>Schedule</th>
                                    <th>Sport</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $index = 1; ?>
                                <?php foreach ($gameScheds as $gameSched): ?>
                                    <tr class="<?= $gameSched['status'] ?>">
                                        <td><?= $index ?></td>
                                        <td><?= $gameSched['game_title'] ?></td>
                                        <td><?= $gameSched['venue'] ?></td>
                                        <td><?= $gameSched['schedule'] ?></td>
                                        <td><?= Sport::getDescription($gameSched['sport']) ?></td>
                                        <td><?= $gameSched['status'] ?></td>
                                        <td>
                                            <a href="game-schedule?id=<?= $gameSched['id'] ?>"
                                                class="button button-primary button-xs">View</a>
                                        </td>
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