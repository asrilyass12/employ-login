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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../public/css/style.css">
    <title>employ</title>
</head>
<body>
  
  <center>
          <a href="login.php" class="btn btn-primary">sing-out</a>
          <button type="button" class="btn btn-primary m-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
            add new
          </button>
          <form action="" method="get">
            <input type="search" name="search">
            <input type="submit" name="subsearch" value="search">
          </form>
          <h3 class="mt-3">employ table</h3>

        </center>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="post">
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">First Name</label>
                    <input type="text" name="fename" class="form-control" id="recipient-name">
                  </div>
                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">Last name</label>
                    <input type="text" name="lename" class="form-control" id="message-text">
                  </div>
                  <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">email</label>
                    <input type="text" name="eemail" class="form-control" id="recipient-name">
                  </div>
                  <div class="mb-3">
                    <label for="message-text" class="col-form-label">etat</label>
                    <input type="text" name="etat" class="form-control" id="message-text">
                  </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <input type="submit" name="sub" class="btn btn-primary"value="Save changes">
              </div>
              </form>
            </div>
          </div>
        </div>
        <?php

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
          if(isset($_POST['sub'])){
            $fname = $_POST['fename'];
            $lname = $_POST['lename'];
            $email = $_POST['eemail'];
            $etat  = $_POST['etat'];
       
            $sql1 = "INSERT INTO first_login.employ (name, prenome, email, etat) VALUES ('". $fname ."', '". $lname ."', '". $email ."', '" . $etat ."');";
          
          
            if ($conn->query($sql1) === TRUE) {
            } else {
              echo "<h1 class='text-center text-danger'>votre email a ete deja utilise</h1>"; 
            }
          }
        }
        ?>
                <center>
              <table class="container table table-bordered w-50 mt-4 text-center">
                <thead>
                  <th>
                    <th class="text-center h3" colspan="5">employ table</th>
                  </th>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Etat</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_GET['subsearch'])){
                          $search = $_GET['search'];
                          $sql2 = "SELECT * FROM first_login.employ where name='". $search ."' or prenome='". $search . "' or email='". $search ."' or etat='".$search."';";
                        }else{
                          $sql2 = "SELECT * FROM first_login.employ";
                        }
                          $result = $conn->query($sql2);
                          $i = 1;
                        while($row = $result->fetch_assoc()){
                          echo "<tr>";
                              echo "<th>" . $i . "</th>";
                              echo "<th>" . $row['name'] . "</th>";
                              echo "<th>" . $row['prenome'] . "</th>";
                              echo "<th>" . $row['email'] . "</th>";
                              echo "<th>" . $row['etat'] . "</th>";
                              echo "<td>
                              <a class=\"btn btn-danger\" href=\"delete.php?id=$row[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>
                                    </td>";
                                    
                              echo "<th>";
                                if($row['etat']=='active'){
                                  echo "<div class=\"form-check form-switch\">";
                                  echo "<input class=\"form-check-input\" type=\"checkbox\" role=\"switch\" id=\"flexSwitchCheckChecked\" checked>";
                                  echo "<label class=\"form-check-label\" for=\"flexSwitchCheckChecked\">Checked switch checkbox input</label></div>";
                                }

                              echo "</th>";
                          echo "</tr>";
                          $i++;
                        }
                        $conn->close();
                    ?>
                </tbody>
              </table>
              </center>
  
</div>
</body>
</html>