<?php require 'views/admin/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/announcement.js"></script>
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
                    Update Announcement
                    <div class="header-action">
                        <button class="button button-danger button-md delete-announcement">Delete</>
                    </div>
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <form action="announcements-create" method="post">
                            <input type="hidden" name="id" id="id" value="<?= $request['id']?>">
                            <label for="title" class="label">Title:</label>
                            <input type="text" class="sms-input text-only" id="title" name="title"
                                value="<?= $request['title'] ?? '' ?>" autocomplete="off" required>
                            
                            <label for="description" class="label">Description:</label>
                            <textarea name="description" id="description" class="sms-input" rows="5" style="resize: vertical;" required><?= $request['description'] ?? '' ?></textarea>
                        
                            <button type="submit" class="button button-success">Save</button>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>