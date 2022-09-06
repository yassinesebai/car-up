<?php
include '../connect.php';

session_start();
if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['plateNum'])) {
    $plateNum = $_POST['plateNum'];
    $delete = "delete from car where plateNum = '$plateNum'";
    mysqli_query($conn, $delete);
}
if (isset($_POST['add'])) {
    $plate = $_POST['plate'];
    $modelName = $_POST['modelName'];
    $year = $_POST['year'];
    $fuel = $_POST['fuel'];
    $gearbox = $_POST['gearbox'];
    $km = $_POST['km'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $ac = $_POST['ac'];
    $color = $_POST['color'];
    $pic = file_get_contents($_FILES['pic']['tmp_name']);
    $addCar = "insert into car (plateNum, modelName, modelYear, fuel, boite, km, price, idB, ac, color, pic) values ('$plate',
    '$modelName','$year','$fuel','$gearbox','$km','$price','$brand','$ac','$color',0x" . bin2hex($pic) . ")";
    mysqli_query($conn, $addCar);
}
if (isset($_POST['edit'])) {
    $plate = $_POST['plate'];
    $modelName = $_POST['modelName'];
    $year = $_POST['year'];
    $fuel = $_POST['fuel'];
    $gearbox = $_POST['gearbox'];
    $km = $_POST['km'];
    $price = $_POST['price'];
    $brand = $_POST['brand'];
    $ac = $_POST['ac'];
    $color = $_POST['color'];
    $editCar = "update car set modelName = '$modelName', modelYear = '$year', fuel = '$fuel', boite = '$gearbox',
    km = '$km', price = '$price', idB = '$brand', ac = '$ac', color = '$color' where plateNum = '$plate'";
    mysqli_query($conn, $editCar);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../assets/favicon.png" sizes="192x192" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@400;500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="adminCSS/dashboard.css" />

    <!-- DATA TABLES -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.css" />
    <title>Admin Dashboard</title>
</head>

<body>

    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase"><a href="../"><img height="40px" src="../assets/carlogo.png" alt=""></a></div>
            <div class="list-group list-group-flush my-3">
                <a href="dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-project-diagram me-2"></i>Dashboard</a>
                <?php if ($_SESSION['isDirector'] == 1) { ?>
                    <a href="admins.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-user-gear me-2"></i>Admins</a>
                <?php } ?>
                <a href="brands.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-copyright me-2"></i>Brands</a>
                <a href="cars.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i class="fa-solid fa-car-rear me-2"></i>Cars</a>
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
                <div class="row my-3">
                    <h3 class="carouselTitle p-1 my-4">Cars</h3>
                    <div class="col">
                        <table width="100%" class="table mytable bg-white rounded shadow-sm  mt-4 table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th id="id" scope="col" width="150">Plate no.</th>
                                    <th scope="col">Model</th>
                                    <th scope="col">fuel</th>
                                    <th scope="col">gearbox</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Avail.</th>
                                    <th scope="col">A/C</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="tableBody">
                                <!-- display.php loads data here  -->
                            </tbody>
                        </table>
                        <!-- Button trigger modal -->
                        <div class="d-flex"> <button type="button" class="btn px-4 py-2 add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add a car
                            </button>
                            <form method="POST" action="toExcel.php">
                                <input type="text" name="car" value="yes" hidden>
                                <button type="submit" class="btn btn-success px-4 ms-3 py-2">Download Excel</button>
                            </form>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-plus ms-1"></i>Add a new car</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <p id="error" class="text-danger text-center px-1 pt-2"></p>
                                                <div class="row mt-4 mx-2">
                                                    <div class="col-4">
                                                        <label>Plate no. <span class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control mt-2" id="plate" name="plate">
                                                    </div>
                                                    <div class="col-8">
                                                        <label>Model Name <span class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control mt-2" id="modelName" name="modelName">
                                                    </div>
                                                </div>
                                                <div class="row mt-4 mx-2">
                                                    <div class="col-4">
                                                        <label>Gearbox <span class="text-danger">*</span></label>
                                                        <select name="gearbox" class="form-select mt-2" id="gearbox">
                                                            <option disabled selected value> -- select -- </option>
                                                            <option value="Manual">Manual</option>
                                                            <option value="Automatic">Automatic</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Km <span class="text-danger">*</span></label>
                                                        <input required type="number" class="form-control mt-2" id="km" name="km">
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Year <span class="text-danger">*</span></label>
                                                        <input required type="number" min="2000" max="2022" class="form-control mt-2" id="year" name="year">
                                                    </div>
                                                </div>
                                                <div class="row mt-4 mx-2">
                                                    <div class="col-4">
                                                        <label>Fuel <span class="text-danger">*</span></label>
                                                        <select name="fuel" class="form-select mt-2" id="fuel">
                                                            <option disabled selected value> -- select -- </option>
                                                            <option value="diesel">Diesel</option>
                                                            <option value="gasoline">Gasoline</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-4">
                                                        <label>Price <span class="text-danger">*</span></label>
                                                        <input required type="number" class="form-control mt-2" id="price" name="price">
                                                    </div>
                                                    <div class="col-4">
                                                        <label>AC <span class="text-danger">*</span></label>
                                                        <select name="ac" class="form-select mt-2" id="ac">
                                                            <option disabled selected value> -- select -- </option>
                                                            <option value="1">Yes</option>
                                                            <option value="0">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mt-4 mx-2">
                                                    <div class="col-6">
                                                        <label>Brand <span class="text-danger">*</span></label>
                                                        <select name="brand" id="brand" class="form-select mt-2">
                                                            <option disabled selected value> -- select -- </option>
                                                            <?php
                                                            $query = "select * from brand";
                                                            $res = mysqli_query($conn, $query);
                                                            while ($row = mysqli_fetch_array($res)) {
                                                                echo '<option value = ' . $row['idB'] . '>' . $row['nameB'] . '';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label>Color <span class="text-danger">*</span></label>
                                                        <input required type="text" class="form-control mt-2" id="color" name="color">
                                                    </div>
                                                </div>
                                                <div class="row mt-4 mx-2">
                                                    <label>Picture <span class="text-danger">*</span></label>
                                                    <input type="file" class="form-control mt-2" style="width: 95%;" id="pic" name="pic" accept="image/png, image/jpeg, image/jpg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="add" class="btn btn-primary" id="add">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title titleev" id="exampleModalLabel"><i class="fa-solid fa-pen-to-square ms-1"></i>Edit a car</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="editForm" method="POST">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="row mt-4 mx-2">
                                                            <img id="img" style="object-fit: contain;" class="img-fluid" src="" alt="">
                                                        </div>
                                                        <div class="row mt-4 mx-2 pp">
                                                            <label>Picture <span class="text-danger">*</span></label>
                                                            <input type="file" class="form-control mt-2" style="width: 95%;" id="pic" name="pic" accept="image/png, image/jpeg, image/jpg">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">


                                                        <p id="error" class="text-danger text-center px-1 pt-2"></p>
                                                        <div class="row mt-4 mx-2">
                                                            <div class="col-4">
                                                                <label>Plate no. <span class="text-danger">*</span></label>
                                                                <input required type="text" class="form-control mt-2" id="plateEdit" name="plate">
                                                            </div>
                                                            <div class="col-8">
                                                                <label>Model Name <span class="text-danger">*</span></label>
                                                                <input required type="text" class="form-control mt-2" id="modelNameE" name="modelName">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4 mx-2">
                                                            <div class="col-4">
                                                                <label>Gearbox <span class="text-danger">*</span></label>
                                                                <select name="gearbox" class="form-select mt-2" id="gearboxE">
                                                                    <option disabled selected value> -- select -- </option>
                                                                    <option value="Manual">Manual</option>
                                                                    <option value="Automatic">Automatic</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-4">
                                                                <label>Km <span class="text-danger">*</span></label>
                                                                <input required type="number" class="form-control mt-2" id="kmE" name="km">
                                                            </div>
                                                            <div class="col-4">
                                                                <label>Year <span class="text-danger">*</span></label>
                                                                <input required type="number" min="2000" max="2022" class="form-control mt-2" id="yearE" name="year">
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4 mx-2">
                                                            <div class="col-4">
                                                                <label>Fuel <span class="text-danger">*</span></label>
                                                                <select name="fuel" class="form-select mt-2" id="fuelE">
                                                                    <option disabled selected value> -- select -- </option>
                                                                    <option value="diesel">Diesel</option>
                                                                    <option value="gasoline">Gasoline</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-4">
                                                                <label>Price <span class="text-danger">*</span></label>
                                                                <input required type="number" class="form-control mt-2" id="priceE" name="price">
                                                            </div>
                                                            <div class="col-4">
                                                                <label>AC <span class="text-danger">*</span></label>
                                                                <select name="ac" class="form-select mt-2" id="acE">
                                                                    <option disabled selected value> -- select -- </option>
                                                                    <option value="1">Yes</option>
                                                                    <option value="0">No</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-4 mx-2">
                                                            <div class="col-6">
                                                                <label>Brand <span class="text-danger">*</span></label>
                                                                <select name="brand" id="brandE" class="form-select mt-2">
                                                                    <option disabled selected value> -- select -- </option>
                                                                    <?php
                                                                    $query = "select * from brand";
                                                                    $res = mysqli_query($conn, $query);
                                                                    while ($row = mysqli_fetch_array($res)) {
                                                                        echo '<option value = ' . $row['idB'] . '>' . $row['nameB'] . '';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <label>Color <span class="text-danger">*</span></label>
                                                                <input required type="text" class="form-control mt-2" id="colorE" name="color">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" name="edit" class="btn btn-primary" id="Edit">Edit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- <button class="btn px-4 py-2" type="button" data-toggle="modal" data-target="#exampleModal">Add a brand</button> -->
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
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.5/datatables.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {

            displayTable();


            // MENU TOGGLE 
            var el = document.getElementById("wrapper");
            var toggleButton = document.getElementById("menu-toggle");

            toggleButton.onclick = function() {
                el.classList.toggle("toggled");
            };
            // MENU TOGGLE END

            $('#add').click(function(e) {
                // if ($('#plate').val() == '' || $('#modelName').val() == '' || $('#year').val() == '' || ) {
                //     e.preventDefault();
                //     $('#error').html('<i class="fa-solid fa-circle-exclamation px-1"></i> Enter a name please !');
                // }
            })


        });

        // FUNCTIONS
        function displayTable() {
            $.ajax({
                type: "POST",
                url: "display.php",
                data: {
                    action: 'car'
                },
                success: function(response) {
                    $('.tableBody').html(response);
                    $('.mytable').DataTable({
                        scrollX: true,
                    });
                }
            });
        }

        function deleteCar(id) {
            var plateNum = id;
            $.ajax({
                type: "POST",
                url: "cars.php",
                data: {
                    plateNum: plateNum
                },
                success: function(res) {
                    displayTable();
                }
            });
        };

        function ViewEditCar(plateNum, str) {
            $('#EditModal').modal('toggle');
            $('#plateEdit').val(plateNum);
            $('#plateEdit').attr('readonly', true);
            var action = "viewCar";
            $.ajax({
                type: "POST",
                url: "display.php",
                data: {
                    action: action,
                    plateNum: plateNum
                },
                success: function(response) {
                    $('form').find('select,input').each(function() {
                        $(this).attr('disabled', false);
                    })
                    var js = JSON.parse(response);
                    $('#modelNameE').val(js.modelName);
                    $('#gearboxE').val(js.boite);
                    $('#kmE').val(js.km);
                    $('#yearE').val(js.modelYear);
                    $('#fuelE').val(js.fuel);
                    $('#priceE').val(js.price);
                    $('#acE').val(js.ac);
                    $('#brandE').val(js.idB);
                    $('#colorE').val(js.color);
                    $('#img').attr("src", "data:image;base64, " + js.pic + "");
                    if (str == 'view') {
                        $('#editForm').find('select,input').each(function() {
                            $(this).attr('disabled', true);
                            $('.titleev').html('<i class="fa-solid fa-eye ms-1"></i>Car details');
                            $('#Edit').hide();
                            $('.pp').remove();
                        })
                    } else {
                        $('#editForm').find('select,input').each(function() {
                            $(this).attr('disabled', false);
                            $('.titleev').html('<i class="fa-solid fa-pen-to-square ms-1"></i>Edit a car');
                            $('#Edit').show();
                        })
                    }
                }
            });
        }


        $('#Edit').click(function() {
            var plate = $('#plate').val();
            var nameEdit = $('#nameEdit').val();
            $.ajax({
                type: "POST",
                url: "cars.php",
                data: {
                    plate: plate,
                    nameEdit: nameEdit
                },
                success: function(response) {
                    displayTable();
                    $('#EditModal').modal('toggle');
                }
            });
        })

        // FUNCTIONS

        // TO PREVENT SUBMIT AFTER EVERY REFRSH
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>