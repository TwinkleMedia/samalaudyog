<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
   <?php
include './link_file.php'
   ?>
</head>
<?php
session_start();

if(!$_SESSION['admin']) {
header("location:form/login.php");

}

?>


<body>
    <div class="dashboard-container">
     <?php
     include './headerfix.php'
     ?>
        
        
        
        <div class="main-content">
            <header class="topbar">
                <h1>Dashboard</h1>
                <div class="user-info">
                    <p>Welcome, <?php echo $_SESSION['admin']  ?> </p>
                    <a href="form/logout.php">Logout</a>
                </div>
            </header>
            <div class="content">
              
              
              <table class=" table border border-warning table-hover border my-5 shadow">
  <thead class="bg-dark text-white fs-5 font-monospace text-center">
    <tr >
      <th>Id</th>
      <th> Title </th>
      <th>Subject </th>
      <th> Image</th>
      <th> Price</th>
      <th> Years </th>
      <th> Update</th>
      <th> Delete</th>
    </tr>
  </thead>

  
  <tbody class="text-center">


    <?php 
include 'config.php';
$Record = mysqli_query($con, "SELECT * FROM `studybookproducts`");

    while( $row = mysqli_fetch_array($Record))

echo"
<tr >
    <td>$row[Id]</td>
    <td>$row[TName]</td>
    <td>$row[Subject]</td>
    <td><img src='$row[PImage]' height= '90px' width= '120px'></td>
    <td>$row[P12price]</td>
    <td>$row[Years]</td>
    <td><a href='' class='btn btn-danger'>Edit</a></td>
    <td><a href='' class='btn btn-danger'>Delete</a></td>
    
   
  </tr>
";

    ?>
  </tbody>

</table>

            </div>
        </div>
    </div>
   

    <?php
include './jslinkfile.php'
   ?>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
