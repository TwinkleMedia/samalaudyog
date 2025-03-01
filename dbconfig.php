 <?php
$servername = "localhost"; 
$username = "root";  
$password = "Samala@0118"; 
$dbname = "samalaudyog"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

global $conn;

?>  

<?php
//$servername = "localhost"; 
//$username = "root"; 
//$password = ""; 
//$dbname = "adminsamala"; 

//$conn = new mysqli($servername, $username, $password, $dbname);

//if ($conn->connect_error) {
    //die("Connection failed: " . $conn->connect_error);
//}

//global $conn;

?> 







