<?php
require_once "../db.php";

// Query untuk mengambil data kategori
$kategori = mysqli_query($conn, "SELECT * FROM tabel_category ORDER BY id_category DESC");
$data = array();

while ($row = mysqli_fetch_assoc($kategori)) {
    $data[] = $row;
}

echo json_encode($data);
?>