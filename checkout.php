<?php
include('connect.php');
if (isset($_POST['plate'])) {
    $currentCar = $_POST['plate'];
    $sql = "select * from car join brand on car.idB = brand.idB where plateNum = '$currentCar'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $pic = $row['pic'];
}
//below function returns all the dates within a given range
function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d')
{ //if it was simple y example y-m-d then it will show 17 instead of 2017

    $dates = array();
    $current = strtotime($first);
    $last = strtotime($last);

    while ($current <= $last) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    } //end of while loop

    return $dates; //returns a array
} //end of function
//select all the  date ranges that exist in the database 
$query = "SELECT startDate, endDate FROM bookingbeta where plateNum = '$currentCar' and isConfirmed = 1";

$result = mysqli_query($conn, $query);

$i = 0;
$range = new ArrayObject();
while ($r = mysqli_fetch_assoc($result)) {
    //output all the dates within the ranges in the database
    $range[$i] = date_range($r['startDate'], $r['endDate']); //creates a associative array with numerical index values
    $i++;
}

$individual_dates = array();

//converts the associative array  into a regular array
foreach ($range as $ranges) {
    foreach ($ranges as $many_ranges) {
        $individual_dates[] = $many_ranges;
    }
}


$json_array = json_encode($individual_dates);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="assets/favicon.png" sizes="192x192" />

    <!-- css/Bootstrap links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="styles/home.css" />
    <link rel="stylesheet" href="styles/checkout.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>

    <!-- jquery link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <!-- sweetalert -->
    <script src=" //cdn.jsdelivr.net/npm/sweetalert2@11">
    </script>

    <!-- Google fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@400;500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="styles/cars.css">

    <title>Cars</title>
</head>

<body class="bg-light">
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse p-md-3 navbar-collapse" id="navbarNav">
            <ul class="ml-md-5 navbar-nav">
                <li class="nav-item active">
                    <a class="ml-lg-5 nav-link navbarlink" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link navbarlink" href="index.php#process">How to rent</a>
                </li>
                <li class="nav-item active">
                    <a class="currentItem nav-link navbarlink" href="cars.php">Cars</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link navbarlink" href="index.php#aboutus">About us</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link navbarlink" href="index.php#contactus">Contact us</a>
                </li>
            </ul>
        </div>
    </nav>
    <header>
        <div class="row flex-column text-light">
            <h1 class="mt-5 pt-4 position-relative text-center">Checkout</h1>
        </div>
    </header>
    <section class="bg-light">
        <!--For Row containing all card-->
        <div class="row mainRow">
            <!--Card 1-->
            <div class="col-md-7">
                <div class="card card-cascade wider shadow p-3 mb-5 ">
                    <p class="headingCar"><strong><i class="fa-solid fa-car-rear pr-2"></i> <?= $row['nameB'] . " " . $row['modelName'] ?></strong></p>
                    <!--Card image-->
                    <div class="text-center"> <img id="carimg" class="img-fluid" src="data:image;base64, <?= base64_encode($pic) ?>" alt="car"> </div>
                    <!--Product Description-->
                    <div class="desc p-2 p-md-0">
                        <!-- 1st Row for title-->
                        <div class="row subRow">
                            <!--Column for Data-->
                            <div class="col">
                                <p class="text-muted row1">Milage</p>
                                <p class="row2"><?= $row['km'] ?> km</p>
                            </div>
                            <!--Column for Data-->
                            <div class="col">
                                <p class="text-muted row1">Transmission</p>
                                <p class="row2"><?= $row['boite'] ?></p>
                            </div>
                            <!--Column for Data-->
                            <div class="col">
                                <p class="text-muted row1">Year</p>
                                <p class="row2"><?= $row['modelYear'] ?></p>
                            </div>
                        </div> <!-- 2nd Row for title-->
                        <div class="row subRow">
                            <!--Column for Data-->
                            <div class="col">
                                <p class="text-muted row1">Fuel</p>
                                <p class="row2"><?= $row['fuel'] ?></p>
                            </div>
                            <!--Column for Data-->
                            <div class="col">
                                <p class="text-muted row1">Color</p>
                                <p class="row2"><?= $row['color'] ?></p>
                            </div>
                            <!--Column for Data-->
                            <div class="col">
                                <p class="text-muted row1">Price</p>
                                <p class="row2"><span id="price"><?php echo $row['price']; ?></span> DH</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Card 2-->
            <div class="col-md-5">
                <form action="congrats.php" method="POST">
                    <div class="card card-cascade card-ecommerce first wider shadow p-3">
                        <!--Card Body-->
                        <div class="card-body card-body-cascade">
                            <!--Card Description-->
                            <div class="card2decs">
                                <p class="heading1"><strong><i class="fa-solid fa-envelope pr-2"></i> BOOKING INFOS</strong></p>
                                <input type="text" name="plateNum" style="display: none;" value="<?= $currentCar ?>">
                                <p class="lightText pt-4 pb-1">First name <span class="text-danger">*</span><input required name="fname" class="float-lg-right" type="text" placeholder="First name"></p>
                                <p class="lightText py-1">Last name <span class="text-danger">*</span><input required name="lname" class="float-lg-right" type="text" placeholder="Last name"></p>
                                <p class="lightText py-1">Email address <span class="text-danger">*</span> <input required name="email" class="float-lg-right" type="email" placeholder="main@example.com"></p>
                                <p class="lightText py-1">Phone number <span class="text-danger">*</span> <input required name="phone" class="float-lg-right" type="tel" placeholder="e.g. 99-999-999"></p>
                                <p class="lightText py-1">Full Adress <span class="text-danger">*</span> <textarea required name="address" class="float-lg-right" placeholder="Street address" rows="2"></textarea></p>
                                <div class="px-3 d-lg-flex pt-lg-4 pb-lg-2 justify-content-between align-items-center">
                                    <div class="d-flex px-lg-3 flex-column">
                                        <p class="lightText py-2">Start date <span class="text-danger">*</span></p>
                                        <input name="startDate" class="text-muted" id="startDate" type="date" required>
                                    </div>
                                    <div class="mt-5 d-none d-lg-block" id="line"></div>
                                    <div class="d-flex px-lg-4 flex-column">
                                        <p class="lightText py-2">End date <span class="text-danger">*</span></p>
                                        <input name="endDate" class="text-muted" id="endDate" type="date" required>
                                    </div>
                                </div>
                                <p class="text-danger mt-4 mb-0 px-lg-4" style="visibility: hidden;" id="error"><i class="fa-solid fa-circle-exclamation px-2"></i>Please enter a valid date !</p>
                            </div>
                        </div>
                    </div>
                    <div class="card card-cascade card-ecommerce second wider shadow py-4 px-3">
                        <!--Card Body-->
                        <div class="card-body card-body-cascade">
                            <!--Card Description-->
                            <div class="card2decs">
                                <p class="lightText">Details<span class="float-right text1"><span id="numDays">0</span> x <?= $row['price'] ?> DH</span></p>
                                <p class="total"><strong>Total</strong><span class="float-right totalText1">= <span id="totalPrice" class="totalText2">0,00 DH</span></span></p>
                            </div>
                        </div>
                        <button name="booking" type="submit" id="bookNow" class="my-2 mt-3 p-2 btn btn-danger" disabled>Book Now <i class=" pl-2 fa-solid fa-angle-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php include "footer/index.html"; ?>
    <script>
        $(document).ready(function() {
            var today = new Date().toISOString().substring(0, 10)
            $('#startDate').val(today);

            function checkOut() {
                var start = new Date($('#startDate').val());
                var end = new Date($('#endDate').val());
                var error = $('#error');
                var price = $('#price').html();
                if (start < end) {
                    var diff = end - start;
                    var days = diff / (1000 * 3600 * 24);
                    $('#numDays').html(days + " Days");
                    $('#totalPrice').html(price * days + " DH");
                    error.css('visibility', 'hidden');
                    $('#bookNow').removeAttr('disabled');
                } else {
                    if ($("#endDate").datepicker("getDate") !== null) {
                        error.css('visibility', 'visible');
                        $('#bookNow').attr('disabled', true);
                        $('#numDays').html("0");
                        $('#totalPrice').html("0.00");
                    }
                }
            }
            $('#reset').click(function() {
                $('#startDate').val(today);
                $('#endDate').val('');
            })
            var dateToday = new Date(); //creating new date obj. used to disable dates before today used in minDate: dateToday
            $("#startDate").datepicker({
                minDate: dateToday,
                dateFormat: 'yy-mm-dd',
                beforeShowDay: checkAvailability,
                onSelect: function(mydate) {
                    checkOut();
                }

            });

            $("#endDate").datepicker({
                minDate: dateToday,
                dateFormat: 'yy-mm-dd',
                beforeShowDay: checkAvailability,
                onSelect: function(mydate) {
                    checkOut();
                }
            });

            /******************THE json array returned by php is used here*****/
            var $disabledDates = <?php echo $json_array; ?>

            function checkAvailability(mydate) {
                var $return = true;
                var $returnclass = "available";
                $checkdate = $.datepicker.formatDate('yy-mm-dd', mydate);
                for (var i = 0; i < $disabledDates.length; i++) {
                    if ($disabledDates[i] == $checkdate) {
                        $return = false;
                        $returnclass = "unavailable";
                    }
                }
                return [$return, $returnclass];
            }
        });
    </script>
</body>

</html>