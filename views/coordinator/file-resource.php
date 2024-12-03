<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Resource</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/sms-table.css">
    <script src="../vendor/jquery/jquery-3.7.1.js"></script>
    <script src="../vendor/sweetalert/sweetalert2.js"></script>
    <script src="../assets/js/main.js"></script>
    <script src="../assets/js/file-resource.js"></script>
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
                    File Resource
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        <h3 style="margin: 0px 0px 15px 0px;">Evaluation form and files</h3>
                        <hr>
                        <div class="w-full mb-20">
                            <table class="sms-table">
                                <thead>
                                    <tr>
                                        <th>Downloadable Files</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $count = 1; ?>
                                    <?php foreach ($files as $file): ?>
                                        <tr id="file_<?= $count ?>">
                                            <td>
                                                <a href="/assets/downloadable/<?= $file ?>" target="_blank" class=""
                                                    download="<?= $file ?>"><?= $file ?>
                                                </a>
                                            </td>
                                            <td><a href="javascript:void(0)" class="button button-danger button-sm del-file"
                                                    data-name="<?= $file ?>" data-id="file_<?= $count ?>">Delete</a></td>
                                        </tr>
                                    <?php $count++; ?>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="msg" style="display:<?php echo !empty($flash['message']) ? 'block' : 'none' ?>; width:auto">
                            <?php echo $flash['message'] ?? ''; ?>
                        </div>
                        <form action="file-resource" method="POST" enctype="multipart/form-data">
                            <div style="display: block;">
                                <label class="label"><span style="color:red">*</span>Upload new files</label>
                                <input type="file" class="" name="file" id="file" required>
                            </div>

                            <button type="submit" class="button button-success">Submit</button>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>
</body>

</html>