<?php
require('connect.php');
if (isset($_POST['booking'])) {
    $car = $_POST['plateNum'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];

    $sql = "insert into bookingbeta (`fname`, `lname`, `email`, `phone`, `address`, `plateNum`, `startDate`, `endDate`)
     values ('$fname','$lname','$email','$phone','$address','$car','$startDate','$endDate')";
    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/favicon.png" sizes="192x192" />
    <link rel="stylesheet" href="styles/congrats.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@400;500;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="main-container">
            <div class="check-container">
                <div class="check-background">
                    <svg viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <div class="check-shadow"></div>
            </div>
            <h1 class="pt-2 header text-center"> Booking Successful ! </h1>
            <p class="mt-3 mb-4 text-center"> You will receive a phone call as soon as possible to confirm delivery location and discuss payment options </p>
            <a href="cars.php"> <button class="btn btn-outline-success px-3"><i class="fa-solid fa-angle-left pr-2"></i> Go back to car listings</button>
            </a>
        </div>
    </div>
</body>

</html>