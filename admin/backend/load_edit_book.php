<?php
require_once "../db.php";

$id = $_GET['id'];

$query = "SELECT * FROM tabel_product WHERE product_id = '$id'";
$result = mysqli_query($conn, $query);
$buku = mysqli_fetch_assoc($result);

echo json_encode($buku);
?>