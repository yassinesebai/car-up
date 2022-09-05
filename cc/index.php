<?php
include 'includes/config.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    $sql = "select * from admin where username = '$username' and password = '$pass'";
    $results = mysqli_query($conn, $sql);
    if (mysqli_num_rows($results) > 0) {
        $_SESSION['alogin'] = $_POST['username'];
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Admin not found !');</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/index.css">
    <title>Document</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center login-container">
        <form method="POST" class="login-form text-center">
            <h1 class="mb-5 font-weight-light text-uppercase">Login</h1>
            <div class="form-group">
                <input type="text" required name="username" class="form-control rounded-pill form-control-lg" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="password" required name="pass" class="form-control rounded-pill form-control-lg" placeholder="Password">
            </div>
            <p id="error" class="text-danger"></p>
            <button name="login" type="submit" class="btn rounded-pill btn-lg btn-custom btn-block text-uppercase">Log in</button>
        </form>
    </div>
</body>

</html>