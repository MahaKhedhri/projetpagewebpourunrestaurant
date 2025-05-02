<?php
// Connect to database
$conn = mysqli_connect("localhost", "root", "", "throughtheages");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$message = "";
$messageClass = "success"; // default

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check which form was submitted
  if (isset($_POST['reservation'])) {
    // Reservation form submitted
    $name = mysqli_real_escape_string($conn, $_POST['name'] ?? '');
    $phone = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');
    $people = mysqli_real_escape_string($conn, $_POST['people'] ?? '');
    $date = mysqli_real_escape_string($conn, $_POST['date'] ?? '');
    $time = mysqli_real_escape_string($conn, $_POST['time'] ?? '');
    $messageInput = mysqli_real_escape_string($conn, $_POST['message'] ?? '');

    if (empty($name) || empty($phone) || empty($people) || empty($date) || empty($time)) {
      $message = "All fields except message are required.";
      $messageClass = "error";
    } else {
      $sql = "INSERT INTO reservations (name, phone, people, date, time, message) 
                    VALUES ('$name', '$phone', '$people', '$date', '$time', '$messageInput')";
      if (mysqli_query($conn, $sql)) {
        $message = "Reservation successfully submitted!";
        $messageClass = "success";
      } else {
        $message = "Failed to submit reservation. Please try again.";
        $messageClass = "error";
      }
    }
  } elseif (isset($_POST['contact'])) {
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname'] ?? '');
    $email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $msg = mysqli_real_escape_string($conn, $_POST['msg'] ?? '');

    if (empty($fullname) || empty($email) || empty($msg)) {
      $message = "All fields are required.";
      $messageClass = "error";
    } else {
      $sql = "INSERT INTO contact (name, email, message) 
                    VALUES ('$fullname', '$email', '$msg')";
      if (mysqli_query($conn, $sql)) {
        $message = "Message successfully submitted!";
        $messageClass = "success";
      } else {
        $message = "Failed to submit message. Please try again.";
        $messageClass = "error";
      }
    }
  }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Through the ages</title>
  <link rel="stylesheet" href="stylecss/style.css">
  <script src="js/src.js"></script>
  <script src="js/src2.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>

  <!-- navigation bar  -->
  <nav>
    <ul>
      <li><a href="#home">Home</a></li>
      <li><a href="#menu">Menu</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#reservation">Reservation</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </nav>


  <main class="main">

    <!-- Home page -->
    <section class="section" id="home">
      <p id="name">Through the ages</p>
      <p id="intro">Step into a timeless journey of flavors, where every dish tells a story from the past to the
        present. <br>Welcome to <em>Through the Ages</em>—where history meets taste.</p>
    </section>
    <!-- Home page -->


    <!-- Offer page -->
    <section class="offer-section" id="offer">
      <div class="column section-1">
        <div class="image-wrapper breakfast-wrapper">
          <div class="background-image breakfast-bg"></div>
          <img src="images/service-1.jpg" alt="Breakfast Image 1">
        </div>
        <p class="section-text breakfast-text">Breakfast</p>

      </div>

      <div class="column section-2">
        <h2 class="column2-title">We Offer Top Notch</h2>
        <div class="image-wrapper">
          <div class="background-image"></div>
          <img src="images/service-2.jpg" alt="Appetizer Image">
        </div>
        <p class="section-text Appetizer-text">Appetizer</p>
      </div>

      <div class="column section-3">
        <div class="image-wrapper drink-wrapper">
          <div class="background-image drink-bg"></div>
          <img src="images/service-3.jpg" alt="Drink Image 1">
        </div>
        <p class="section-text drink-text">Cocktail</p>
      </div>
    </section>
    <!-- Offer page -->


    <!-- Menu page -->
    <section class="section" id="menu">
      <div class="menu-buttons">
        <button class="active" data-menu="salad">Salad</button>
        <button data-menu="pasta">Pasta</button>
        <button data-menu="main-course">Main Course</button>
        <button data-menu="desserts">Desserts</button>
        <button data-menu="specials">Specials</button>
      </div>
      <div class="menu-container">
        <ul class="menu-list" id="menu-list">

        </ul>
        <div class="image-container" id="image-container">

        </div>
      </div>
    </section>
    <!-- Menu page -->




    <!-- About page -->
    <section class="section about text-center" aria-labelledby="about-label" id="about">
      <div class="container">
        <div class="about-content">
          <h2 class="about-section-title">Through the ages</h2>
          <p class="about-section-text">Through the years, our fine dining Italian restaurant has reimagined tradition
            with
            elegance and innovation. Blending timeless recipes with modern artistry, we create exquisite dishes that
            honor Italy’s rich culinary heritage while offering a refined, contemporary experience.</p>
        </div>

        <div class="about-banner">
          <img src="images/about-banner.jpg" width="570" height="570" loading="lazy" alt="about banner" class="w-100"
            data-parallax-item data-parallax-speed="1">
          <div class="abs-img abs-img-1 has-before" data-parallax-item data-parallax-speed="1.75">
            <img src="images/about-abs-image.jpg" width="285" height="285" loading="lazy" alt="" class="w-100">
          </div>
          <div class="abs-img abs-img-2 has-before">
            <img src="images/badge-2.png" width="133" height="134" loading="lazy" alt="">
          </div>
        </div>
      </div>
    </section>
    <!-- About page -->



    <!-- Review page -->
    <section class="review-section">
      <div class="quote-container">
        <blockquote>
          "A true taste of Italy right in the heart of the city. The pasta was perfectly al dente, and the flavors of
          the sauce were rich and authentic. The atmosphere was cozy and inviting, and the service made us feel like
          family."
        </blockquote>
        <cite>Maria Rossi, August 17, 2024</cite>
      </div>
    </section>
    <!-- Review page -->



    <!-- Reservation page -->
    <div class="reservation-container" id="reservation">
      <div class="left-side">
        <h2>Online Reservation</h2>
        <p>Booking request <a href="tel:+21629332336">+21629332336</a> or fill out the form</p>
        <?php
        if (!empty($message)) {
          $messageType = isset($messageType) ? $messageType : 'success';
          echo "<div class='notification $messageType'>$message</div>";
        }
        ?><br>
        <form name="reservationForm" class="reservation-form" onsubmit="return validateForm()" method="POST" action="">
          <input type="hidden" name="reservation" value="1">
          <div class="form-row">
            <input type="text" id="name" name="name" placeholder="Your Name">
            <input type="text" id="phone" name="phone" placeholder="Phone Number">
          </div>
          <div class="form-row">
            <select name="people" id="people">
              <option value="">Select People</option>
              <option>1 Person</option>
              <option>2 People</option>
              <option>3 People</option>
            </select>
            <input type="date" id="date" name="date">
            <input type="time" id="time" name="time">
          </div>
          <textarea name="message" placeholder="Message"></textarea>
          <button type="submit">BOOK A TABLE</button>
        </form>

      </div>
      <div class="right-side">
        <img src="images/img-pattern.svg" alt="Description of image">
      </div>
    </div>
    <!-- Reservation page -->



    <!-- Void page -->
    <section class="strength">
    </section>
    <!-- Void page -->



    <!-- Social media page -->
    <section class="social-wall">
      <h2 class="social-title">Our social media wall</h2>
      <div class="gallery-container">
        <button class="scroll-btn left" onclick="scrollGallery('left')">&#8592;</button>
        <div class="gallery">
          <img src="images/social1.webp" alt="Image 1">
          <img src="images/social2.webp" alt="Image 2">
          <img src="images/social3.webp" alt="Image 3">
          <img src="images/social4.webp" alt="Image 4">
          <img src="images/social5.webp" alt="Image 5">
          <img src="images/social6.webp" alt="Image 6">
          <img src="images/social7.webp" alt="Image 7">
          <img src="images/social8.webp" alt="Image 8">
          <img src="images/social9.webp" alt="Image 9">
          <img src="images/social10.webp" alt="Image 10">
          <img src="images/social11.webp" alt="Image 11">
          <img src="images/social12.webp" alt="Image 12">
        </div>
        <button class="scroll-btn right" onclick="scrollGallery('right')">&#8594;</button>
      </div>
    </section>
    <!-- Social media page -->


    <!-- Contact page -->
    <section class="section" id="contact">
      <div class="social">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-dribbble"></i></a>
        <a href="#"><i class="fab fa-behance"></i></a>
      </div>
      <div class="contact-box">
        <div class="c-heading">
          <h1>Get In Touch</h1>
          <p>Call Or Email Us Regarding Question Or Issues</p>
        </div>
        <div class="c-inputs">
          <?php
          if (!empty($message)) {
            $messageType = isset($messageType) ? $messageType : 'success'; // Default success
            echo "<div class='notification $messageType'>$message</div>";
          }
          ?><br>
          <form method="POST" action="">
            <input type="hidden" name="contact" value="1">
            <input type="text" name="fullname" placeholder="Full Name" />
            <input type="email" name="email" placeholder="Example@gmail.com" />
            <textarea name="msg" placeholder="Write Message"></textarea>
            <button type="submit">SEND</button>
          </form>

        </div>
      </div>
      <div class="map">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2354.125941478146!2d13.959683799999997!3d40.7321239!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x133b6adf99930f99%3A0xe8e71f67c3ca38fe!2sRistorante%20Al%20Pontile!5e1!3m2!1sen!2stn!4v1743893008732!5m2!1sen!2stn"
          width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </section>
    <!-- Contact page -->
  </main>
</body>

</html>