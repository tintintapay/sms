<?php
$logo = 'assets/images/1.jpg';
?>
<style>
    /* Navigation bar styles */
      .nav {
        position: fixed; /* Fixed position at the top */
        top: 0;
        left: 0;
        width: 100%; /* Full width */
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px; /* Add some space around the navigation bar */
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
        backdrop-filter: blur(10px); /* Apply blur effect */
        z-index: 1000; /* Ensure it's above other content */
      }
  
      .nav .logo {
        display: inline-block;
        margin-right: 20px;
        border: 1px solid #fff; /* White border */
        border-radius: 50%;
        padding: 5px;
        width: 40px;
        height: 40px;
      }
  
      .nav .logo img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
      }
  
      .nav a {
        text-decoration: none;
        color: #fff; /* White text */
        font-weight: bold;
        margin: 0 10px; /* Add some space between the navigation links */
        padding: 0 10px; /* Add 10px padding to the left and right sides of the link text */
      }
  
      .nav a:hover {
        color: #007bff; /* Hover color */
      }
</style>
<div class="nav">
    <div class="logo"><img src="<?php echo $logo; ?>" alt="Logo"></div>
    <a href="index">Home</a>
    <a href="about">About</a>
    <a href="sport">Sport</a>
    <a href="contact">Contact</a>
    <a href="help">Help</a>
    <div class="logo"><img src="<?php echo $logo; ?>" alt="Logo"></div>
</div>