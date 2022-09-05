<?php
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

  <!-- css/Bootstrap links -->
  <link rel="stylesheet" href="styles/home.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- jquery link -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>

  <!-- sweetalert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- poppins font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@400;500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.8.0/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.8.0/mapbox-gl.css' rel='stylesheet' />
  <title>Home</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light container">
    <a class="" href="#"><img id="logo" src="assets/carlogo.png" alt="" /></a>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item navbar-text">
        <a class="nav-link" href="mailto:yassinessebai@gmail.com"><img class="navicon" src="assets/env.svg" alt="" /></a>
      </li>
      <li class="nav-item b">
        <a class="nav-link active" href="#">Mail us : <br /><span id="email">info@carrental.com</span></a>
      </li>
      <li class="nav-item navbar-text">
        <a class="nav-link" href="tel=065933818"><img class="navicon" src="assets/phone.svg" alt="" /></a>
      </li>
      <li class="nav-item b">
        <a class="nav-link active" href="#">Call us : <br /><span id="email">+212 659 373 818</span></a>
      </li>
    </ul>
    <ul class="navbar-nav socials ml-auto">
      <a href=""><img class="smicon px-2" src="assets/tw.svg" alt="" /></a>
      <a href=""><img class="smicon px-2" src="assets/fb.svg" alt="" /></a>
      <a href=""><img class="smicon px-2" src="assets/ln.svg" alt="" /></a>
      <a href=""><img class="smicon px-2" src="assets/ig.svg" alt="" /></a>
    </ul>
  </nav>

  <!-- Second navbar  -->
  <nav class="navbar sticky-top navbar-expand-lg navbar-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse p-md-3 navbar-collapse" id="navbarNav">
      <ul class="ml-md-5 navbar-nav">
        <li class="nav-item active">
          <a class="currentItem ml-lg-5 nav-link navbarlink" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link navbarlink" href="#process">How to rent</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link navbarlink" href="cars.php">Cars</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link navbarlink" href="#aboutus">About us</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link navbarlink" href="#contactus">Contact us</a>
        </li>
      </ul>

    </div>
  </nav>


  <button type="button" class="btn btn-danger btn-floating" id="btn-back-to-top">
    <i class="fa-solid fa-arrow-up-long"></i> </button>
  <!-- Header -->
  <div class="row header bg-light">
    <div class="title col-md-6 p-5 d-flex align-items-center">
      <div class="md-container ml-md-5">
        <h2>Search, Book, and enjoy your trip </h2>
        <h1 class="mb-md-4">Find your <span class="text-danger">car</span> and <span class="text-danger">rent</span> it in seconds</h1>
        <h2 class="mb-md-5 desc">Book your car now at car rental ! No hassle , same price , and instant online booking</h2>
        <a href="cars.php"><button class="mr-md-2 booknow btn btn-danger">Book Now ></button></a>
        <button class="learnmore btn btn-danger">Learn more</button>
      </div>
    </div>
    <div class="car col-md-6 d-flex align-items-center">
      <img id="carpic" src="assets/car.png" style="width: 816px !important; height: 432px !important;" alt="">
    </div>
  </div>

  <!-- Disponible line  -->
  <div id="process" class="row bg-success av align-items-center justify-content-center">
    <h3 class="mt-1">20+ cars are available to rent now, <a class="deal" href="cars.php">Get a deal !</a> </h3>
  </div>

  <!-- Process / Booking steps section -->
  <section class="process">
    <div class="container">
      <div class="processTitle">
        <h2 class="text-center smalltext">We offer</h2>
        <h1 class="text-center">a Quick and Easy car rental process</h1>
      </div>
      <div class="row text-center">
        <div class="col-md-4 ">
          <img src="assets/search.png" alt="">
          <h2>1. Find a car</h2>
          <h3 class="text-secondary">Search through car listings, find the one that suits your trip and book in seconds </h3>
        </div>
        <div class="col-md-4 middlestep">
          <img src="assets/operator.png" alt="">
          <h2>2. Answer a phone call</h2>
          <h3 class="text-secondary">we will contact you to confirm the delivery location and paymenet manners</h3>
        </div>
        <div class="col-md-4">
          <img class="mt-3" src="assets/drive.png" alt="">
          <h2>3. Time to drive !</h2>
          <h3 class="text-secondary">Get the car delivered to you, sign some papers, get the keys and enjoy your trip </h3>
        </div>
      </div>
    </div>
  </section>

  <!-- About section -->
  <div id="aboutus"></div>
  <section class="about">
    <div class="container">
      <div class="row">
        <div class="col-md-6 d-md-block d-none">
          <img class="img-fluid" src="assets/about us.svg" alt="">
        </div>
        <div class="col-md-6">
          <div class=" ml-md-5 mx-2 aboutTitle">
            <h1>Car Rental</h1>
            <h2 class="mt-2 mb-4">We help make you enjoy your trips</h2>
            <h3>with over 5+ year of experience, we are a car renting company that offers high quality, comfy and fast vehicules with the best prices <br>
              Because we care about your comfort, all the cars are equipped with an A/C, a GPS tracker and a baby seat if needed </h3>
            <div class="row mt-4">
              <div class="col-4"><img src="assets/numcars.png" alt="">
                <div class="d-flex">
                  <h1 class="counter mt-3 numbos">25</h1>
                  <span class="smallestText">Comfy cars</span>
                </div>
              </div>
              <div class="col-4"><img src="assets/client.png" alt="">
                <div class="d-flex">
                  <h1 class="counter mt-3 numbos">100</h1>
                  <span class="smallestText">Happy clients</span>
                </div>
              </div>
              <div class="mt-3 col-4"><img src="assets/exp.png" alt="">
                <div class="d-flex">
                  <h1 class="counter mt-3 numbos">5</h1>
                  <span class="smallestText">Years of experience</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Logos slider  -->
  <section class="brands">
    <div class="container">
      <h1 class="carouselTitle">Brands we trust</h1>
      <div class="customer-logos slider">
        <img class="slide" src="assets/audi.png" alt="">
        <img class="slide" src="assets/bmw.png" alt="">
        <img class="slide" src="assets/seat.png" alt="">
        <img class="slide" src="assets/renault.png" alt="">
        <img class="slide" src="assets/peugeot.png" alt="">
        <img class="slide" src="assets/vol.png" alt="">
        <img class="slide" src="assets/citroen.png" alt="">
      </div>
    </div>
  </section>

  <div class="review bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-center">
          <h1 class="carouselTitle"><img src="assets/quote.svg" width="45px" alt=""> What our clients say</h1>
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Carousel -->
            <div class="carousel-inner">
              <div class="item carousel-item active">
                <div class="img-box"><img src="https://randomuser.me/api/portraits/men/22.jpg" alt=""></div>
                <h3 class="testimonial text-secondary">“ Great car rentong service ! good prices, comfy cars and amazing customer service i really can't ask for more when renting a car for a vacation ”</h3>
                <p class="overview"><b>Saad tazi</b></p>
              </div>
              <div class="item carousel-item">
                <div class="img-box"><img src="https://randomuser.me/api/portraits/women/61.jpg" alt=""></div>
                <h3 class="testimonial  text-secondary">“ Superior customer service satisfaction ! thanks Car rental for the great experience ”</h3>
                <p class="overview"><b>Samira saidi</b></p>
              </div>
              <div class="item carousel-item">
                <div class="img-box"><img src="https://randomuser.me/api/portraits/men/11.jpg" alt=""></div>
                <h3 class="testimonial  text-secondary">“ Awesome service. Highly recommended ! i needed a car as soon as possible and they got me setup in less than 30 minutes and they also made sure i was happy and comfortable with it ”</h3>
                <p class="overview"><b>Ahmed afkari</b></p>
              </div>
            </div>
            <!-- Carousel Controls -->
            <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
              <i class="bi bi-chevron-compact-left"></i>
            </a>
            <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
              <<i class="bi bi-chevron-compact-right"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="contactus"></div>
  <section class="contactForm pb-5">
    <div class="container">
      <h1 class="carouselTitle">Contact us</h1>
      <div class="row contact">
        <div class="col-md-6 my-4">
          <form id="contact-form" name="contact-form" method="POST">

            <!--Grid row-->
            <div class="row">

              <!--Grid column-->
              <div class="col-md-12">
                <div class="md-form pt-2 mb-3">
                  <label for="fullname">Full Name <span class="text-danger">*</span></label>
                  <input type="text" id="fullname" name="fullname" placeholder="E.g: *Juan Carlos*" required class="form-control">
                </div>
              </div>
              <!--Grid column-->

            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">
              <div class="col-md-12">
                <div class="md-form mb-3 pt-2">
                  <label for="email">Email Address <span class="text-danger">*</span></label>
                  <input type="email" id="email" name="email" placeholder="mail@example.com" required class="form-control">
                </div>
              </div>
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">

              <!--Grid column-->
              <div class="col-md-12">

                <div class="md-form pt-2">
                  <label for="email">Tell me about it <span class="text-danger">*</span></label>
                  <textarea id="message" name="message" rows="5" placeholder="Write here..." required class="form-control md-textarea"></textarea>
                </div>

              </div>
            </div>
            <div id="error" class=" text-danger mt-3"></div>
            <!--Grid row-->
            <div class="text-center mt-2 text-md-left">
              <button type="submit" id="submit" class="btn mt-2">Send Message</button>
            </div>
          </form>
        </div>
        <div class="col-md-6 pt-4 pl-md-5 my-4 col-infos">
          <div id='map'></div>
          <p class="mt-4 ml-2"><img src="assets/add.png" /> <span class="text-secondary"> Rue souhaib roumi CASA</span></p>
          <p class="ml-2"><img src="assets/fix.png" /> <span class="text-secondary"> 05 22 37 38 18</span></p>
          <p class="ml-2"><img src="assets/em.png" /> <span class="text-secondary"> info@carrental.ma</span></p>
        </div>
      </div>
    </div>
  </section>
  <?php include "footer/index.html"; ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <script>
  </script>
  <script src="js/home.js"></script>
</body>

</html>