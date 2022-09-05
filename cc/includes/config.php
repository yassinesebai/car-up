<?php


// Create connection
global $conn;
$conn = new mysqli("localhost", "root", "", "location");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
