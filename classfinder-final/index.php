<!-- LANDING PAGE -->

<?php
session_start();
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ClassFinder</title>

  <!-- Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <!-- Navbar Start -->
  <nav class="navbar">
    <a href="#" class="navbar-logo">Class<span>Finder</span></a>

    <div class="navbar-nav">
      <a href="#home">Home</a>
      <a href="#about">About</a>
      <a href="#contact">Contact</a>
      <div class="cta-signup">
        <?php if ($_SESSION['role'] == 'admin') { ?>
          <a href="admin/dashboard.php">My Account</a>
        <?php } else if ($_SESSION['role'] == 'user') { ?>
          <a href="./map">My Account</a>
        <?php } else { ?>
          <a href="login/register.php">Sign Up</a>
        <?php } ?>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->

  <!-- Hero section start -->
  <section class="hero" id="home">
    <main class="content">
      <h1>Welcome to Class<span>Finder</span></h1>
      <p>Find and book rooms for your activities with ease.</p>
      <?php if (empty($_SESSION['role'])) { ?>
        <div class="cta-login">
          <a href="login/login.php">Login</a>
        </div>
      <?php } ?>
    </main>
  </section>
  <!-- Hero section end -->

  <!-- About section start -->
  <section id="about" class="about">
    <h2>About Us</h2>
    <div class="row">
      <div class="about-img">
        <img src="img/class.jpg" alt="Tentang Kami">
      </div>
      <div class="content">
        <h3>What is ClassFinder?</h3>
        <p>ClassFinder is a web application that was formed as an idea to make it easier for UNNES students, especially students majoring in Electrical Engineering, to find lecture rooms more efficiently because it can be done with one tap and can be done several days in advance. So, when students are scheduled to study, they no longer need to look for an empty room which can cut into their study time.</p>
      </div>
    </div>
    <div class="member-content">
      <h3>Our Members</h3>
      <div class="content">
        <div class="member">
          <img src="img/roja.jpg" alt="Choirur Roja Siwi">
          <p><b>Choirur Roja Siwi</b><br>5302422004</p>
        </div>
        <div class="member">
          <img src="img/fiza.jpg" alt="Lutfiza Fajri Afriliyani">
          <p><b>Lutfiza Fajri Afriliyani</b><br>5302422020</p>
        </div>
        <div class="member">
          <img src="img/umam2.jpg" alt="Khoirul Umam">
          <p><b>Khoirul Umam</b><br>530242030</p>
        </div>
        <div class="member">
          <img src="img/dyas.jpg" alt="Dyas Aulia Darmawan">
          <p><b>Dyas Aulia Darmawan</b><br>530242068</p>
        </div>
      </div>
    </div>
  </section>
  <!-- About section end -->

  <!-- contact section start -->
  <section id="contact" class="contact">
    <h2>Contact Us</h2>
    <div class="container">
      <form>
        <div class="input-container">
          <label for="first-name">First Name</label>
          <input type="text" id="first-name" name="first-name" required>
        </div>
        <div class="input-container">
          <label for="last-name">Last Name</label>
          <input type="text" id="last-name" name="last-name" required>
        </div>
        <div class="input-container">
          <label for="email">E-Mail</label>
          <input type="email" id="email" name="email" required>
        </div>
        <div class="input-container">
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit">SEND</button>
      </form>
    </div>
  </section>
  <!-- contact section end -->
  <!-- js -->
  <script src="js/script.js"></script>
</body>

</html>