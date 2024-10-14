<?php require 'views/admin/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/admin_profile.css">
    <link rel="stylesheet" href="../assets/css/sms-table.css">
    <link rel="stylesheet" href="../vendor/fontawesome-6.5.1/css/all.min.css">
    <script type="module" src="../assets/js/main.js"></script>
</head>

<body>
    <!-- HEADER -->
    <?php include 'common/header.php'; ?>
    <div class="container">
        <div class="main-content">
            <!-- SIDE NAVIGATION -->
            <?php include 'common/sidenav.php'; ?>

            <div class="right-panel" style="color:black">
                <div class="page-title">
                    Add Coordinator
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <div class="msg" style="display:<?= !empty($flash['message']) ? 'block' : 'none' ?>">
                            <?= $flash['message'] ?? ''; ?>
                        </div>
                        <form action="coordinator-add" method="POST" enctype="multipart/form-data" autocomplete="off">
                            <label class="label" style="margin-bottom:20px">
                                <input type="checkbox" id="status" name="status" <?= ($request['status'] ?? '') === UserStatus::ACTIVE ? 'checked' : '' ?>>
                                Active
                            </label>

                            <label for="first_name" class="label">First Name:</label>
                            <input type="text" class="sms-input text-only" id="first_name" name="first_name"
                                value="<?= $request['first_name'] ?? '' ?>" required autocomplete="off">

                            <label for="middle_name" class="label">Middle Name:</label>
                            <input type="text" class="sms-input text-only" id="middle_name" name="middle_name"
                                value="<?= $request['middle_name'] ?? '' ?>">

                            <label for="last_name" class="label">Last Name:</label>
                            <input type="text" class="sms-input text-only" id="last_name" name="last_name"
                                value="<?= $request['last_name'] ?? '' ?>" required>

                            <label for="address" class="label">Address:</label>
                            <input type="text" class="sms-input no-special-chars" id="address" name="address"
                                value="<?= $request['address'] ?? '' ?>" required autocomplete="off">

                            <label class="label">Gender:
                                <div class="radio-group">
                                    <input type="radio" id="male" name="gender" value="male" <?= ($request['gender'] ?? '') === 'male' ? 'checked' : '' ?> required>
                                    <label for="male">Male</label>

                                    <input type="radio" id="female" name="gender" value="female" <?= ($request['gender'] ?? '') === 'female' ? 'checked' : '' ?>>
                                    <label for="female">Female</label>
                                </div>
                            </label>

                            <label for="age" class="label">Age:</label>
                            <input type="text" class="sms-input num-only" id="age" name="age" maxlength="2"
                                value="<?= $request['age'] ?? '' ?>">

                            <label for="phone_number" class="label">Phone Number:</label>
                            <input type="text" class="sms-input num-only" id="phone_number" name="phone_number"
                                maxlength="11" value="<?= $request['phone_number'] ?? '' ?>">

                            <label for="picture" class="label">Profile Picture:</label>
                            <input type="file" class="file-input" id="picture" name="picture" accept="image/*">

                            <hr>

                            <label for="email" class="label">Email:</label>
                            <input type="email" class="sms-input" id="email" name="email" required
                                value="<?= $request['email'] ?? '' ?>" autocomplete="off">

                            <label for="password" class="label">Password:</label>
                            <input type="password" class="sms-input" id="password" name="password" required>

                            <label for="confirm_password" class="label">Confirm Password:</label>
                            <input type="password" class="sms-input" id="confirm_password" name="confirm_password"
                                required>
                            <br>
                            <button type="submit" class="button button-primary">Save</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>