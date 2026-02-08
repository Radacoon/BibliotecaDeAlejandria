<?php
$host = "db"; 
$user = "alex"; 
$pass = "wasd"; 
$db   = "rdr_db"; 

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
