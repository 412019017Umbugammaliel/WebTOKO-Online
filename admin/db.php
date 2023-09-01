<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "20222_wp2_412019017";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
