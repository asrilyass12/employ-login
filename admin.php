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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>admin</title>
</head>
<body>
<center>
          <a href="login.php" class="btn btn-primary mt-5">sing-out</a>
              <table class="container table table-bordered w-50 mt-4 text-center">
                <thead>
                  <th>
                    <th class="text-center h3" colspan="6">register table</th>
                  </th>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email</th>
                    <th scope="col">phone</th>
                    <th scope="col">etat</th>
                    <th scope="col">action</th>
                  </tr>
                </thead> 
                <tbody>
                    <?php
                        if(isset($_GET['subsearch'])){
                          $search = $_GET['search'];
                          $sql2 = "SELECT * FROM first_login.register where first_name='". $search ."' or last_name='". $search . "' or phone='". $search . "' or email='". $search ."' or etat='".$search."';";
                        }else{
                          $sql2 = "SELECT * FROM first_login.register";
                        }
                          $result = $conn->query($sql2);
                          $i = 1;
                        while($row = $result->fetch_assoc()){
                          echo "<tr>";
                              echo "<th id=\"tewwst\">" . $i . "</th>";
                              echo "<th>" . $row['first_name'] . "</th>";
                              echo "<th>" . $row['last_name'] . "</th>";
                              echo "<th>" . $row['email'] . "</th>";
                              echo "<th>" . $row['phone'] . "</th>";
                              echo "<th>" . $row['etat'] . "</th>";
                              echo "<td><a class=\"btn btn-danger\" href=\"delete.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>"; 
                              echo "<th>";
                              if($row['etat']=='active'){
                                echo "<div class=\"form-check form-switch\">";
                                echo "<input name=\"ff".$i."\" class=\"form-check-input\" value=\"$row[id]\" type=\"checkbox\" role=\"switch\" id=\"flexSwitchCheckDefault". $i ."\" onclick=\"myFunction($i)\" checked></div>";
                              }else{
                                echo "<div class=\"form-check form-switch\">";
                                echo "<input name=\"ff".$i."\" class=\"form-check-input\" value=\"$row[id]\" type=\"checkbox\" role=\"switch\" onclick=\"myFunction($i)\" id=\"flexSwitchCheckDefault". $i ."\"></div>";
                              }
                                
                            echo "</th>";
                          echo "</tr>";
                          $i++;
                        }
                        
                    ?>
                </tbody>
              </table>
              <form method="post" id="y">
                  <input type="text" id="demo" name="val" style="display: none;">
              </form>
            </center>


            <?php
            if(isset($_POST['val'])){
              $id = $_POST['val'];
              echo $id;          
              $sql = "SELECT * FROM first_login.register WHERE id=$id";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                
                while($row = $result->fetch_assoc()) {
                  $hh = $row["etat"];
                }
              } else {
                echo "0 results";
              }

              $tr = $id;
 
              if($hh == 'desactive'){
                $rek = "UPDATE first_login.register SET etat='active' where id=$tr";         
              }else{
                $rek = "UPDATE first_login.register SET etat='desactive' where id=$tr";         
              }

              $conn->query($rek);
            }

            if (!isset($_SESSION)) {
              session_start();
          }
          
          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              $_SESSION['postdata'] = $_POST;
              unset($_POST);
              header("Location: ".$_SERVER['PHP_SELF']);
              exit;
          }
              $conn->close();
            ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="script.js"></script>
</body>