<?php
include('connect.php');
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 6;
$start = ($page - 1) * $limit;

$res = $conn->query("select count(*) as id from car");
$count = $res->fetch_all(MYSQLI_ASSOC);
$totalCount = $count[0]['id'];
$numPages = ceil($totalCount / $limit);

$next = $page + 1;
$prev = $page - 1;
$carsQuery = "select * from car join brand where car.idB = brand.idB LIMIT $start, $limit";



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css/Bootstrap links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles/home.css" />
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
                    <a class="currentItem nav-link navbarlink" href="#">Cars</a>
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
            <h1 class="mt-5 pt-4 position-relative text-center">Car Listings</h1>
        </div>
    </header>
    <section class="main mb-3 mt-5">
        <div class="row">
            <div class="col-xl-3 py-4 bg-light">
                <form class="form-inline mb-4 search">
                    <input class="form-control mr-2 px-3" id="search" type="search" placeholder="Search..." aria-label="Search">
                    <p class="btn btn-danger px-3 my-2 my-sm-0 item">Go</p>
                </form>
                <div class="filters">
                    <p class="bg-dark text-light filterTitle px-3 py-2">Filters</p>
                    <div class="price pb-2 pt-3 d-flex flex-column pl-2">
                        <b class="py-2">
                            <span>Price range :</span>
                        </b>
                        <div class="d-flex justify-content-between py-2">
                            <label class="px-2 pt-1" for="min">From </label><input placeholder="min DH" type="text" id="min">
                            <label class="px-2 pt-1" for="max">To </label><input placeholder="max DH" type="text" id="max">
                            <button class="btn ml-2 item">Find</button>
                        </div>
                    </div>
                    <div class="brand py-2 d-flex flex-column pl-2">
                        <b class="py-2">
                            <span>Select brands :</span>
                        </b>
                        <?php
                        $result = mysqli_query($conn, "select * from Brand");
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<div class='form-check'>
                            <label class='form-check-label py-1 text-muted px-2'>
                                <input type='checkbox' class='form-check-input item brand' value='" . $row['nameB'] . "' >" . $row['nameB'] . "
                            </label>
                        </div>";
                        }
                        ?>
                    </div>
                    <div class="fuel py-2 d-flex flex-column pl-2">
                        <b class="py-2">
                            <span>Select Fuel :</span>
                        </b>
                        <?php
                        $result = mysqli_query($conn, "select DISTINCT fuel from car");
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<div class='form-check'>
                                <label class='form-check-label py-1 text-muted px-2'>
                                    <input type='checkbox' class='form-check-input item fuel' value='" . $row['fuel'] . "' >" . $row['fuel'] . "
                                </label>
                            </div>";
                        }
                        ?>
                    </div>
                    <div class="boite py-2 d-flex flex-column pl-2">
                        <b class="py-2">
                            <span>Select gearbox :</span>
                        </b>
                        <?php
                        $result = mysqli_query($conn, "select DISTINCT boite from car");
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<div class='form-check'>
                            <label class='form-check-label py-1 text-muted px-2'>
                                <input type='checkbox' class='form-check-input item gearbox' value='" . $row['boite'] . "' >" . $row['boite'] . "
                            </label>
                        </div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-xl-9">
                <p class="found p-3">Cars found <span class="float-right">Sort price : &nbsp; <select name="order" id="order">
                            <option value="none">--none--</option>
                            <option value="ASC">Ascending</option>
                            <option value="DESC">Descending</option>
                        </select></span></p>
                <div class="row cart m-0 pl-2" id="result">
                    <!-- ------ getting cars from the database ------ -->
                    <?php
                    $result = mysqli_query($conn, $carsQuery);
                    while ($row = mysqli_fetch_array($result)) {
                        $hasAC = "No";
                        $disp = '<div class="disp text-white bg-success text-center">Available</div>';
                        if ($row['ac'] == 1) {
                            $hasAC = "Yes";
                        }
                        if ($row['dispo'] == 0) {
                            $disp = '<div class="disp text-white bg-danger text-center">Rented !</div>';
                        }
                        echo  '<div class="col-xl-4 px-2 p-0 col-md-6 my-2">
                            <div class="card carItem " style="width:100%; height:100%">
                                <img width=100% class="img-s img-fluid" src="data:image;base64, ' . base64_encode($row['pic']) . '">
                                ' . $disp . '
                                <div class="text-center mt-4">
                                    <h4>' . $row['nameB'], " ", $row['modelName'] . '</h4>
                                    <p class="text-muted"><i>Model ' . $row['modelYear'] . '</i></p>
                                    <div class="d-flex px-3 justify-content-between">
                                        <p><img class="iconCar px-1" src="assets/fuel.png" alt=""> ' . $row['fuel'] . '</p>
                                        <p><img class="iconCar px-1" src="assets/ac.png" alt=""> ' . $hasAC . '</p>
                                        <p><img class="iconCar px-1" src="assets/gearbox.png" alt=""> ' . $row['boite'] . '</p>
                                    </div>  
                                </div>
                                <div class="text-center">
                                    <h6><b>' . $row['price'] . ' DH </b><small class="text-muted"> / per day</small></h6>
                                    <form method="post" action="checkout.php">
                                    <input type="text" value= "' . $row['plateNum'] . '"name="plate" style="display: none;">
                                    <a href="checkout.php"><button type="submit" class="btn">Book it</button></a>
                                    </form>
                                    </div>
                            </div>
                        </div>';
                    } ?>
                    <!-- ------ getting cars from the database ------ -->
                </div>

                <img src="" alt="">

                <!-- BLOB picture fetching  -->

                <!-- BLOB picture fetching  -->


                <nav aria-label="Page navigation example">
                    <ul class="pagination mt-5 justify-content-center">
                        <li class="page-item  <?php echo $page == 1 ? 'disabled' : ''; ?>">
                            <a class="page-link" href="cars.php?page=<?= $prev ?>" tabindex="-1"><small>
                                    << Prev</small></a>
                        </li>

                        <?php for ($i = 1; $i <= $numPages; $i++) : ?>
                            <li class="page-item px-1"><a class="page-link" href="cars.php?page=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php endfor ?>
                        <li class="page-item <?php echo $page == $numPages ? 'disabled' : ''; ?>">
                            <a class="page-link" href="cars.php?page=<?= $next ?>"><small>Next >></small></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <?php include "footer/index.html"; ?>
    <script src="js/cars.js"></script>
</body>

</html>