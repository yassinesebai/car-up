<?php
session_start();
if (isset($_SESSION['loggedIn'])) {
    header("Location: dashboard.php");
    exit();
}
include '../connect.php';
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select * from Admin where username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows == 1) {
        $_SESSION['loggedIn'] = 'yes';
        $_SESSION['username'] = $username;
        exit('admin Logged in');
    } else {
        exit("Username or password invalid !");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <!-- jquery link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- poppins font-->
    <link rel="stylesheet" href="adminCSS/login.css">
    <script src="adminJS/login.js"></script>

    <title>Admin | Login</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center login-container">
        <form id="login-form" class="login-form">
            <div class="text-center">
                <img height="48px" src="../assets/carlogo.png" alt="" />
            </div>
            <div class="form-group mt-4">
                <i class="fa-solid fa-user icon"></i>
                <input id="username" type="text" class="form-control rounded-pill form-control-lg" placeholder="Username" />
            </div>
            <div class="form-group">
                <i class="fa-solid fa-lock icon"></i>
                <input id="password" type="password" class="form-control rounded-pill form-control-lg" placeholder="Password" />
            </div>
            <p class="text-danger py-1 pl-1" id="error"></p>
            <button type="submit" class="btn rounded-pill btn-lg btn-custom btn-block text-uppercase">
                Log in
            </button>
        </form>
    </div>
</body>

</html>