<?php
include '../connect.php';

session_start();
if (!isset($_SESSION['loggedIn'])) {
    header("Location: login.php");
    exit();
}
$idA = $_SESSION['idA'];
$pic = $_SESSION['pic'];

if (isset($_FILES['upload'])) {
    $img_data = file_get_contents($_FILES['upload']['tmp_name']);
    $sqlimg = "update admin set pic = 0x" . bin2hex($img_data) . " where idA = '$idA'";
    if (mysqli_query($conn, $sqlimg)) {
        $_SESSION['pic'] = $img_data;
        exit('yes');
    } else {
        exit('no');
    }
}

if (isset($_POST['newpass'])) {
    $newpass = $_POST['newpass'];
    $sql = "update admin set password = '$newpass' where idA = '$idA'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['password'] = $newpass;
        exit('changed');
    } else {
        exit('not changed');
    }
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
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@400;500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="adminCSS/dashboard.css" />
    <title>Admin | Profile</title>
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
                                <li><a class="dropdown-item" href="#">Edit profile</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid profile p-4 bg-light">
                <div class="row justify-content-center my-3">
                    <h3 class="carouselTitle p-1 my-4">Edit Profile</h3>
                    <div class="col-md-4 text-center">
                        <?php if ($pic != 'none') { ?>
                            <img id="profile" src="data:image;base64, <?= base64_encode($pic) ?>" alt="profile"> <?php } else { ?> <img src="../assets/av0.png" alt=""> <?php } ?>
                        <a id="link" href="" class="link-secondary">
                            <h6 class="mt-4 mb-3"><i class="fa-solid fa-upload me-2"></i>Change profile picture</h6>
                        </a>
                        <form method="POST" id="form" enctype="multipart/form-data">
                            <input type="file" name="upload" accept=".png,.jpg" hidden id="upload">
                            <button type="submit" class="btn " id="changeProfile">save</button>
                        </form>
                        <h4 class="mt-3"><i><?= $_SESSION['username'] ?></i> <small class="text-muted">#0<?= $idA ?></small></h4>
                    </div>
                    <div class="col-md-6 me-2">
                        <h4 class="mt-5 ">Change your password</h4>
                        <div class="content me-5">
                            <input type="text" id="currentpass" hidden value="<?= $_SESSION['password'] ?>">
                            <div class="infos pe-2">
                                <label class="ms-2" for="">Current password<span class="text-danger">*</span></label>
                                <input class="form-control" type="password" name="oldpass" id="oldpass">
                                <p id="errorold" class="text-danger ms-2"></p>
                            </div>
                            <div class="infos pe-2 mt-4">
                                <label class="ms-2" for="">Enter a new password <span class="text-danger">*</span></label>
                                <input class="form-control" type="password" name="newpass" id="newpass">
                                <p id="errornew" class="text-danger ms-2"></p>
                            </div>
                            <div class="infos pe-2 mt-4">
                                <label class="ms-2" for="">Confirm new password <span class="text-danger">*</span></label>
                                <input class="form-control" type="password" name="newconfirm" id="newconfirm">
                                <p id="errorconfirm" class="text-danger ms-2"></p>
                            </div>
                            <button id="save" class="btn btn-dark float-end px-3 mt-3">Change password</button>
                        </div>
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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#changeProfile').hide();
            // MENU TOGGLE 
            var el = document.getElementById("wrapper");
            var toggleButton = document.getElementById("menu-toggle");

            toggleButton.onclick = function() {
                el.classList.toggle("toggled");
            };

            $('#link').click(function(e) {
                e.preventDefault();
                $('#upload').trigger('click');

            })

            $('#upload').change(function(event) {
                var src = URL.createObjectURL(event.target.files[0]);
                $('#profile').attr('src', src);
                $('#changeProfile').show();;
                $('img').css('margin-top', '1rem');
            })

            $('#form').on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "EditProfile.php",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                        if (response == 'yes') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Profile picture updated successfully !',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#changeProfile').hide();;
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed !',
                                html: 'Error occurred while updating your profile picture please try again !',
                                showConfirmButton: false
                            })
                        }
                    }
                });
            }))

            $('#save').click(function() {
                var currentpass = $('#currentpass').val();
                var oldpass = $('#oldpass').val();
                var newpass = $('#newpass').val();
                console.log(currentpass)
                var newconfirm = $('#newconfirm').val();
                var passRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@$!%*?&])[A-Za-z0-9@$!%*?&]{8,16}$");

                if (oldpass != currentpass) {
                    $('#errorold').html('<i class="fa-solid fa-circle-exclamation me-2"></i>Password incorrect !')
                } else {
                    $('#errorold').html('');
                    if (passRegex.test(newpass) == false) {
                        $('#errornew').html('<i class="fa-solid fa-circle-exclamation me-2"></i>Password must contain 1 number 1 uppercase 1 special and minimum 8 characters')
                    } else {
                        $('#errornew').html('');
                        if (newpass != newconfirm) {
                            $('#errorconfirm').html('<i class="fa-solid fa-circle-exclamation me-2"></i>Passwords are not matching !')
                        } else {
                            $('#errorconfirm').html('');
                            $.ajax({
                                type: "POST",
                                url: "EditProfile.php",
                                data: {
                                    newpass: newpass
                                },
                                success: function(response) {
                                    if (response == 'changed') {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Profile updated successfully !',
                                            showConfirmButton: false,
                                            timer: 1500
                                        })
                                        $('input').each(function() {
                                            $(this).val('');
                                        });
                                    } else {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Failed !',
                                            html: 'Error occurred while updating your please try again !',
                                            showConfirmButton: false
                                        })
                                    }
                                }
                            });
                        }
                    }
                }

            })

            // MENU TOGGLE END


        })
    </script>
</body>

</html>