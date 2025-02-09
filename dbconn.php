<?php
// $server = "newlifeservices.in";
// $user = "u694280384_d_marine_user2";
// $password = "Dilip@123Dilip";
// $db = "u694280384_d_marine2";
<!--$server = "localhost";-->
<!--$user = "root";-->
<!--$password = "";-->
<!--$db = "samala";-->

<!--$con = mysqli_connect($server, $user, $password, $db);-->

<!--if (!$con) {-->
<!--    die("Connection failed: " . mysqli_connect_error());-->
<!--}-->
<!--?>-->


<?php
$servername = "localhost";
$username = "root";
$password = "Samalapass@123";
$dbname = "u694280384_samalaDemoDB";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Make $conn global so it can be accessed in other files
global $conn;
?>