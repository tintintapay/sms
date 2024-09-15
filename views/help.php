<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="assets/css/help.css"> <!-- Link to the external CSS file -->
  <title>Dashboard</title>
</head>
<script src="https://kit.fontawesome.com/1568201145.js" crossorigin="anonymous"></script>

<body>

  <?php include_once 'common/nav.php'; ?>

  <div class="search-box">
    <div class="row">
      <input type="text" id="input-box" placeholder="Search..." autocomplete="off">
      <button class="button"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
    <div class="result-box"></div>
  </div>

  <div class="info-section">
    <p>This is the information section that provides additional details to users. It is styled to have a background color with opacity, covering until the search box.</p>
  </div>

  <script src="assets/js/search.js"></script>

</body>

</html>