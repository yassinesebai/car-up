<?php


// Create connection
global $conn;
$conn = new mysqli("eu-cdbr-west-03.cleardb.net", "bff448eb837429", "056af6fd", "heroku_41ea1ab9f8aba65");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
