
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ClassFinder</title>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap"
      rel="stylesheet"/>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

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
            <a href="../login/register.php">Sign Up</a>
        </div>
      </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero section start -->
    <section class="hero" id="home">
      <main class="content">
        <h1>Welcome to Class<span>Finder</span></h1>
        <p>Find and book rooms for your activities with ease.</p>
        <div class="cta-login">
          <a href="../login/login.php">Login</a>
        </div>
      </main>
    </section>
    <!-- Hero section end -->

    <!-- About section start -->
    <section id="about" class="about">
      <h2>About Us</h2>
      <div class="row">
        <div class="about-img">
          <img src="../img/class.jpg" alt="Tentang Kami">
        </div>
        <div class="content">
          <h3>What is ClassFinder?</h3>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iure dolor non voluptatum explicabo laboriosam excepturi.</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas voluptatem corrupti sed maiores saepe. Earum veniam facere repudiandae exercitationem possimus.</p>
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
    <!-- Feather Icons -->
    <!-- <script>
      feather.replace();
    </script> -->

    <!-- js -->
    <script src="js/script.js"></script>
  </body>
</html>
