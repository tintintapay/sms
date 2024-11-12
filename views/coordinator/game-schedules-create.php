<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Event | Create</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../vendor/jquery/datepicker/jquery-ui.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <?php include 'views/common/datatables.php'; ?>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/main.js"></script>
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
                    Create Game Event
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <form action="game-schedules-create" method="post" enctype="multipart/form-data">
                            <div class="msg" style="display:<?php echo !empty($flash['message']) ? 'block' : 'none' ?>">
                                <?php echo $flash['message'] ?? ''; ?>
                            </div>
                            <div id="targetAthletes"></div>

                            <label for="status" class="label">
                                <input type="checkbox" name="status" id="status" <?= isset($request['status']) ? 'checked' : '' ?>>
                                Set as Active
                            </label>

                            <label for="game_title" class="label">Title:</label>
                            <input type="text" class="sms-input text-only" id="game_title" name="game_title"
                                value="<?= $request['game_title'] ?? '' ?>" autocomplete="off">

                            <label for="venue" class="label">Venue:</label>
                            <input type="text" class="sms-input" id="venue" name="venue"
                                value="<?= $request['venue'] ?? '' ?>" autocomplete="off">

                            <label for="schedule" class="label">Schedule:</label>
                            <input type="date" class="sms-input" id="schedule" name="schedule" min="<?= $minimumDate ?>"
                                value="<?= $request['schedule'] ?? '' ?>" autocomplete="off">

                            <label for="schedule_picture" class="label">Schedule Picture:</label>
                            <input type="file" class="sms-input" id="schedule_picture" name="schedule_picture"
                                accept="image/png, image/jpeg">

                            <label for="sport" class="label">Sport:</label>
                            <select name="sport" id="sport" class="sms-input">
                                <option value="" selected disabled>- Please Select -</option>
                                <?php foreach ($sports as $key => $value): ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                <?php endforeach; ?>
                            </select>

                            <hr>

                            <h3>Target Athletes:</h3>
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

                            <button type="submit" class="button button-success">Save</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>