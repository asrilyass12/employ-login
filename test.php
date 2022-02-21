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
//==================================================//


 $email = $_POST['email'];
 $password = $_POST['password'];

 if( $email == "admin@admin.com" && $password == "admin"){
  header("Location: admin.php");
  exit();
 }

 $sql = "SELECT * FROM first_login.register WHERE  email='".$email."' AND password='".$password."'";

 $result = $conn->query($sql);
 
 if($result->num_rows > 0) {
   while($row = $result->fetch_assoc()) {
     header("Location: employ.php");
     exit();
   }
 }else{
    header("Location: login.php");
    exit();
 }

 $conn->close();

?>