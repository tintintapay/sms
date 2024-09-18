<?php require 'views/coordinator/config.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/css/admin_profile.css">
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="profile">
                <div class="profile-pic">
                    <img src="<?php echo "../assets/uploads/docs/{$_SESSION['user_id']}/{$_SESSION['picture']}" ?>" alt="User Icon"
                        class="profile-pic">
                </div>
                <div class="profile-info">
                    <h2><?php echo $_SESSION['full_name']?></h2>
                    <p><?php echo $_SESSION['role']; ?></p>
                </div>
            </div>
            <a href="../logout" class="signout-btn">Signout</a>
        </div>
        <div class="main-content">
            <div class="left-panel">
                <h3 class="section-title">Coordinator</h3>
                <div class="filter">
                    <button class="filter-btn">
                        <img src="../assets/images/1.jpg" alt="Filter Icon" class="filter-icon">
                        School
                    </button>
                    <button class="filter-btn">
                        <img src="../assets/images/1.jpg" alt="Filter Icon" class="filter-icon">
                        Campus
                    </button>
                </div>
                <h4 class="list-title">List of Coordinator</h4>
                <div class="coordinator-list">
                    <div class="coordinator-item">
                        <span class="coordinator-name">John Doe</span>
                        <button class="view-btn">VIEW</button>
                    </div>
                    <div class="coordinator-item">
                        <span class="coordinator-name">Jane Smith</span>
                        <button class="view-btn">VIEW</button>
                    </div>
                    <div class="coordinator-item">
                        <span class="coordinator-name">Alice Johnson</span>
                        <button class="view-btn">VIEW</button>
                    </div>
                    <button class="add-btn" onclick="window.location.href='addcoor.html'">+</button>
                </div>
            </div>            
            <div class="right-panel">
                <div class="analytics">
                    <button class="update-btn">Update</button>
                    <canvas id="myChart"></canvas>
                    <button class="print-btn">PRINT</button>
                </div>
                <div class="athletes">
                    <h3>Athletes</h3>
                    <div class="filter">
                        <button class="filter-btn">
                            School
                            <img src="../assets/image/filter-icon.png" alt="Filter Icon" class="filter-icon">
                        </button>
                        <button class="filter-btn">
                            Campus
                            <img src="../assets/image/filter-icon.png" alt="Filter Icon" class="filter-icon">
                        </button>
                        <button class="filter-btn">
                            Event
                            <img src="../assets/image/filter-icon.png" alt="Filter Icon" class="filter-icon">
                        </button>
                    </div>
                    <input type="text" class="search-bar" placeholder="Search">
                    <div class="list">List Placeholder</div>
                </div>                
            </div>
        </div>
    </div>
    <script src="../assets/js/admin_profile.js"></script>
</body>
</html>