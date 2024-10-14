<?php require 'views/coordinator/config.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    Dashboard
                </div>
                <hr>
                <div class="section">
                    <div class="card">
                        
                    </div>
                </div>


                <div class="athletes">
                    <h3>Athletes</h3>
                    <div class="filter">
                        <button class="filter-btn">
                            School
                            <img src="../assets/images/1.jpg" alt="Filter Icon" class="filter-icon">
                        </button>
                        <button class="filter-btn">
                            Campus
                            <img src="../assets/images/1.jpg" alt="Filter Icon" class="filter-icon">
                        </button>
                        <button class="filter-btn">
                            Event
                            <img src="../assets/images/1.jpg" alt="Filter Icon" class="filter-icon">
                        </button>
                    </div>
                    <input type="text" class="search-bar" placeholder="Search">
                    <div class="list">List Placeholder</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>