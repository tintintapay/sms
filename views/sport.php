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
    <div class="content">
      <div class="title-container">
        <p><a href="#" onclick="showInfo('Basketball')">Basketball</a></p>
        <p><a href="#" onclick="showInfo('Volleyball')">Volleyball</a></p>
        <p><a href="#" onclick="showInfo('Football/Soccer')">Football/Soccer</a></p>
        <p><a href="#" onclick="showInfo('Badminton')">Badminton</a></p>
        <p><a href="#" onclick="showInfo('Table Tennis')">Table Tennis</a></p>
        <p><a href="#" onclick="showInfo('Athletics')">Athletics</a></p>
        <p><a href="#" onclick="showInfo('Chess')">Chess</a></p>
        <p><a href="#" onclick="showInfo('Taekwondo')">Taekwondo</a></p>
        <p><a href="#" onclick="showInfo('Swimming')">Swimming</a></p>
        <p><a href="#" onclick="showInfo('Sepak Takraw')">Sepak Takraw</a></p>
        <p><a href="#" onclick="showInfo('Softball/Baseball')">Softball/Baseball</a></p>
        <p><a href="#" onclick="showInfo('Arnis')">Arnis</a></p>
        <p><a href="#" onclick="showInfo('Dance Sports')">Dance Sports</a></p>
        <p><a href="#" onclick="showInfo('Pencak Silat')">Pencak Silat</a></p>
        <p><a href="#" onclick="showInfo('Karate')">Karate</a></p>
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