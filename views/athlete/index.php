<?php require_once 'views/athlete/config.php'; ?>

<!-- 
TODO: User session
Display of User's name
under name -> sports (EX: Basketball)
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athletes Account</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/athletes_profile.css">
</head>

<body>
    <script async type="text/javascript" src="../assets/js/athletes_profile.js"></script>
    <div class="header">
        <div class="user-info" onclick="toggleDrawer()">
            <img src="<?php echo "../assets/uploads/docs/{$_SESSION['user_id']}/{$_SESSION['picture']}"?>" alt="User Icon" class="user-icon">
            <div>
                <div class="user-name"><?php echo $_SESSION['full_name']; ?></div>
                <div class="user-role" id="userRole"><?php echo $_SESSION['sport']; ?></div>
                <div class="star-rating" id="starRating">
                    <span class="star" onclick="rateStar(1)">&#9733;</span>
                    <span class="star" onclick="rateStar(2)">&#9733;</span>
                    <span class="star" onclick="rateStar(3)">&#9733;</span>
                    <span class="star" onclick="rateStar(4)">&#9733;</span>
                    <span class="star" onclick="rateStar(5)">&#9733;</span>
                </div>
            </div>
        </div>
        <div>
            <div class="allowance" id="allowance" onclick="withdrawAllowance()">Allowance: $100.00</div>
            <button class="button" id="updateAllowanceButton" style="display: none;" onclick="updateAllowance()">Update
                Allowance</button>
        </div>
        <div id="approvalSection" style="display: none;">
            <button class="button" onclick="approve()">Approve</button>
            <button class="button" onclick="reject()">Reject</button>
        </div>
        <div>
            <a href="../logout" class="signout">Sign-out</a>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-title">Announcement</div>
            <!-- TODO: cms to coordinator -->
            <div class="card-content">
                Ladies and gentlemen, esteemed guests, and cherished friends, we gather here today with hearts full of
                anticipation and excitement for a special announcement that promises to fill our future with hope and
                joy. This announcement is not just a mere revelation; it is a testament to our unity, strength, and
                unwavering commitment to a shared vision. As we stand on the cusp of this momentous occasion, let us
                embrace the spirit of collaboration, kindness, and empathy that binds us together as a community. So,
                without further ado, let us open our hearts and minds to the possibilities that lie ahead as we embark
                on this incredible journey together. Thank you for being a part of this unforgettable moment.
            </div>
            <!-- pending by jayze -->
            <button class="button" onclick="applyEvaluation()">Apply Evaluation</button>
            <!-- Ensure this button calls applyEvaluation -->
        </div>
        <div class="card">
            <div class="card-title">Forms</div>
            <!-- TODO: remove Print -> Download button only 
        Remove print button
        Remove Upload button
        file is from coordinator -> selection of uploads | coordinator-logins.html
      -->
            <div class="card-content">
                <input type="file" id="uploadCredential" onchange="validateCredentialUpload()" />
                <button class="button" id="uploadCredentialButton" onclick="uploadCredential()" disabled>Upload
                    Credential</button>
                <select class="listbox" id="credentialFileList" multiple></select>
                <button class="button" onclick="printSelectedFile('credentialFileList')">Print</button>
                <button class="button" onclick="downloadSelectedFile('credentialFileList')">Download</button>
            </div>
        </div>
        <div class="card printable">
            <div class="card-title">Schedule</div>
            <div class="card-content">
                <!-- TODO: dynamic image. uploaded by coordinator -->
                <img id="scheduleImage" src="images/1.jpg" alt="Basketball Schedule" width="100%" height="auto">
                <button class="button" onclick="printSchedule()">Print Schedule</button>
            </div>
        </div>
        <div class="center-wrapper">
            <div class="card">
                <div class="card-title">Credentials</div>
                <!-- 
          TODO: Remove Print and download button
          files from registration documents
          update list once user upload new documents
          img[png, jpg], pdf, docx
        -->
                <div class="card-content">
                    <input type="file" id="uploadCredential" onchange="validateCredentialUpload()" />
                    <button class="button" id="uploadCredentialButton" onclick="uploadCredential()" disabled>Upload
                        Credential</button>
                    <select class="listbox" id="credentialFileList" multiple></select>
                    <button class="button" onclick="printSelectedFile('credentialFileList')">Print</button>
                    <button class="button" onclick="downloadSelectedFile('credentialFileList')">Download</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>