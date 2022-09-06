<?php
include '../connect.php';
session_start();
if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
    exit();
}
$counts = "select (select count(plateNum) from car) as 'CARS', (select count(idB) from brand) as 'BRANDS', (select count(idB) from bookingbeta) as 'BOOKINGS', (select count(idMessage) from contact) as 'CONTACTS'";
$listBookings = "SELECT * FROM `bookingbeta` JOIN car ON bookingbeta.plateNum = car.plateNum JOIN brand ON car.idB = brand.idB ORDER BY bookingbeta.idB DESC LIMIT 7";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../assets/favicon.png" sizes="192x192" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@400;500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="adminCSS/dashboard.css" />
    <title>Admin Dashboard</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase"><a href="../"><img height="40px" src="../assets/carlogo.png" alt=""></a></div>
            <div class="list-group list-group-flush my-3">
                <a href="dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i class="fas fa-project-diagram me-2"></i>Dashboard</a>
                <?php if ($_SESSION['isDirector'] == 1) { ?>
                    <a href="admins.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-user-gear me-2"></i>Admins</a>
                <?php } ?>
                <a href="brands.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-copyright me-2"></i>Brands</a>
                <a href="cars.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-car-rear me-2"></i>Cars</a>
                <a href="bookings.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-calendar-check me-2"></i>Bookings</a>
                <a href="contacts.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-envelope-open-text me-2"></i>Contact us</a>
                <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold mt-2"><i class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Dashboard</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?= $_SESSION['username'] ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="editProfile.php">Edit profile</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid p-4 bg-light">
                <div class="row g-3 my-4">
                    <?php $res = mysqli_query($conn, $counts);
                    $num = mysqli_fetch_row($res);
                    ?>
                    <div class="col-md-3">
                        <div class="p-4 bg-white box shadow-sm d-flex justify-content-around align-items-center">
                            <div>
                                <h3 class="fs-2"><?= $num[0] ?></h3>
                                <p class="fs-5">Total Cars</p>
                            </div>
                            <i class="fa-solid fa-car fs-1 border rounded-full p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-4 bg-white box shadow-sm d-flex justify-content-around align-items-center ">
                            <div>
                                <h3 class="fs-2"><?= $num[1] ?></h3>
                                <p class="fs-5">Total Brands</p>
                            </div>
                            <i class="fa-solid fa-gauge-high fs-1 border rounded-full p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-4 bg-white box shadow-sm d-flex justify-content-around align-items-center ">
                            <div>
                                <h3 class="fs-2"><?= $num[2] ?></h3>
                                <p class="fs-5">Total Bookings</p>
                            </div>
                            <i class="fas fa-chart-line fs-1 border rounded-full p-3 p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-4 bg-white box shadow-sm d-flex justify-content-around align-items-center ">
                            <div>
                                <h3 class="fs-2"><?= $num[3] ?></h3>
                                <p class="fs-5">Client messages</p>
                            </div>
                            <i class="fa-solid fa-comments fs-1 border rounded-full p-3 p-3"></i>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <h3 class="carouselTitle p-1 my-4">Recent Bookings</h3>
                    <div class="col">
                        <table class="table mytable bg-white rounded shadow-sm  mt-4 table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th id="id" scope="col" width="100">#</th>
                                    <th scope="col">Client</th>
                                    <th scope="col">Car</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">from</th>
                                    <th scope="col">To</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $result = mysqli_query($conn, $listBookings);
                                while ($row = mysqli_fetch_array($result)) { ?>
                                    <tr>
                                        <th scope="row"><?= $row[0] ?></th>
                                        <td><?= $row['fname'] . " " . $row['lname'] ?></td>
                                        <td><?= $row['nameB'] . " " . $row['modelName'] ?></td>
                                        <td><?= $row['phone'] ?></td>
                                        <td><?= $row['address'] ?></td>
                                        <td><?= $row['startDate'] ?></td>
                                        <td><?= $row['endDate'] ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <footer class="pt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <h3 class="text-center position-relative py-1 text-light mb-5 text-light"><i class="fa-solid fa-caret-right me-2"></i> CAR RENTAL</h3>
                    <div id="lineAfooter"></div>
                    <p class="text-center mb-3"><img src="../assets/soc2.svg" class="me-2 mb-2" height="48px" alt=""> COPYRIGHT &copy; 2022 BY - Yassine Sebai</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>