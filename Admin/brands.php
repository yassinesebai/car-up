<?php
include '../connect.php';

session_start();
if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['brandId'])) {
    $brandId = $_POST['brandId'];
    $delete = "delete from brand where idB = $brandId";
    mysqli_query($conn, $delete);
}
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $addBrand = "insert into brand (nameB) values ('$name')";
    mysqli_query($conn, $addBrand);
}
if (isset($_POST['nameEdit'])) {
    $nameEdit = $_POST['nameEdit'];
    $idBEdit = $_POST['idBEdit'];
    $editBrand = "update brand set nameB = '$nameEdit' where idB = '$idBEdit'";
    mysqli_query($conn, $editBrand);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                <a href="brands.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold active"><i class="fa-solid fa-copyright me-2"></i>Brands</a>
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
                <div class="row my-3">
                    <h3 class="carouselTitle p-1 my-4">Brands</h3>
                    <div class="col">
                        <table width="100%" class="table mytable bg-white rounded shadow-sm  mt-4 table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th id="id" scope="col" width="150">#</th>
                                    <th scope="col">Brand name</th>
                                    <th scope="col" id="action" width="250">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="tableBody">
                                <!-- display.php loads data here  -->
                            </tbody>
                        </table>
                        <!-- Button trigger modal -->
                        <div class="d-flex"> <button type="button" class="btn px-4 py-2 add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add a brand
                            </button>
                            <form method="POST" action="toExcel.php">
                                <input type="text" name="brand" value="yes" hidden>
                                <button type="submit" class="btn btn-success px-4 ms-3 py-2">Download Excel</button>
                            </form>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-plus ms-1"></i>Add a new brand</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleFormControlInput1">Brand name <span class="text-danger">*</span></label>
                                                <input required type="text" class="form-control mt-2" id="name" name="name" placeholder="Eg. Mercedes">
                                                <p id="error" class="text-danger px-1 pt-2"></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary" id="add">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-pen-to-square ms-1"></i>Edit a brand</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Brand ID</label>
                                            <input required type="text" class="form-control mt-2 mb-3" id="idBEdit" name="idBEdit">
                                            <label for="exampleFormControlInput1">Brand name <span class="text-danger">*</span></label>
                                            <input required type="text" class="form-control mt-2" id="nameEdit" name="nameEdit" placeholder="Eg. Mercedes">
                                            <p id="error" class="text-danger px-1 pt-2"></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary" id="Edit">Edit</button>
                                    </div>
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
                if ($('#name').val() == '') {
                    e.preventDefault();
                    $('#error').html('<i class="fa-solid fa-circle-exclamation px-1"></i> Enter a name please !');
                }
            })


        });

        // FUNCTIONS
        function displayTable() {
            $.ajax({
                type: "POST",
                url: "display.php",
                data: {
                    action: 'brand'
                },
                success: function(response) {
                    $('.tableBody').html(response);
                    $('.mytable').DataTable({
                        scrollX: true,
                    });
                }
            });
        }

        function deleteB(id) {
            var brandId = id;
            $.ajax({
                type: "POST",
                url: "brands.php",
                data: {
                    brandId: brandId
                },
                success: function(res) {
                    displayTable();
                }
            });
        };

        function editB(id) {
            $('#EditModal').modal('toggle');
            $('#idBEdit').val(id);
            $('#idBEdit').attr('disabled', true);
        }
        $('#Edit').click(function() {
            var idBEdit = $('#idBEdit').val();
            var nameEdit = $('#nameEdit').val();
            $.ajax({
                type: "POST",
                url: "brands.php",
                data: {
                    idBEdit: idBEdit,
                    nameEdit: nameEdit
                },
                success: function(response) {
                    displayTable();
                    $('#EditModal').modal('toggle');
                    $('#action').trigger('click');

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