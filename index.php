<?php
session_start();
include("model/Database.php");
$database = new Database();
$conn = $database->GetConnection();

if (isset($_SESSION['utilizator'])) {
  $logged_user = $_SESSION['utilizator'];
  $sql = "SELECT admin from users where id = '$logged_user'";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $isAdmin = $row['admin'];
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="style.css">

  <script>
    $(document).ready(function() {
      $(".spinner-wrapper").delay(500).fadeOut("slow");
      $(window).scrollTop(1);
    });
  </script>

  <title>Proiect 5</title>
</head>

<body>

  <div class="spinner-wrapper">
    <div class="spinner-border text-primary" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>


  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
      <a class="navbar-brand me-auto" href="#">Logo</a>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active mx-lg-2 active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#carouselExampleCaptions">About</a>
            </li>
            <li class="nav-item">
              <?php

              if (isset($_SESSION['utilizator'])) {
                echo '<a class="nav-link mx-lg-2" href="view_users.php">Users</a>';
              } else {
                echo '<a class="nav-link mx-lg-2" href="login.php">Users</a>';
              }

              ?>

            </li>
            <?php
            if (isset($_SESSION['utilizator'])) {
              if ($isAdmin) {
                echo '<li class="nav-item">
                          <a class="nav-link mx-lg-2" href="departments_update.php">Departments</a>
                        </li>';
              }
            }

            ?>
            <li class="nav-item">
              <a class="nav-link mx-lg-2" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>

      <?php

      if (isset($_SESSION['utilizator'])) {
        echo '<a href="logout.php" class="login-button">Log Out</a>';
      } else {
        echo '<a href="login.php" class="login-button">Login</a>';
      }

      ?>


      <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>

  <section class="hero-section">
    <div class="container d-flex align-items-center justify-content-center fs-1 text-white flex-column">

      <?php

      if (isset($_SESSION['username'])) {
        echo '<h1>Welcome ' . $_SESSION['username'] . '</h1>';
      } else {
        echo '<h1 class="mb-3">Welcome to our website!</h1>';
        echo "<h5>You don't have an account yet?</h5>";
        echo '<a href="registration_form.php" class="login-button" id="make-account-button">Make account</a>';
      }

      ?>

    </div>
  </section>



  <div id="carouselExampleCaptions" class="carousel slide">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/img_buna.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          <h5>Sales Department</h5>
          <p>Driving business growth through strategic client relationships and sales excellence.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/img_buna1.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          <h5>Communication Department</h5>
          <p>Crafting clear, impactful messages to connect and engage with our audience.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/img_buna2.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption">
          <h5>IT Department</h5>
          <p>Ensuring seamless technology operations and support to drive innovation and efficiency.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>

</html>