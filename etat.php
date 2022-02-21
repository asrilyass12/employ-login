<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "first_login";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['val'];


$rek = "UPDATE first_login.register SET etat=";

// header("Location:admin.php")
?>