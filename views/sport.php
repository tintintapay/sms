<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/main.css">
  <link rel="stylesheet" href="assets/css/login.css">
  <link rel="stylesheet" href="assets/css/sport.css">
  <title>Sportsd info</title>
</head>

<body>
  <?php include_once 'common/nav.php'; ?>
  <div class="background-image"></div>
  <div class="dark-overlay"></div>
  <div class="container">
    <div class="container">
      <div class="content">
        <div class="title-container">
          <p><img src="basketball_icon.png" alt="Basketball Icon"><a href="#"
              onclick="showInfo('Basketball')">Basketball</a></p>
          <p><img src="soccer_icon.png" alt="Soccer Icon"><a href="#" onclick="showInfo('Soccer')">Soccer</a></p>
          <p><img src="tennis_icon.png" alt="Tennis Icon"><a href="#" onclick="showInfo('Tennis')">Tennis</a></p>
          <p><img src="baseball_icon.png" alt="Baseball Icon"><a href="#" onclick="showInfo('Baseball')">Baseball</a>
          </p>
          <p><img src="swimming_icon.png" alt="Swimming Icon"><a href="#" onclick="showInfo('Swimming')">Swimming</a>
          </p>
        </div>
      </div>
    </div>

    <div class="popup" id="popup">
      <div class="popup-content">
        <h2 id="popup-title"></h2>
        <p id="popup-message"></p>
        <button onclick="closePopup()">Close</button>
      </div>
    </div>

    <script src="assets/js/sport.js"></script>
  </div>
</body>

</html>