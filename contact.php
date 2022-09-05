<?php

use PHPMailer\PHPMailer\PHPMailer;

include('connect.php');
$fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$message = mysqli_real_escape_string($conn, $_POST['message']);

require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = "yassinessebai@gmail.com";
$mail->Password = "lkilo12305";
$mail->Port = 465;
$mail->SMTPSecure = "ssl";

$mail->isHTML(true);
$mail->setFrom($email, $fullname);
$mail->addAddress("yassinessebai@gmail.com");
$mail->Subject = ("Client contacted you !");
$mail->Body = $message;

$sql = "INSERT INTO Contact (fullName, email, message)
   VALUES ('$fullname','$email','$message')";


if ($conn->query($sql) === TRUE) {
    exit("yes");
} else {
    exit("no");
}
