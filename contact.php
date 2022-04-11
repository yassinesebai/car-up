<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.html' ?>
    <link rel="stylesheet" href="styles/contact.css">
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse p-md-3 navbar-collapse" id="navbarNav">
            <ul class="ml-md-5 navbar-nav">
                <li class="nav-item active">
                    <a class="ml-lg-5 nav-link" target="_blank" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php#process">How to rent</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Cars</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php#aboutus">About us</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link currentItem" href="contact.php">Contact us</a>
                </li>
            </ul>
        </div>
    </nav>
    <section class="contactForm">
        <div class="container">
            <h1 class="text-center my-5 position-relative lined">Contact Us</h1>
            <div class="row">
                <div class="col-md-6 my-3 text-center"><img class="img-fluid" width="72%" src="assets/contact.svg" alt="">
                </div>
                <div class="col-md-6 my-3 text-center">
                    <form id="contact-form" name="contact-form" action="mail.php" method="POST">

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-3">
                                    <input type="text" id="fname" name="fname" placeholder="First name" required class="form-control">
                                </div>
                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6">
                                <div class="md-form mb-3">
                                    <input type="text" id="lname" name="lname" placeholder="Last name" required class="form-control">
                                </div>
                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-3">
                                    <input type="email" id="email" name="email" placeholder="Email" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="md-form mb-3">
                                    <input type="text" id="subject" name="subject" placeholder="Subject" required class="form-control">
                                </div>
                            </div>
                        </div>
                        <!--Grid row-->

                        <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-12">

                                <div class="md-form">
                                    <textarea type="text" id="message" name="message" rows="5" placeholder="Message" required class="form-control md-textarea"></textarea>
                                </div>

                            </div>
                        </div>
                        <!--Grid row-->
                        <div class="text-center mt-3 text-md-left">
                            <button class="btn btn-outline-danger">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>