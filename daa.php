<?php

session_start();
$user = $_SESSION['users'];

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

if(isset($_POST['submitBtn'])) { //form submission occured

    if(isset($_POST['switch-1'])){                       
        $sql = "UPDATE first_login.register SET etat = 'checked' WHERE first_name = '$user'";
    } else {
        $sql = "UPDATE first_login.register SET etat = 'no' WHERE first_name = '$user'";
    }

    if ($conn->query($sql)) {
        echo "Updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else {
    echo "Form Submission Error";
}

$conn->close();
?>