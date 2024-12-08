<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement | Create</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/main.js"></script>
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
                    Create Announcements
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <form action="announcements-create" method="post">
                            <label for="title" class="label"><span style="color:red">*</span>Title:</label>
                            <input type="text" class="sms-input" id="title" name="title"
                                value="<?= $request['title'] ?? '' ?>" autocomplete="off" required>
                            
                            <label for="description" class="label"><span style="color:red">*</span>Description:</label>
                            <textarea name="description" id="description" class="sms-input" rows="5" style="resize: vertical;" required></textarea>
                        
                            <button type="submit" class="button button-success">Save</button>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>